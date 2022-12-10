<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamLaboratoryexamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 1,
            'laboratoryexam_id' => 1,
            'value' => '3.0',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 2,
            'laboratoryexam_id' => 1,
            'value' => '5.5',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 3,
            'laboratoryexam_id' => 1,
            'value' => '8.2',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 1,
            'laboratoryexam_id' => 2,
            'value' => '100',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 2,
            'laboratoryexam_id' => 2,
            'value' => '3.5',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 3,
            'laboratoryexam_id' => 2,
            'value' => '7.4',
        ]);

        DB::table('exam_laboratoryexam')->insert([
            'exam_id' => 1,
            'laboratoryexam_id' => 3,
            'value' => '1.0',
        ]);
    }
}
