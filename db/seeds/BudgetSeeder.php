<?php

use Phinx\Seed\AbstractSeed;

class BudgetSeeder extends AbstractSeed
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
        $table = $this->table('Budget');
        $table->insert(['name' => 'Budget 1']);
        $table->insert(['name' => 'Budget 2']);
        $table->insert(['name' => 'Budget 3']);
        $table->insert(['name' => 'Budget 4']);
        $table->insert(['name' => 'Budget 5']);
        $table->insert(['name' => 'Budget 6']);
        $table->insert(['name' => 'Budget 7']);
        $table->saveData();
    }
}
