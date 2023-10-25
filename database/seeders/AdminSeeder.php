<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create new user with role admin
        // User::truncate();

        $users = [
            [
                'email'         => 'admin@admin.com',
                'name'          => 'ADMINISTRATOR',
                'password'      => bcrypt('234234'),
                'roles'       => 'ADMIN'
            ],
        ];

        User::insert($users);
        // \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin123'),
        //     'roles' => 'ADMIN',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Manager',
        //     'email' => 'manager@gmail.com',
        //     'password' => bcrypt('manager123'),
        //     'roles' => 'MANAGER',
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => bcrypt('user123'),
        //     'roles' => 'USER',
        // ]);
    }
}
