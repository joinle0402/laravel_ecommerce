<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->truncate();
        User::factory()->count(50)->create();
        User::factory()->create([
            'name' => 'John Smith',
            'email' => 'johnsmith2001it@gmail.com',
            'password' => Hash::make('1106'),
        ]);
    }
}
