<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Enums\RegistrationStatus;
use Illuminate\Http\Request;

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
}