<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'=>'Diego',
        	'email'=>'diant2405@gmail.com',
        	'password'=>bcrypt('123456'),
        ]);
    }
}
