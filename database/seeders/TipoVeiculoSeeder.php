<?php

namespace Database\Seeders;

use App\Models\TipoVeiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayTipos = [
            'Articulado',
            'Auto-propolido',
            'Automóvel',
            'Bell',
            'Biarticulado',
            'Caminhão Trucado Bi-direcional',
            'Carreta 12T',
            'Carreta 7T',
            'Carroceria',
            'Carga Caminhonete',
            'Carga Caminhão',
            'Carreta - Cavalo',//Cavalo
            'Dolly',
            'Empilhadeira',
            'Empilhadeira 2,5T e 4T',
            'Grade Pesada',
            'Guindaste 5T e 18T',
            'Guindaste Caminhão Telescópico',
            'Guindaste Telescópico',
            'Guindaste Treliçado',
            'Guindauto',
            'HR',
            'Linha de Eixo',
            'Moto Niveladora',
            'Motobomba',
            'Motocicleta',
            'Motor Estacionário',
            'Ônibus Toco',
            'Ônibus Trucado',
            'Ônibus Trucado Bi-direcional',
            'Pá Carregadeira',
            'Paleteira',
            'Reboque',
            'Retro Escavadeira',
            'Rolo Autopropulsor 7 Pneus',
            'Rolo Autopropulsor 9 Pneus',
            'Rolo Autopropulsor Compactador',
            'Rolo Autopropulsor Vibratório',
            'Rolo Compactador',
            'Semi-Reboque',
            'Carga Caminhão - Toco',
            'Trator de Esteira',
            'Tração Caminhão Trator',
            'Trator de Pneu',
            'Carga Caminhão - Truck',
            'Utilitário',
            'Varredeira'
        ];

        foreach ($arrayTipos as $item) {
            $tipo = TipoVeiculo::where('name',$item)->get();
            if($tipo->count()==0){
                DB::table('tipo_veiculos')->insert([
                    'name' => $item,
                ]);
                echo 'Tipo de veiculo '.$item.' cadastrado com sucesso!'.PHP_EOL;
            }else{
                echo 'Tipo de veiculo '.$item.' ja existe no sistema!'.PHP_EOL;
            }
        }
    }
}
