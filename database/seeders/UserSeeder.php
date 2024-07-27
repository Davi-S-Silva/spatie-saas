<?php

namespace Database\Seeders;

use App\Models\Colaborador;
use App\Models\Contato;
use App\Models\DocColaborador;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\LocalApoio;
use App\Models\LocalMovimentacao;
use App\Models\Municipio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'adminmaster@gmail.com',
            'password' => Hash::make('password'),
            // 'empresa_id'=>1,
        ]);
        // DB::table('users')->insert([
        //     'name' => 'Marcilene Celestino da Silva',
        //     'email' => 'marcilenecelestino907@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);

        $user = User::where('email','adminmaster@gmail.com')->get()->first();
        $user->syncRoles(['super-admin']);

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
        $localApoio->newId();
        $localApoio->name = 'SaaS Portal';
        $localApoio->description = 'Sede da empresa  SaaS Portal';
        $localApoio->empresa_id = 1;
        $localApoio->usuario_id = 1;
        $localApoio->save();

        $localMov = new LocalMovimentacao();
        $localMov->newId();
        $localMov->title = $localApoio->name;
        $localMov->descricao = 'Sede da empresa SaaS Portal';
        $localMov->status_id = $localMov->getStatusId('Ativo');
        $localMov->usuario_id = 1;
        $localMov->save();
        $localApoio->locaismovimetacoes()->attach($localMov->id);

        $colaborador = new Colaborador();
        $colaborador->newId();
        $colaborador->name = $user->name;
        $colaborador->apelido = $user->name;
        $colaborador->foto_path = '';
        $colaborador->data_nascimento = '1995-05-31';
        $colaborador->tipo_id = 1;
        $colaborador->funcao_id = 7;
        // $colaborador->tenant_id = '';
        $colaborador->empresa_id = 1;
        $colaborador->local_apoio_id = 1;
        $colaborador->usuario_id = 1;
        $colaborador->setStatus('Disponivel');
        $colaborador->save();
        $user->colaborador()->attach($colaborador->id);

        $DocColaborador = new DocColaborador();
        $DocColaborador->newId();
        $DocColaborador->tipo_id = $DocColaborador->getTipoDocId('CPF');
        $DocColaborador->colaborador_id = $colaborador->id;
        $DocColaborador->numero = '11116354470';
        $DocColaborador->save();

        $endereco = new Endereco();
        $endereco->newId();
        $endereco->endereco = 'Bezerra de Carvalho';
        $endereco->numero = 220;
        $endereco->bairro ='Imbiribeira';
        $endereco->cep = 51190410;
        $endereco->cidade_id = Municipio::getMunicipioId('Recife');
        $endereco->estado_id = Estado::getEstadoId('PE');
        $endereco->save();
        $colaborador->enderecos()->attach($endereco->id);

        $contato = new Contato();
        $contato->newId();
        $contato->telefone ='81986332809';
        $contato->whatsapp = '81986332809';
        $contato->email = 'davi@gmail.com';
        $contato->descricao = 'admin master do sistema';
        $contato->usuario_id = 1;
        $contato->save();
        $colaborador->contatos()->attach($contato->id);
    }
}
