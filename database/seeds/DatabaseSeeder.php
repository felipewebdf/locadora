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
        $this->call(BrandSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(UsersInitSeeder::class);
        $this->call(TypeRentDefault::class);
    }
}
