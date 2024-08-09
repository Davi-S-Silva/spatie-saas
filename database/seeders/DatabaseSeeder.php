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
            Status::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RegiaoSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            ServicoSeeder::class,
            IndicacaoPagamento::class,
            TipoPagamentoSeeder::class,
            TipoColaboradorSeeder::class,
            FuncaoColaboradorSeeder::class,
            TipoDocSeeder::class,
            CategoriaVeiculoSeeder::class,
            TipoVeiculoSeeder::class,
            UserSeeder::class,
            LocalMovimentacaoSeeder::class,
            CombustivelSeeder::class,
            EspecialidadeSeeder::class
        ]);
    }
}
