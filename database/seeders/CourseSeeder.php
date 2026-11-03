<?php

namespace Database\Seeders;

use App\Enums\CourseStatus;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $web = Category::where('slug', 'web-development')->first();
        $mobile = Category::where('slug', 'mobile-development')->first();
        $data = Category::where('slug', 'data-science')->first();
        $design = Category::where('slug', 'uiux-design')->first();
        $devops = Category::where('slug', 'devops')->first();

        $courses = [
            [
                'category_id' => $web->id,
                'title' => 'Laravel untuk Pemula',
                'description' => 'Belajar membangun aplikasi web modern dengan Laravel dari nol hingga deploy.',
                'instructor' => 'Budi Santoso',
                'price' => null,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $web->id,
                'title' => 'JavaScript Modern (ES6+)',
                'description' => 'Kuasai fitur-fitur modern JavaScript untuk pengembangan web interaktif.',
                'instructor' => 'Siti Aminah',
                'price' => 250000,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $mobile->id,
                'title' => 'Flutter Dasar',
                'description' => 'Buat aplikasi mobile Android & iOS dengan satu basis kode menggunakan Flutter.',
                'instructor' => 'Andi Wijaya',
                'price' => 300000,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $data->id,
                'title' => 'Python untuk Data Science',
                'description' => 'Analisis data dan visualisasi menggunakan Python, Pandas, dan Matplotlib.',
                'instructor' => 'Rina Kartika',
                'price' => null,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $design->id,
                'title' => 'Desain UI dengan Figma',
                'description' => 'Rancang antarmuka pengguna yang menarik dan fungsional dengan Figma.',
                'instructor' => 'Dewi Lestari',
                'price' => 150000,
                'status' => CourseStatus::PUBLISHED,
            ],
            [
                'category_id' => $devops->id,
                'title' => 'Docker & Kubernetes',
                'description' => 'Containerization dan orkestrasi aplikasi untuk deployment skala besar.',
                'instructor' => 'Eko Prasetyo',
                'price' => 400000,
                'status' => CourseStatus::DRAFT,
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['slug' => Str::slug($course['title'])],
                $course
            );
        }
    }
}