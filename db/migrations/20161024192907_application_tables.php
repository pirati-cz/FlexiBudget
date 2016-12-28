<?php

use Phinx\Migration\AbstractMigration;

class ApplicationTables extends AbstractMigration
{

    /**
     * Change Method.
     */
    public function change()
    {
        // Migration for table Budget
        $table = $this->table('Budget');
        $table
            ->addColumn('Name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('approval_at', 'date', ['null' => true])
            ->addColumn('Year', 'integer', ['limit' => 4])
            ->addColumn('Created', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('Creator', 'integer', ['limit' => 11])
            ->addColumn('Goodman', 'integer', ['limit' => 11])
            ->addForeignKey('Creator', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('Goodman', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();


        // Migration for table BudgetRecord
        $table = $this->table('BudgetRecord');
        $table
            ->addColumn('Name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('Number', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('Limit', 'decimal', ['null' => true])
            ->addColumn('Budget_id', 'integer', ['limit' => 11])
            ->addForeignKey('Budget_id', 'Budget', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();


        // Migration for table Intend
        $table = $this->table('Intend');
        $table
            ->addColumn('Limit', 'decimal', ['null' => true])
            ->addColumn('Name', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('Description', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('Begin', 'date', ['null' => true])
            ->addColumn('End', 'date', ['null' => true])
            ->addColumn('AcceptURL', 'string', ['null' => true, 'limit' => 256])
            ->addColumn('approval_at', 'date', ['null' => true])
            ->addColumn('Created', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('Creator', 'integer', ['limit' => 11])
            ->addColumn('Goodman', 'integer', ['limit' => 11])
            ->addForeignKey('Creator', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('Goodman', 'user', 'id',
                ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
//            ->addIndex(['Name', 'Description'], ['unique' => true])            
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
