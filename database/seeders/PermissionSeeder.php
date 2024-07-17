<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $array = [
            ['name'=>'Editar Regra', 'model'=>'Role','guard_name'=>'web'],
            ['name'=>'Criar Regra', 'model'=>'Role','guard_name'=>'web'],
            ['name'=>'Visualizar Regra', 'model'=>'Role','guard_name'=>'web'],
            ['name'=>'Deletar Regra', 'model'=>'Role','guard_name'=>'web'],
            ['name'=>'Listar Regra', 'model'=>'Role','guard_name'=>'web'],
            ['name'=>'Modificar Permissao Regra', 'model'=>'Permission','guard_name'=>'web'],
            ['name'=>'Editar Permissao', 'model'=>'Permission','guard_name'=>'web'],
            ['name'=>'Deletar Permissao', 'model'=>'Permission','guard_name'=>'web'],
            ['name'=>'Visualizar Permissao', 'model'=>'Permission','guard_name'=>'web'],
            ['name'=>'Criar Permissao', 'model'=>'Permission','guard_name'=>'web'],
            ['name'=>'Modificar Role Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Editar Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Criar Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Visualizar Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Listar Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Deletar Usuario', 'model'=>'User','guard_name'=>'web'],
            ['name'=>'Visualizar Certificado', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Nova Empresa', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Listar Empresa', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Editar Empresa', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Show Empresa', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Deletar Empresa', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Deletar Nota', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Carrega Notas', 'model'=>'Empresa','guard_name'=>'web'],
            ['name'=>'Criar Tenant', 'model'=>'Tenant','guard_name'=>'web'],
            ['name'=>'Deletar Tenant', 'model'=>'Tenant','guard_name'=>'web'],
            ['name'=>'Editar Tenant', 'model'=>'Tenant','guard_name'=>'web'],
            ['name'=>'Listar Tenant', 'model'=>'Tenant','guard_name'=>'web'],
            ['name'=>'Show Tenant', 'model'=>'Tenant','guard_name'=>'web'],
            ['name'=>'Criar Colaborador', 'model'=>'Colaborador','guard_name'=>'web'],
            ['name'=>'Editar Colaborador', 'model'=>'Colaborador','guard_name'=>'web'],
            ['name'=>'Listar Colaborador', 'model'=>'Colaborador','guard_name'=>'web'],
            ['name'=>'Show Colaborador', 'model'=>'Colaborador','guard_name'=>'web'],
            ['name'=>'Deletar Colaborador', 'model'=>'Colaborador','guard_name'=>'web'],
            ['name'=>'Criar Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Show Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Listar Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Deletar Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Liberar Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Editar Veiculo', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Associar Colaborador', 'model'=>'Veiculo','guard_name'=>'web'],
            ['name'=>'Criar Entrega', 'model'=>'Entrega','guard_name'=>'web'],
            ['name'=>'Listar Entrega', 'model'=>'Entrega','guard_name'=>'web'],
            ['name'=>'Show Entrega', 'model'=>'Entrega','guard_name'=>'web'],
            ['name'=>'Editar Entrega', 'model'=>'Entrega','guard_name'=>'web'],
            ['name'=>'Deletar Entrega', 'model'=>'Entrega','guard_name'=>'web'],
            ['name'=>'Criar Carga', 'model'=>'Carga','guard_name'=>'web'],
            ['name'=>'Listar Carga', 'model'=>'Carga','guard_name'=>'web'],
            ['name'=>'Show Carga', 'model'=>'Carga','guard_name'=>'web'],
            ['name'=>'Deletar Carga', 'model'=>'Carga','guard_name'=>'web'],
            ['name'=>'Editar Carga', 'model'=>'Carga','guard_name'=>'web'],
            ['name'=>'Criar Cliente', 'model'=>'Cliente','guard_name'=>'web'],
            ['name'=>'Listar Cliente', 'model'=>'Cliente','guard_name'=>'web'],
            ['name'=>'Editar Cliente', 'model'=>'Cliente','guard_name'=>'web'],
            ['name'=>'Show Cliente', 'model'=>'Cliente','guard_name'=>'web'],
            ['name'=>'Deletar Cliente', 'model'=>'Cliente','guard_name'=>'web'],
            ['name'=>'Criar Abastecimento', 'model'=>'Abastecimento','guard_name'=>'web'],
            ['name'=>'Show Abastecimento', 'model'=>'Abastecimento','guard_name'=>'web'],
            ['name'=>'Listar Abastecimento', 'model'=>'Abastecimento','guard_name'=>'web'],
            ['name'=>'Editar Abastecimento', 'model'=>'Abastecimento','guard_name'=>'web'],
            ['name'=>'Deletar Abastecimento', 'model'=>'Abastecimento','guard_name'=>'web'],
        ];
        foreach($array as $permission){
            $Permission = Permission::where('name',$permission['name'])->get();
            if($Permission->count()==0){
                DB::table('permissions')->insert([
                    'name' => $permission['name'],
                    'model' => $permission['model'],
                    'guard_name' =>$permission['guard_name'],
                ]);
                echo 'Permission: '.$permission['name']. ' Criada com sucesso.'. PHP_EOL;
            }else{
                echo 'Permission: '.$permission['name']. ' Já existe.'. PHP_EOL;
            }
        }
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        echo 'Cache de permissões atualizadas com sucesso!'. PHP_EOL;
    }
}
