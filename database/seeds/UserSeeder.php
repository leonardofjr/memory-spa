<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
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
        User::create([
            'fname' => 'Leo',
            'lname' => 'Felipa',
            'email' => 'leo@lfelipa.com',
            'phone' => '6476889189',
            'bio' => 'a',
            'skills_and_offer' => '',
            'email_verified_at'  => Carbon::now(),
            'password' =>  Hash::make('password'),
     
        ]);
    }
}
