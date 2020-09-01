<?php
/**
 *  database/seeds/PermissionsSeeder.php
 *
 * User:
 * Date-Time: 01.09.20
 * Time: 13:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'create user']);

        $role1 = Role::create(['name' => 'administrator']);
        $role1->givePermissionTo('read');
        $role1->givePermissionTo('create');
        $role1->givePermissionTo('update');
        $role1->givePermissionTo('delete');
        $role1->givePermissionTo('create user');


        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('read');
        $role2->givePermissionTo('create');
        $role2->givePermissionTo('update');

        $role3 = Role::create(['name' => 'accountant']);
        $role3->givePermissionTo('read');

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Administrator User',
            'email' => 'administrator@example.com',
            'deleted_at' => 'null'
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'deleted_at' => 'null'
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Accountant user',
            'email' => 'accountant@example.com',
            'deleted_at' => 'null'
        ]);
        $user->assignRole($role3);

    }
}
