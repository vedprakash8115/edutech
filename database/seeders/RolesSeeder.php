<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin     = Role::firstOrCreate(['name' => 'admin']);
        $role_superadmin= Role::firstOrCreate(['name' => 'superadmin']);
        $role_teacher   = Role::firstOrCreate(['name' => 'teacher']);
        $role_student   = Role::firstOrCreate(['name' => 'student']);
        $role_student   = Role::firstOrCreate(['name' => 'agent']);
    }
}
