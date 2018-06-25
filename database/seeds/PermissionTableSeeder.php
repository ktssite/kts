<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'user-change-status'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
