<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Verifica si el rol Administrador existe
        $adminRole = Role::where('name', 'Administrador')->first();

        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'Administrador']);
        }


        $adminUser = User::create([
            'name' => 'Diego Chavez',
            'email' => 'Diego@gmail.com',
            'password' => bcrypt('12'),
        ]);

        $adminUser->assignRole($adminRole);
    }
}
