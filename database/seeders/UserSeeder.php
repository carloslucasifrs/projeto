<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin João  da Silva',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'remember_token' => Str::random(10),
            'birth_date' => '1983-10-29',
            'genre' => 'xxxxxd',
            'biologic_sex' => 'Masculino',
            'nationality' => 'Brasileira',
            'place_of_birth' => 'Brasil',
            'zipcode' => '96201230',
            'number' => '123',
            'complement' => 'apt 8521 bl 23132',
            'admin' => true,
        ]);

        User::factory()->count(3)->create();
    }
}
