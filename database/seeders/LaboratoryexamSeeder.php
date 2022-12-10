<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Laboratoryexam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoryexamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('laboratoryexams')->insert([
            'exam' => 'Creatinina',
            'description' => 'A creatinina é um catabólito da creatinina muscular. Em determinado indivíduo, a produção cotidiana de creatinina é ',
            'material' => 'sangue',
            'method' => '',
            'use' => '',
            'bibliography' => 'CAQUET, René. 250 Exames de Laboratório: Prescrição e Interpretação. [Digite o Local da Editora]: Thieme Brazil, 2017. E-book. ISBN 9788554650711. Disponível em: https://integrada.minhabiblioteca.com.br/#/books/9788554650711/. Acesso em: 18 nov. 2022.',
        ]);

        DB::table('laboratoryexams')->insert([
            'exam' => 'Sódio',
            'description' => 'Loren ipsum',
            'material' => 'sangue',
            'method' => '',
            'use' => '',
            'bibliography' => 'CAQUET, René. 250 Exames de Laboratório: Prescrição e Interpretação. [Digite o Local da Editora]: Thieme Brazil, 2017. E-book. ISBN 9788554650711. Disponível em: https://integrada.minhabiblioteca.com.br/#/books/9788554650711/. Acesso em: 18 nov. 2022.',
        ]);

        DB::table('laboratoryexams')->insert([
            'exam' => 'Potássio',
            'description' => 'Loren ipsum',
            'material' => 'sangue',
            'method' => '',
            'use' => '',
            'bibliography' => 'CAQUET, René. 250 Exames de Laboratório: Prescrição e Interpretação. [Digite o Local da Editora]: Thieme Brazil, 2017. E-book. ISBN 9788554650711. Disponível em: https://integrada.minhabiblioteca.com.br/#/books/9788554650711/. Acesso em: 18 nov. 2022.',
        ]);

        Laboratoryexam::factory()->count(10)->create();
    }
}
