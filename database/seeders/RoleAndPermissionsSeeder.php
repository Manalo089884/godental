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
            'role_create',
            'role_edit',
            'role_show',
            'role_access',
            'role_delete',
            'user_management_access',
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'customer_access',
            'brand_create',
            'brand_edit',
            'brand_delete',
            'brand_export',
            'brand_access',
            'category_create',
            'category_edit',
            'category_delete',
            'category_export',
            'category_access',
            'supplier_access',
            'supplier_archive_access',
            'supplier_create',
            'supplier_show',
            'supplier_edit',
            'supplier_archive',
            'supplier_restore',
            'supplier_forcedelete',
            'supplier_export',
            'product_access',
            'product_archive_access',
            'product_create',
            'product_edit',
            'product_show',
            'product_archive',
            'product_export',
            'product_restore',
            'product_forcedelete',
            'analytics_access',
            'report_access',
            'order_access',
            'post_access',
            'chat_access',

        ];
        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        //create roles and assign created permissions
        //Super Admin
        $admin = Role::create(['name' => 'Super Admin']);
        $admin->givePermissionTo(Permission::all());


        $manager = Role::create(['name' => 'Manager']);

        $managerpermissions = [
            'brand_access',
            'category_access',
            'supplier_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_access',
            'role_delete',
            'user_management_access',
        ];

        foreach($managerpermissions as $permission){
            $manager->givePermissionTo($permission);
        }

        $inventory = Role::create(['name' => 'Inventory']);
        $inventory->givePermissionTo(Permission::all());

    }
}
