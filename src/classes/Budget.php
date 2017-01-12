<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Budget Class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class Budget extends Engine
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
    public $nameColumn = 'Name';

    /**
     * Colum with record-create time
     * @var string 
     */
    public $myCreateColumn = 'Created';

    /**
     * Columns to show
     * @var type
     */
    public $columns = [
//        'limit' => ['type' => 'decimal'],
        'Creator' => ['type' => 'user'],
        'Goodman' => ['type' => 'goodman'],
        'Name' => ['type' => 'string'],
        'Year' => ['type' => 'integer'],
//        'description' => ['type' => 'string', 'limit' => 45],
        'approval_at' => ['type' => 'date'],
//        'limit' => ['type' => 'decimal'],
    ];

    /**
     * Budget Object
     * 
     * @param mixed $init
     */
    public function __construct($init = null)
    {
//        $this->columns['limit']['title']       = _('Limit');
        $this->columns['Name']['title']        = _('Name');
        $this->columns['Year']['title']        = _('Year');
        $this->columns['Goodman']['title']     = _('Goodman');
        $this->columns['Creator']['title']     = _('Creator');
        $this->columns['Creator']['default']   = \Ease\Shared::user()->getUserID();
        $this->setDataValue('Creator', $this->columns['Creator']['default']);
//        $this->columns['description']['title'] = _('Description');
        $this->columns['approval_at']['title'] = _('Approval At');
        parent::__construct($init);
    }

    /**
     * Prepare row to show as html
     * 
     * @param array $row
     * @return array
     */
    public function htmlizeRow($row)
    {
        $creator        = User::icoLink($row['Creator'], ['class' => 'list-icon']);
        $creator->addItem(' '.$creator->getTagProperty('data-name'));
        $row['Creator'] = (string) $creator;
        $goodman        = User::icoLink($row['Goodman'], ['class' => 'list-icon']);
        $goodman->addItem(' '.$goodman->getTagProperty('data-name'));
        $row['Goodman'] = (string) $goodman;
        return parent::htmlizeRow($row);
    }

    /**
     * Insert new Budget into database
     * 
     * @param array $data
     * @return int record id
     */
    public function insertToSQL($data = null)
    {
        if(is_null($data)){
            $data = $this->getData();
        }
        
        $resultID = parent::insertToSQL($data);
        $treedata = new TreeData(['structure_table' => 'tree_struct', 'data_table' => 'tree_data',
            'data' => ['nm','icon']]);
        $budgetNodeID = $treedata->addNode($data['Name'].' '.$data['Year'],'images/budget.svg','budget.php?id='.$resultID);

        $treedata->addNode(sprintf( _('new intend for %s'), $this->getName() ), 'images/intend.svg', 'intend.php?budget_id='.$resultID, $budgetNodeID, 0, 0, 1);
        
        return $resultID;
    }
}
