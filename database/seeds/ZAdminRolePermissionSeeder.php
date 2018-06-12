<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    }
}
