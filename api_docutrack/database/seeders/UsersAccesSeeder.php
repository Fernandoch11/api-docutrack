<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersAccesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users_access')->insert([
            'nombre' => 'Admin',
            'apellido' => 'Admin',
            'email' => 'admin@gmail.com',
            'cedula' => '0-000-0000',
            'pass' => Hash::make('123456'),
            'nacimiento' => now(),
            'tipo_usuario' => 'ADMIN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
