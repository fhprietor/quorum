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

        $observerRole = Role::create(['name'=>'Observer']);
        $observer = User::factory()->create([
            'name' => 'observer',
            'email' => 'observer@quorumenlinea.com',
            'password' => bcrypt('password'),
        ]);
        $observer->assignRole($observerRole);

        Permission::create(['name' => 'listar reuniones']);
        Permission::create(['name' => 'crear reuniones']);
        Permission::create(['name' => 'mostrar reuniones']);
        Permission::create(['name' => 'actualizar reuniones']);
        Permission::create(['name' => 'borrar reuniones']);
        Permission::create(['name' => 'restaurar reuniones']);
        Permission::create(['name' => 'operar reunion']);
        Permission::create(['name' => 'participar reunion']);
        Permission::create(['name' => 'observar reunion']);
        Permission::create(['name' => 'ver votaciones']);

        $moderator->givePermissionTo([
            'listar reuniones','crear reuniones','mostrar reuniones', 'actualizar reuniones', 'borrar reuniones'
        ]);
        $participant->givePermissionTo([
           'participar reunion' , 'ver votaciones'
        ]);
        $observer->givePermissionTo([
            'observar reunion' , 'ver votaciones'
        ]);
    }
}
