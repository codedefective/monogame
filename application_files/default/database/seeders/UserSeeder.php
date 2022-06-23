<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            'username' => 'behzat123',
            'firstname' => 'Behzat',
            'lastname' => 'Cozer',
            'email' => 'behzat.php@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $id = DB::getPdo()->lastInsertId();

        DB::table('wallets')->insertOrIgnore([
            'player_id' => $id,
            'currency' => 'EUR',
            'wallet_type' => 1,
            'host' => 'http://monowallet.erdemakbulut.com.tr/api/v3',
        ]);

        User::factory()->count(5)->create();
    }
}
