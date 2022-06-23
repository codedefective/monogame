<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ]);

        Administrator::factory()->count(1)->create();
    }
}
