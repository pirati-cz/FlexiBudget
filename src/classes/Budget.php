<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Budget Class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class Budget extends VoteSubject
{
    /**
     * Agenda keyword
     * @var string
     */
    public $keyword = 'budget';

    /**
     * We work with table
     * @var string
     */
    public $myTable = 'Budget';

    /**
     * Cloumn of record that contain Name
     * @var string
     */
    public $nameColumn = 'name';

    /**
     * Columns to show
     * @var type
     */
    public $columns = [
//        'limit' => ['type' => 'decimal'],
        'name' => ['type' => 'string'],
//        'description' => ['type' => 'string', 'limit' => 45],
        'approval_at' => ['type' => 'date'],
//        'limit' => ['type' => 'decimal'],
    ];

    /**
     * 
     * @param mixed $init
     */
    public function __construct($init = null)
    {
//        $this->columns['limit']['title']       = _('Limit');
        $this->columns['name']['title']        = _('Name');
//        $this->columns['description']['title'] = _('Description');
        $this->columns['approval_at']['title'] = _('Approval At');
        parent::__construct($init);
    }

}
