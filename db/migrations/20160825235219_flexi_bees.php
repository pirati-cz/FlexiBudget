<?php

use Phinx\Migration\AbstractMigration;

class FlexiBees extends AbstractMigration
{
    /**
     */
    public function change()
    {
        $table = $this->table('flexibees');
        $table->addColumn('name', 'string',
            ['comment' => 'FlexiBee instance Name'])
            ->addColumn('url', 'string', ['comment' => 'RestAPI endpoint url'])
            ->addColumn('user', 'string', ['comment' => 'REST API Username'])
            ->addColumn('password', 'string', ['comment' => 'Rest API Password'])
            ->addColumn('company', 'string', ['comment' => 'Company Code'])
            ->addColumn('rw', 'boolean', ['comment' => 'Read/Write access ?'])
            ->addColumn('DatCreate', 'datetime')
            ->addColumn('DatSave', 'datetime', ['null' => 'true'])
            ->addIndex(['url', 'company'],
                ['unique' => true, 'name' => 'fbs_uniq'])
            ->create();
    }
}
