<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
    }
}
