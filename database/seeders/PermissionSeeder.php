<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $observerRole = Role::create(['name'=>'Observer']);
        $observer = User::factory()->create([
            'name' => 'observer',
            'email' => 'observer@quorumenlinea.com',
            'password' => bcrypt('password'),
        ]);
        $observer->assignRole($observerRole);

        $superAdminRole = Role::create(['name' => 'Super-Admin']);
        $superAdmin = User::factory()->create([
           'name' => 'superadmin',
           'email' => 'superadmin@quorumenlinea.com',
           'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole($superAdminRole);

        $moderatorRole = Role::create(['name'=>'Moderator']);
        $moderator = User::factory()->create([
            'name' => 'moderator',
            'email' => 'moderator@quorumenlinea.com',
            'password' => bcrypt('password'),
        ]);
        $moderator->assignRole($moderatorRole);

        $participantRole = Role::create(['name'=>'Participant']);
        $participant = User::factory()->create([
            'name' => 'participant',
            'email' => 'participant@quorumenlinea.com',
            'password' => bcrypt('password'),
        ]);
        $participant->assignRole($participantRole);

        Permission::create(['name' => 'listar reuniones']);
        Permission::create(['name' => 'crear reuniones']);
        Permission::create(['name' => 'mostrar reuniones']);
        Permission::create(['name' => 'actualizar reuniones']);
        Permission::create(['name' => 'borrar reuniones']);
        Permission::create(['name' => 'restaurar reuniones']);
        Permission::create(['name' => 'operar reunion']);
        Permission::create(['name' => 'votar questions']);
        Permission::create(['name' => 'observar reunion']);
        Permission::create(['name' => 'ver votaciones']);

        Permission::create(['name' => 'listar questions']);
        Permission::create(['name' => 'crear questions']);
        Permission::create(['name' => 'mostrar questions']);
        Permission::create(['name' => 'actualizar questions']);
        Permission::create(['name' => 'borrar questions']);

        $moderator->givePermissionTo([
            'listar questions','crear questions','mostrar questions', 'actualizar questions', 'borrar questions'
        ]);
        $participant->givePermissionTo([
           'votar questions' , 'ver votaciones'
        ]);
        $observer->givePermissionTo([
            'observar reunion' , 'ver votaciones'
        ]);
    }
}
