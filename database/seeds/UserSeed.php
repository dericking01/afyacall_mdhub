<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'calls@afyacall.com',
            'phone' => '0746805383',
            'password' => bcrypt('afyacall1234')
        ]);
        $user->assignRole('administrator');

    }
}
