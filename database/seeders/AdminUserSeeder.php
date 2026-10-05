<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@acala.id'],
            [
                'name'     => 'Acala Admin',
                'password' => Hash::make('acala2024'),
            ]
        );

        $this->command->info('Admin user created: admin@acala.id / acala2024');
    }
}
