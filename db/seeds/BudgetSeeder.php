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
        $table->insert(['Name' => 'Budget 1','Year'=>2016,'Created'=>'NOW()','Creator'=>2,'Goodman'=>'2']);
        $table->insert(['Name' => 'Budget 2','Year'=>2016,'Created'=>'NOW()','Creator'=>3,'Goodman'=>'4']);
        $table->insert(['Name' => 'Budget 3','Year'=>2016,'Created'=>'NOW()','Creator'=>2,'Goodman'=>'3']);
        $table->insert(['Name' => 'Budget 4','Year'=>2016,'Created'=>'NOW()','Creator'=>3,'Goodman'=>'5']);
        $table->insert(['Name' => 'Budget 5','Year'=>2016,'Created'=>'NOW()','Creator'=>2,'Goodman'=>'2']);
        $table->insert(['Name' => 'Budget 6','Year'=>2016,'Created'=>'NOW()','Creator'=>3,'Goodman'=>'5']);
        $table->insert(['Name' => 'Budget 7','Year'=>2017,'Creator'=>2,'Goodman'=>'8']);
        $table->saveData();
    }
}
