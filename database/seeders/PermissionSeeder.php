<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'dashboard',

            'categories',
            'categories.category_level_0.create',
            'categories.category_level_0.view',
            'categories.category_level_0.edit',
            'categories.category_level_0.delete',
            'categories.category_level_1.create',
            'categories.category_level_1.view',
            'categories.category_level_1.edit',
            'categories.category_level_1.delete',
            'categories.category_level_2.create',
            'categories.category_level_2.view',
            'categories.category_level_2.edit',
            'categories.category_level_2.delete',
            'content',
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role_admin = Role::firstOrCreate(['name' => 'admin']);
        $role_superadmin = Role::firstOrCreate(['name' => 'superadmin']);

        $role_admin->syncPermissions(Permission::all());
        $role_superadmin->syncPermissions(Permission::all());

        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $superadminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'superadmin');
        })->get();

        foreach ($adminUsers as $user) {
            $user->syncPermissions(Permission::all());
        }

        foreach ($superadminUsers as $user) {
            $user->syncPermissions(Permission::all());
        }
    }
}
