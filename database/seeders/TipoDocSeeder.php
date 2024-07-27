<?php

namespace Database\Seeders;

use App\Models\TipoDoc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
           'CPF',
           'CNPJ',
           'PIS',
           'RG',
        ];
        foreach($array as $tipodoc){
            $TipoDoc = TipoDoc::where('name',$tipodoc)->get();
            if($TipoDoc->count()==0){
                DB::table('tipo_docs')->insert([
                    'name' => $tipodoc,
                ]);
                echo 'TipoDoc: '.$tipodoc. ' Criado com sucesso.'. PHP_EOL;
            }else{
                echo 'TipoDoc: '.$tipodoc. ' Já existe.'. PHP_EOL;
            }
        }
    }
}
