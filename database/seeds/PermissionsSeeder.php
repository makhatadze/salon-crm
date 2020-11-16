<?php
/**
 *  database/seeds/PermissionsSeeder.php
 *
 * User:
 * Date-Time: 01.09.20
 * Time: 13:57
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

use App\Cashier;
use App\Company;
use App\Profile;
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

        // Admin
        Permission::create(['name' => 'admin']);
        // User
        Permission::create(['name' => 'user']);

        // Employee
        Permission::create(['name' => 'see_users']);
        Permission::create(['name' => 'add_user']);
        Permission::create(['name' => 'delete_user']);
        
        // Services
        Permission::create(['name' => 'see_service']);
        Permission::create(['name' => 'add_service']);
        Permission::create(['name' => 'delete_service']);

        // Purchases
        Permission::create(['name' => 'see_purchases']);
        Permission::create(['name' => 'add_purchase']);
        Permission::create(['name' => 'delete_purchase']);

        // Products and WareHouse
        Permission::create(['name' => 'see_products']);
        Permission::create(['name' => 'add_product']);
        Permission::create(['name' => 'delete_product']);
        
        // Clients
        Permission::create(['name' => 'see_clients']);
        Permission::create(['name' => 'add_client']);
        Permission::create(['name' => 'delete_client']);

        // Finanse
        Permission::create(['name' => 'export_finances']);

        // Company
        Permission::create(['name' => 'see_company']);
        Permission::create(['name' => 'add_company']);
        Permission::create(['name' => 'delete_company']);

        // SMS
        Permission::create(['name' => 'see_sms']);
        Permission::create(['name' => 'send_sms']);
        Permission::create(['name' => 'delete_sms']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('admin');

        
        $userrole = Role::create(['name' => 'user']);
        $userrole->givePermissionTo('user');

        Company::create([
            'title_ge' => 'კომპანია',
            'description_ge' => 'ეს არის კომპანიის დეტალური აღწერა'
        ]);

        $user = Factory(App\User::class)->create([
            'name' => 'საიტის ადმინისტრატორი',
            'email' => 'administrator@example.com',
        ]);
        $user->profile()->create([
           'first_name' => 'გიორგი',
           'last_name' => 'მარგველაშვილი',
           'birthday' => '1970-00-01',
           'phone' => '551785074',
           'pid' => '54997846325',
           'salary' => 1000,
           'salary_type' => '1',
           'percent' => 0,
           'salary_status' => 1,
           'show_user' => 1,
           'brake_between_meeting' => 60
         ]);
         $user->UserHasJob()->create([
             'user_id' => $user->id,
         ]);
        $user->assignRole($role1);
        Cashier::create([
            'name' => 'main',
            'amout' => 0
        ]);
    }
}
