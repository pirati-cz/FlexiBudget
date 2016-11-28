<?php

use Phinx\Seed\AbstractSeed;

class IntendSeeder extends AbstractSeed
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
        $table = $this->table('Intend');
        $table->insert(['name' => 'Intend 1']);
        $table->insert(['name' => 'Intend 2']);
        $table->insert(['name' => 'Intend 3']);
        $table->insert(['name' => 'Intend 4']);
        $table->insert(['name' => 'Intend 5']);
        $table->insert(['name' => 'Intend 6']);
        $table->insert(['name' => 'Intend 7']);
        $table->saveData();
    }
}
