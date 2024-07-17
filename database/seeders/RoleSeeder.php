<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'tenant-admin',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'usuario',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'tenant-usuario',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'colaborador',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'tenant-colaborador',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'tenant-admin-master',
            'guard_name' => 'web',
        ]);

        $role = Role::where('name','super-admin')->get()->first();
        $role->syncPermissions(Permission::all());

    }
}
