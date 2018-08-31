<?php

use Illuminate\Database\Seeder;

class UsersInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'id' => 1,
            'name' => 'felipewebdf',
            'email' => 'felipegunsf@gmail.com',
            'password' => '$2y$10$cthW4VI7eiLAecIWkXVUce2HkJnKqN6EqW20sqJ3YiYIejlQW3oFi',
            'created_at' => (new DateTime())->format('Y-m-d'),
            'is_verified' => true
        ]);
        \App\User::create([
            'id' => 2,
            'name' => 'testeunitario',
            'email' => 'tested@teste.com',
            'password' => '$2y$10$cthW4VI7eiLAecIWkXVUce2HkJnKqN6EqW20sqJ3YiYIejlQW3oFi',
            'created_at' => (new DateTime())->format('Y-m-d'),
            'is_verified' => true
        ]);
    }
}
