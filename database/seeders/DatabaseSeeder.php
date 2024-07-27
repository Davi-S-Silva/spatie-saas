<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            Status::class,
            LocalMovimentacaoSeeder::class,
            EmpresaSeeder::class,
            IndicacaoPagamento::class,
            TipoColaboradorSeeder::class,
            FuncaoColaboradorSeeder::class,
            CombustivelSeeder::class,
            RegiaoSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            EspecialidadeSeeder::class
        ]);
    }
}
