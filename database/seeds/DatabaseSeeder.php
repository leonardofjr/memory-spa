<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PortfolioEntryTypeDropDownsTableSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(UserSeeder::class);
    }
}
