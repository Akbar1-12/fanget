<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Victor',
            'artist_name' => 'Camilla',
            'email' => 'artist@fanget.com',
            'password' => Hash::make('password'),
            'is_approved' => true,
        ]);

        $this->command->info("Created user ID: {$user->id}");
    }
}
