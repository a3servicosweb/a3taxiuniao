<?php

namespace Database\Seeders;

use App\Models\Vaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccines = [
            [
                'name' => 'BCG',
                'description' => 'Vacina contra a tuberculose.',
            ],
            [
                'name' => 'Hepatite B',
                'description' => 'Vacina contra a hepatite B.',
            ],
            [
                'name' => 'Penta (DTP + Hib + Hepatite B)',
                'description' => 'Vacina combinada contra difteria, tétano, coqueluche, Haemophilus influenzae tipo B e hepatite B.',
            ],
            [
                'name' => 'VIP (Vacina Inativada Poliomielite)',
                'description' => 'Vacina injetável contra poliomielite.',
            ],
            [
                'name' => 'VOP (Vacina Oral Poliomielite)',
                'description' => 'Vacina oral contra poliomielite.',
            ],
            [
                'name' => 'Rotavírus',
                'description' => 'Vacina oral contra rotavírus.',
            ],
            [
                'name' => 'Pneumocócica 10-valente',
                'description' => 'Vacina contra infecções causadas pelo pneumococo, como pneumonia e meningite.',
            ],
            [
                'name' => 'Pneumocócica 13-valente',
                'description' => 'Vacina contra infecções graves causadas pelo Streptococcus pneumoniae.',
            ],
            [
                'name' => 'Meningocócica C',
                'description' => 'Vacina contra meningite causada por Neisseria meningitidis do tipo C.',
            ],
            [
                'name' => 'Meningocócica ACWY',
                'description' => 'Vacina contra meningite causada pelos sorogrupos A, C, W e Y de Neisseria meningitidis.',
            ],
            [
                'name' => 'Meningocócica B',
                'description' => 'Vacina contra meningite causada pelo sorogrupo B de Neisseria meningitidis.',
            ],
            [
                'name' => 'Febre Amarela',
                'description' => 'Vacina contra a febre amarela.',
            ],
            [
                'name' => 'Tríplice Viral (Sarampo, Caxumba e Rubéola)',
                'description' => 'Vacina contra sarampo, caxumba e rubéola.',
            ],
            [
                'name' => 'Tetra Viral (Sarampo, Caxumba, Rubéola e Varicela)',
                'description' => 'Vacina combinada contra sarampo, caxumba, rubéola e catapora.',
            ],
            [
                'name' => 'Hepatite A',
                'description' => 'Vacina contra a hepatite A.',
            ],
            [
                'name' => 'Varicela',
                'description' => 'Vacina contra a catapora.',
            ],
            [
                'name' => 'HPV (Papilomavírus Humano)',
                'description' => 'Vacina contra HPV, indicada para prevenção de câncer de colo do útero e outras doenças relacionadas.',
            ],
            [
                'name' => 'Influenza',
                'description' => 'Vacina contra gripe.',
            ],
            [
                'name' => 'Covid-19',
                'description' => 'Vacina contra o coronavírus (SARS-CoV-2).',
            ],
            [
                'name' => 'DTP (Tríplice Bacteriana)',
                'description' => 'Vacina contra difteria, tétano e coqueluche.',
            ],
            [
                'name' => 'DT (Difteria e Tétano)',
                'description' => 'Vacina contra difteria e tétano.',
            ],
            [
                'name' => 'dTpa (Tríplice Acelular do Adulto)',
                'description' => 'Vacina contra difteria, tétano e coqueluche acelular, indicada para gestantes e adultos.',
            ],
            [
                'name' => 'Raiva',
                'description' => 'Vacina para prevenção da raiva.',
            ],
            [
                'name' => 'Zoster',
                'description' => 'Vacina para prevenção de herpes-zóster (cobreiro).',
            ],
            [
                'name' => 'Febre Tifoide',
                'description' => 'Vacina contra a febre tifoide.',
            ],
            [
                'name' => 'Cólera',
                'description' => 'Vacina contra o cólera.',
            ],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::create($vaccine);
        }

//        foreach ($vaccines as $vaccine) {
//            DB::table('vaccines')->insert([
//                'name' => $vaccine['name'],
//                'description' => $vaccine['description'],
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
    }
}
