<?php

use Phinx\Migration\AbstractMigration;

class ApplicationTables extends AbstractMigration
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
        // Migration for table Budget
        $table = $this->table('Budget');
        $table
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('approval_at', 'date', ['null' => true])
            ->create();


        // Migration for table BudgetRecord
        $table = $this->table('BudgetRecord');
        $table
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('number', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('limit', 'decimal', ['null' => true])
            ->addColumn('Budget_id', 'integer', ['limit' => 11])
            ->addColumn('user_id', 'integer', ['limit' => 11])
            ->addForeignKey('Budget_id', 'Budget', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('user_id', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();


        // Migration for table Intend
        $table = $this->table('Intend');
        $table
            ->addColumn('limit', 'decimal', ['null' => true])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('description', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('approval_at', 'date', ['null' => true])
            ->create();


        // Migration for table Invoice
        $table = $this->table('Invoice');
        $table
            ->addColumn('value', 'decimal', ['null' => true])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('description', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('created_ad', 'date', ['null' => true])
            ->addColumn('approval_at', 'date', ['null' => true])
            ->addColumn('paid_at', 'date', ['null' => true])
            ->addColumn('user_id', 'integer', ['limit' => 11])
            ->addColumn('BudgetRecord_id', 'integer', ['limit' => 11])
            ->addColumn('Intend_id', 'integer', ['limit' => 11])
            ->addForeignKey('user_id', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('BudgetRecord_id', 'BudgetRecord', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('Intend_id', 'Intend', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();



        // Migration for table Voting
        $table = $this->table('Voting');
        $table
            ->addColumn('subject', 'string', ['limit' => 64])
            ->addColumn('subject_id', 'integer', ['limit' => 11])
            ->addColumn('user_id', 'integer', ['limit' => 11])
            ->addColumn('vote', 'boolean', ['null' => true])
            ->addColumn('when', 'datetime', ['null' => true])
            ->addIndex(['subject', 'subject_id', 'user_id'], ['unique' => true])
//            ->addForeignKey('subject_id', 'Intend', 'id',
//                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
//            ->addForeignKey('subject_id', 'Budget', 'id',
//                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
//            ->addForeignKey('user_id', 'user', 'id',
//                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();
    }
}
