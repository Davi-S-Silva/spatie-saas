<?php

namespace Database\Seeders;

use App\Models\LocalApoio;
use App\Models\LocalMovimentacao;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empresas')->insert([
            'nome' => 'SaaS Portal',
            'nome_fantasia' => 'SaaS Portal',
            'tipo_doc' => 1,
            'doc' => 00000000000,
            'usuario_id'=> 1
        ]);

        $user = User::find(1);
        $user->empresa()->attach(1);

        $localApoio = new LocalApoio();
        $localApoio->name = 'SaaS Portal';
        $localApoio->description = 'Sede da empresa  SaaS Portal';
        $localApoio->empresa_id = 1;
        $localApoio->usuario_id = 1;
        $localApoio->save();

        $localMov = new LocalMovimentacao();
        $localMov->title = $localApoio->name;
        $localMov->descricao = 'Sede da empresa SaaS Portal';
        $localMov->status_id = $localMov->getStatusId('Ativo');
        $localMov->usuario_id = 1;
        $localMov->save();

        $localApoio->locaismovimetacoes()->attach($localMov->id);

    }
}
