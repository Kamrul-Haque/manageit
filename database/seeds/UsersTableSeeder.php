<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = "User";
        $user->email = "user@email.com";
        $user->password = Hash::make('User.12345');
        $user->job_title = "User";
        $user->nid = 9876543210;
        $user->phone = 9876543210;
        $user->save();
    }
}
