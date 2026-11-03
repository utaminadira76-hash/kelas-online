<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Enums\RegistrationStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with('course')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                      ->orWhere('email', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.registrations.index', compact('registrations'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $registration->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pendaftar berhasil diperbarui.');
    }

    // METHOD BARU UNTUK EKSPOR CSV
    public function export()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=pendaftar_kelas_online.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $registrations = Registration::with('course')->latest()->get();

        $callback = function() use($registrations) {
            $file = fopen('php://output', 'w');
            
            // Header Kolom
            fputcsv($file, ['No', 'Nama', 'Email', 'Telepon', 'Kelas', 'Status', 'Tanggal Daftar']);

            // Isi Data
            foreach ($registrations as $index => $reg) {
                fputcsv($file, [
                    $index + 1,
                    $reg->name,
                    $reg->email,
                    $reg->phone,
                    $reg->course->title ?? '-',
                    $reg->status->label(),
                    $reg->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}