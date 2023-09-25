<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Arturo',
            'last_name' => 'Arturo',
            'age' => 27,
            'gender' => 'Masculino',
            'is_admin' => true,
            'email' => 'arturo@arturo.com',
            'password' => Hash::make('password'),
        ]);
    }
}
