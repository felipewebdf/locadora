<?php

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = '/var/www/html/locadora/database/modelos-carro.csv';
        $csv = array_map('str_getcsv', file($file));
        foreach($csv as $linha) {
            $r = explode(';', $linha[0]);
            \App\Domain\ModelCar::create(['id' => (int)$r[0], 'brand_id' => (int) $r[1], 'name' => $r[2]]);
        }

    }
}
