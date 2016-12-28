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
        $table->insert(['Name' => 'Intend 1','Description'=>'Desc 1','Created'=>'NOW()','Creator'=>2,'Goodman'=>'2','Begin'=>'2017-01-01','End'=>'2017-01-31','Limit'=>5000,'AcceptURL'=>'https://pirati.cz/yes.json']);
        $table->insert(['Name' => 'Intend 2','Description'=>'Desc 2','Created'=>'NOW()','Creator'=>3,'Goodman'=>'4','Begin'=>'2017-02-01','End'=>'2017-02-28','Limit'=>1000,'AcceptURL'=>'https://pirati.cz/no.json']);
        $table->insert(['Name' => 'Intend 3','Description'=>'Desc 3','Created'=>'NOW()','Creator'=>2,'Goodman'=>'3','Begin'=>'2017-03-01','End'=>'2017-03-31','Limit'=>15000,'AcceptURL'=>'https://pirati.cz/result.php']);
        $table->insert(['Name' => 'Intend 4','Description'=>'Desc 4','Created'=>'NOW()','Creator'=>3,'Goodman'=>'5','Begin'=>'2017-04-01','End'=>'2017-04-30','Limit'=>20000,'AcceptURL'=>'https://pirati.cz/voter.php?id=254']);
        $table->insert(['Name' => 'Intend 5','Description'=>'Desc 5','Created'=>'NOW()','Creator'=>2,'Goodman'=>'2','Begin'=>'2017-05-01','End'=>'2017-05-31','Limit'=>25000,'AcceptURL'=>'https://pirati.cz/yes2.json']);
        $table->insert(['Name' => 'Intend 6','Description'=>'Desc 6','Created'=>'NOW()','Creator'=>3,'Goodman'=>'5','Begin'=>'2017-06-01','End'=>'2017-06-30','Limit'=>30000,'AcceptURL'=>'https://pirati.cz/yes4.json']);
        $table->insert(['Name' => 'Intend 7','Description'=>'Desc 7','Creator'=>2,'Goodman'=>'8','Begin'=>'2017-07-01','End'=>'2017-07-31','Limit'=>35000]);
        $table->saveData();
    }
}
