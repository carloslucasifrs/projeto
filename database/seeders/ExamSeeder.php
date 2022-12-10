<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('exams')->insert([
            'user_id' => 1,
            'laboratory_id' => 1,
            'date' => fake()->dateTime(random_int(-30, -1).' month'),
            'file' => 'file.pdf',
        ]);

        DB::table('exams')->insert([
            'user_id' => 1,
            'laboratory_id' => 1,
            'date' => fake()->dateTime(random_int(-30, -1).' month'),
            'file' => 'file2.pdf',
        ]);

        DB::table('exams')->insert([
            'user_id' => 1,
            'laboratory_id' => 1,
            'date' => fake()->dateTime(random_int(-30, -1).' month'),
            'file' => 'file3.pdf',
        ]);

        Exam::factory()->count(20)->create();
    }
}
