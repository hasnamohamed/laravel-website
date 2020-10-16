<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@website.com',
            'password' => bcrypt('123456'),
            'group' => 'admin'
        ]);
    }
}
