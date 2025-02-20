<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@test.dev',
            'password' => Hash::make("johndoe@test.dev"), // password
        ]);

        DB::table('admins')->insert([
            'firstname' => 'Jane',
            'lastname' => 'Martin',
            'email' => 'janemartin@test.dev',
            'password' => Hash::make("janemartin@test.dev"), // password
        ]);

        DB::table('admins')->insert([
            'firstname' => 'Loïc',
            'lastname' => 'Gueret',
            'email' => 'loicj.gueret@gmail.com',
            'password' => Hash::make("loicj.gueret@gmail.com"), // password
        ]);
    }
}
