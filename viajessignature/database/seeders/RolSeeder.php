<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'administrador']);
        $roleProgramador = Role::create(['name' => 'programador']);
        $roleGerentes = Role::create(['name' => 'gerentes']);
        $roleSuperVisor = Role::create(['name' => 'supervisor']);
        $roleAgenciaViajes = Role::create(['name' => 'agencia de viaje']);
        $roleCartera = Role::create(['name' => 'cartera']);

        //prueba
        $roleUsuario = Role::create(['name' => 'usuario']);

        //Modulo Inicio
        Permission::create(['name' => 'inicio.index'])->syncRoles($roleUsuario);

        //Modulo Usuarios
        Permission::create(['name' => 'usuarios.index'])->syncRoles($roleUsuario);

        //->assignRole($roleUsuario)
    }
}
