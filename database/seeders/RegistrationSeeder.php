<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Registration;
use App\Enums\RegistrationStatus;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $course1 = Course::first();
        $course2 = Course::skip(1)->first();

        if ($course1) {
            Registration::create([
                'course_id' => $course1->id,
                'name' => 'Budi Pendaftar',
                'email' => 'budi@example.com',
                'phone' => '081234567890',
                'status' => RegistrationStatus::PENDING,
            ]);
            Registration::create([
                'course_id' => $course1->id,
                'name' => 'Siti Aminah',
                'email' => 'siti@example.com',
                'phone' => '081298765432',
                'status' => RegistrationStatus::DITERIMA,
            ]);
        }

        if ($course2) {
            Registration::create([
                'course_id' => $course2->id,
                'name' => 'Andi Wijaya',
                'email' => 'andi@example.com',
                'phone' => '085712345678',
                'status' => RegistrationStatus::PENDING,
            ]);
        }
    }
}