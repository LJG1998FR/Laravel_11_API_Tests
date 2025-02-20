<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\UserStatus;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'firstname' => 'test123',
            'lastname' => 'Dev',
            'email' => 'test123@test.dev',
            'image_path' => '20250220_010100_img0001.png',
            'status' => UserStatus::ACTIF->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'firstname' => 'Jean',
            'lastname' => 'Valjean',
            'email' => 'j.valjean@test.dev',
            'image_path' => '20250220_010500_img0002.png',
            'status' => UserStatus::ACTIF->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'firstname' => 'Monsieur',
            'lastname' => 'Olive',
            'email' => 'm.olive@test.dev',
            'image_path' => '20250220_010600_img0003.png',
            'status' => UserStatus::EN_ATTENTE->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'firstname' => 'Colonel',
            'lastname' => 'Moutarde',
            'email' => 'c.moutarde@test.dev',
            'image_path' => '20250220_010650_img0004.png',
            'status' => UserStatus::INACTIF->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
