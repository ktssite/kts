<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use \KTS\Models\User;

class ZAdminRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name','Admin')->first(); 
        if ($admin) {
            $admin->givePermissionTo(Permission::all());
        }

        //create user
        $user = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@kts.com',
            'password' => Hash::make('admin999'),
        ]);

        $user->assignRole('Admin');
    }
}
