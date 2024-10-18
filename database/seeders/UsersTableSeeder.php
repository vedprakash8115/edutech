<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => 'Admin@123',
                'role' => 'admin',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'superadmin@123',
                'role' => 'superadmin',
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@gmail.com',
                'password' => 'Admin@123',
                'role' => 'teacher',
            ],
            [
                'name' => 'Agent',
                'email' => 'agent@gmail.com',
                'password' => 'Admin@123',
                'role' => 'agent',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => 'Admin@123',
                'role' => 'student',
            ],
        ];

        // Ensure the roles exist
        foreach (['admin', 'superadmin','teacher','agent','student'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create users and assign roles
        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
            $created_user->assignRole($user['role']);
        }
    }
}