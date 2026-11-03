<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\CourseStatus;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Jika sedang edit, ambil ID kelas untuk pengecualian validasi slug
        $courseId = $this->route('course') ? $this->route('course')->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($courseId)],
            'category_id' => 'required|exists:categories,id',
            'instructor' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'status' => ['required', Rule::enum(CourseStatus::class)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul kelas wajib diisi.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.unique' => 'Slug sudah digunakan kelas lain.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'instructor.required' => 'Nama instruktur wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}