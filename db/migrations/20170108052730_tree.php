<?php

use Phinx\Migration\AbstractMigration;

class Tree extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('tree_data', ['collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('nm', 'string')
            ->addColumn('icon', 'string')
            ->addColumn('url', 'string')
            ->create();


        // Migration for table tree_struct
        $table = $this->table('tree_struct', ['collation' => 'utf8mb4_unicode_ci']);
        $table
            ->addColumn('lft', 'integer', ['signed' => false])
            ->addColumn('rgt', 'integer', ['signed' => false])
            ->addColumn('lvl', 'integer', ['signed' => false])
            ->addColumn('pid', 'integer', ['signed' => false])
            ->addColumn('pos', 'integer', ['signed' => false])
            ->create();

    }
}
