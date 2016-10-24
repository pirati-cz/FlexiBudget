<?php

use Phinx\Migration\AbstractMigration;

class InitialUsers extends AbstractMigration
{
    /**
     */
    public function change()
    {
        $this->execute('INSERT INTO "user" ("email","login","password","firstname","lastname","DatCreate") VALUES ( \'vitex@arachne.cz\' , \'vitex\' , \'7254a96290b564d1b0cd85b9881b6b1a:b3\' , \'Vítězslav\' , \'Dvořák\' ,NOW())');
    }
}
