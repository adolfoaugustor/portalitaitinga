<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adolfoaugustor@gmail.com'],
            [
                'name' => 'Adolfo Aero Websites',
                'organization_type' => 'company',
                'is_super_admin' => true,
                'password' => Hash::make('senha123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'company@portal.local'],
            [
                'name' => 'Organization Company',
                'organization_type' => 'company',
                'is_super_admin' => false,
                'password' => Hash::make('senha123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'informal@portal.local'],
            [
                'name' => 'Organization Informal Seller',
                'organization_type' => 'informal_seller',
                'is_super_admin' => false,
                'password' => Hash::make('senha123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'service@portal.local'],
            [
                'name' => 'Organization Service Provider',
                'organization_type' => 'service_provider',
                'is_super_admin' => false,
                'password' => Hash::make('senha123'),
            ]
        );

        $this->command->info('Seed complete: super admin + organization users created.');
        $this->command->info('Super admin login: adolfoaugustor@gmail.com / senha123');
    }
}
