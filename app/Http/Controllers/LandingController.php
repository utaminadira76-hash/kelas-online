<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Enums\CourseStatus;
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
}