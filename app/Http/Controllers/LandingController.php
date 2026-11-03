<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Registration;
use App\Enums\CourseStatus;
use App\Enums\RegistrationStatus;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::has('courses')->get();

        $courses = Course::with('category')
            ->where('status', CourseStatus::PUBLISHED)
            ->when(request('search'), function ($query) {
                $query->where('title', 'like', '%' . request('search') . '%');
            })
            ->when(request('category'), function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', request('category'));
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('landing.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        // Cegah pengunjung melihat kelas berstatus Draft
        if ($course->status !== CourseStatus::PUBLISHED) {
            abort(404);
        }

        return view('landing.show', compact('course'));
    }

    // INI METHOD YANG TADI HILANG
    public function register(Request $request, Course $course)
    {
        if ($course->status !== CourseStatus::PUBLISHED) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon wajib diisi.',
        ]);

        // Cek apakah email sudah pernah daftar di kelas ini
        $exists = Registration::where('course_id', $course->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return back()->withErrors(['email' => 'Email ini sudah terdaftar di kelas ini.'])->withInput();
        }

        // Simpan data
        Registration::create([
            'course_id' => $course->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => RegistrationStatus::PENDING,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan tunggu konfirmasi dari admin.');
    }
}