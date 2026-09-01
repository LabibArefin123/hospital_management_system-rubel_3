<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Profile
            'dashboard',
            'system_users.user_profile_show',
            'system_users.user_profile_edit',
            'system_users.user_profile_update',
        
            // Permissions & Roles
            'permissions.index',
            'permissions.create',
            'permissions.store',
            'permissions.edit',
            'permissions.update',
            'permissions.destroy',

            'roles.index',
            'roles.create',
            'roles.store',
            'roles.edit',
            'roles.update',
            'roles.destroy',

            // Users & Settings
            'system_users.index',
            'system_users.create',
            'system_users.store',
            'system_users.show',
            'system_users.edit',
            'system_users.update',
            'system_users.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assign all permissions to 'admin' role
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());
    }
}
