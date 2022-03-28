<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre_usuario' => 'alejofr',
            'nombres' => 'Administrador',
            'apellidos'=> 'Administrador',
            'telefono' => '+584263583821',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ])->assignRole('administrador');

        User::create([
            'nombre_usuario' => 'yison',
            'nombres' => 'Yison',
            'apellidos'=> 'smith',
            'telefono' => '+584263583821',
            'email' => 'yison2011@gmail.com',
            'password' => bcrypt('admin123')
        ])->assignRole('programador');

        User::create([
            'nombre_usuario' => 'abraham',
            'nombres' => 'Abraham',
            'apellidos'=> 'Freitez',
            'telefono' => '+584263583821',
            'email' => 'freitezabraham@gmail.com',
            'password' => bcrypt('admin123')
        ])->assignRole('usuario');
    }
}
