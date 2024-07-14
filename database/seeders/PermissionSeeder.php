<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'name' => 'Editar Regra',
            'model' => 'Role',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Criar Regra',
            'model' => 'Role',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Visualizar Regra',
            'model' => 'Role',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Deletar Regra',
            'model' => 'Role',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Modificar Permissao Regra',
            'model' => 'Role',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Permissao',
            'model' => 'Permission',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Deletar Permissao',
            'model' => 'Permission',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Visualizar Permissao',
            'model' => 'Permission',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Criar Permissao',
            'model' => 'Permission',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Modificar Role Usuario',
            'model' => 'User',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Editar Usuario',
            'model' => 'User',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Criar Usuario',
            'model' => 'User',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Visualizar Usuario',
            'model' => 'User',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Deletar Usuario',
            'model' => 'User',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Visualizar Certificado',
            'model' => 'Empresa',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Nova Empresa',
            'model' => 'Empresa',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Listar Empresas',
            'model' => 'Empresa',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Novo Tenant',
            'model' => 'Tenant',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Listar Tenants',
            'model' => 'Tenant',
            'guard_name' => 'web',
        ]);
        DB::table('permissions')->insert([
            'name' => 'Criar Colaborador',
            'model' => 'Colaborador',
            'guard_name' => 'web',
        ]);

    }
}
