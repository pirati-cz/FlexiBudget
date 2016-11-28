<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        $table = $this->table('user');

        $vitex = [
            'email' => 'info@vitexsoftware.cz',
            'login' => 'vitex',
            'password' => '7254a96290b564d1b0cd85b9881b6b1a:b3',
            'firstname' => 'Vítězslav',
            'lastname' => 'Dvořák',
            'DatCreate' => 'NOW()'];

        $table->insert($vitex);
        $table->saveData();


        $faker = Faker\Factory::create();
        $data  = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'login' => $faker->userName,
                'password' => sha1($faker->password),
                'email' => $faker->email,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'DatCreate' => date('Y-m-d H:i:s'),
            ];
        }

        $this->insert('user', $data);
    }
}
