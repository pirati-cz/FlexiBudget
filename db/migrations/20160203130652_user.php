<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
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
        // Migration for table users
        $table = $this->table('user');
        $table
//                ->addColumn('parent', 'integer', array('null' => true))
            ->addColumn('settings', 'text', ['null' => true])
            ->addColumn('email', 'string', ['limit' => 128])
            ->addColumn('firstname', 'string', ['null' => true, 'limit' => 32])
            ->addColumn('lastname', 'string', ['null' => true, 'limit' => 32])
            ->addColumn('password', 'string', ['limit' => 40])
            ->addColumn('login', 'string', ['limit' => 32])
            ->addColumn('icon', 'text',['default'=>'data:image/png;base64,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'])
            ->addColumn('DatCreate', 'datetime', [])
            ->addColumn('DatSave', 'datetime', ['null' => true])
            ->addColumn('priviliges', 'string', ['null' => true, 'limit' => 45])
            ->addColumn('last_login_at', 'date', ['null' => true])
            ->addColumn('last_modifier_id', 'integer',
                ['null' => true, 'signed' => false])
            ->addIndex(['login', 'email'], ['unique' => true])
            ->create();
    }
}
