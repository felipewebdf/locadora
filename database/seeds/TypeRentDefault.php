<?php

use Illuminate\Database\Seeder;

class TypeRentDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Domain\TypeRent::create([
            'id' => 1,
            'name' => 'Diária',
        ]);
        \App\Domain\TypeRent::create([
            'id' => 2,
            'name' => 'Mensal'
        ]);
    }
}
