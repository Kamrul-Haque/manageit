<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\Admin;
        $admin->name = "Admin";
        $admin->email = "admin@email.com";
        $admin->password = Hash::make('Admin.12345');
        $admin->job_title = "Admin";
        $admin->nid = 9876543210;
        $admin->phone = 9876543210;
        $admin->save();
    }
}
