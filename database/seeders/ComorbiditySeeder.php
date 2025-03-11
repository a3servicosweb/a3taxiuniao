<?php

namespace Database\Seeders;

use App\Models\Comorbidity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComorbiditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comorbidities = [
            [
                'name' => 'Arritmias Cardíacas',
                'description' => 'Distúrbios do ritmo normal do coração.'
            ],
            [
                'name' => 'Cardiopatia Hipertensiva',
                'description' => 'Doença cardíaca causada pela pressão arterial elevada.'
            ],
            [
                'name' => 'Cardiopatias Congênitas no Adulto',
                'description' => 'Anormalidades estruturais no coração presentes desde o nascimento.'
            ],
            [
                'name' => 'Cirrose Hepática',
                'description' => 'Cicatrização grave do fígado, geralmente causada por doenças crônicas.'
            ],
            [
                'name' => 'Diabetes Mellitus',
                'description' => 'Doença crônica caracterizada pela alta concentração de glicose no sangue.'
            ],
            [
                'name' => 'Doença Cerebrovascular',
                'description' => 'Condições que afetam a circulação sanguínea no cérebro.'
            ],
            [
                'name' => 'Doença Renal Crônica',
                'description' => 'Perda gradual da função renal ao longo do tempo.'
            ],
            [
                'name' => 'Doenças da Aorta, Grandes Vasos e Fístulas Arteriovenosas',
                'description' => 'Doenças que afetam grandes artérias e conexões anormais entre vasos.'
            ],
            [
                'name' => 'Hemoglobinopatias Graves',
                'description' => 'Doenças genéticas que afetam a estrutura da hemoglobina.'
            ],
            [
                'name' => 'Hipertensão Arterial',
                'description' => 'Condição de pressão arterial persistentemente elevada.'
            ],
            [
                'name' => 'Hipertensão Arterial Resistente (HAR)',
                'description' => 'Pressão arterial que permanece alta apesar do uso de múltiplos medicamentos.'
            ],
            [
                'name' => 'Hipertensão Pulmonar / Cor-pulmonale',
                'description' => 'Pressão alta nas artérias pulmonares, causando insuficiência cardíaca direita.'
            ],
            [
                'name' => 'Imunossuprimidos',
                'description' => 'Pessoas com sistema imunológico enfraquecido por doenças ou medicamentos.'
            ],
            [
                'name' => 'Insuficiência Cardíaca',
                'description' => 'Condição em que o coração não consegue bombear sangue adequadamente.'
            ],
            [
                'name' => 'Miocardiopatias e Pericardiopatias',
                'description' => 'Doenças que afetam o músculo cardíaco ou o pericárdio.'
            ],
            [
                'name' => 'Obesidade Mórbida',
                'description' => 'Condição de obesidade severa com impacto significativo na saúde.'
            ],
            [
                'name' => 'Pneumopatias Crônicas Graves',
                'description' => 'Doenças pulmonares graves de longo prazo que afetam a respiração.'
            ],
            [
                'name' => 'Próteses Valvares e Dispositivos Cardíacos Implntados',
                'description' => 'Pessoas com válvulas ou dispositivos artificiais no coração.'
            ],
            [
                'name' => 'Reumáticos como Portadores de Espondilite Anquilosante',
                'description' => 'Doenças inflamatórias reumáticas que afetam a coluna vertebral.'
            ],
            [
                'name' => 'Síndrome de Down',
                'description' => 'Condição genética causada pela presença de uma cópia extra do cromossomo 21.'
            ],
        ];

        foreach ($comorbidities as $comorbidity) {
            Comorbidity::create($comorbidity);
        }
    }
}
