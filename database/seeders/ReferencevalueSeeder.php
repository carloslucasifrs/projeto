<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Laboratoryexam;
use App\Models\Referencevalue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferencevalueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $laboratoryexams = Laboratoryexam::select('id')->where('exam', 'Creatinina')->first();

        DB::table('referencevalues')->insert([
            'rule' => 'Adultos',
            'biologic_sex' =>  'Mulher',
            'age_min' => 13,
            'age_max' => 150,
            'value_min' => 0.5,
            'value_max' => 1.2,
            'laboratoryexam_id' => $laboratoryexams->id,

        ]);

        DB::table('referencevalues')->insert([
            'rule' => 'Adultos',
            'biologic_sex' =>  'Homens',
            'age_min' => 13,
            'age_max' => 150,
            'value_min' => 0.6,
            'value_max' => 1.2,
            'laboratoryexam_id' => $laboratoryexams->id,
        ]);

        DB::table('referencevalues')->insert([
            'rule' => 'Adolescente',
            'biologic_sex' => 'all',
            'age_min' => 7,
            'age_max' => 12,
            'value_min' => 0.6,
            'value_max' => 1.2,
            'laboratoryexam_id' => $laboratoryexams->id,
        ]);

        DB::table('referencevalues')->insert([
            'rule' => 'crianças até 6 anos',
            'biologic_sex' => 'all',
            'age_min' => 1,
            'age_max' => 6,
            'value_min' => 0.3,
            'value_max' => 0.7,
            'laboratoryexam_id' => $laboratoryexams->id,
        ]);

        DB::table('referencevalues')->insert([
            'rule' => 'Recem Náscido',
            'biologic_sex' => 'all',
            'age_min' => 0,
            'age_max' => 0,
            'value_min' => 0.2,
            'value_max' => 0.4,
            'laboratoryexam_id' => $laboratoryexams->id,
        ]);

        Referencevalue::factory()->count(30)->create();
    }
}
