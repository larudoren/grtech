<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@grtech.com.my";
        $user->password = bcrypt('password'); 
        $user->save();


        $user = new User;
        $user->name = "User";
        $user->email = "user@grtech.com.my";
        $user->password = bcrypt('password'); 
        $user->save();
    }
}
