<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles are present
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create the admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('123456789'),
                'phone'=>'123456789',
                'role_id' => $adminRole->id
            ]
        );

        // Assign the admin role to the user
        if ($user->wasRecentlyCreated || !$user->role_id) {
            $user->role_id = $adminRole->id;
            $user->save();
        }

        User::factory()->count(10)->create([
            'role_id' => $userRole->id,
        ]);

    }
}
