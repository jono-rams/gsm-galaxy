<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            [
                'name' => 'John Doe',
                'email' => 'johndoe@mail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('Password1'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role' => 'admin',
                'xp_points' => 750,
                'vip_tier' => 'Gold',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@mail.com',
                'password' => Hash::make('Password1'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role' => 'user',
                'xp_points' => 300,
                'vip_tier' => 'Silver',
            ],
            [
                'name' => 'Michael Rampersad',
                'email' => 'michael.creator@email.com',
                'password' => Hash::make('Password1'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'role' => 'user',
                'xp_points' => 120,
                'vip_tier' => 'Bronze',
            ],
        ]);
    }
}
