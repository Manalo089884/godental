<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'user_management_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'brand_create',
            'brand_edit',
            'brand_delete',
            'brand_export',
            'brand_access',
            'category_create',
            'category_edit',
            'category_delete',
            'category_show',
            'category_access',

        ];
        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }



        //create roles and assign created permissions
        //admin
        $admin = Role::create(['name' => 'Super Admin']);
        $admin->givePermissionTo(Permission::all());
        $manager = Role::create(['name' => 'manager']);

        $managerpermissions = [



            'brand_access',
        ];

        foreach($managerpermissions as $permission){
            $manager->givePermissionTo($permission);
        }



        Role::create(['name' => 'inventory']);


    }
}
