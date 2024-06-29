<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' =>'add user']);
        Permission::create(['name' => 'block user']);
        Permission::create(['name' => 'unblock user']);
        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'view category']);
        Permission::create(['name' => 'viewAny category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'add tag']);
        Permission::create(['name' => 'edit tag']);
        Permission::create(['name' => 'view tag']);
        Permission::create(['name' => 'viewAny tag']);
        Permission::create(['name' => 'delete tag']);

        $role = Role::create(['name'=>'admin']);
        $role->givePermissionTo(['add user','block user','unblock user','add category','view category','viewAny category','delete category','add tag','edit tag','viewAny tag','view tag','delete tag']);

    } 
}