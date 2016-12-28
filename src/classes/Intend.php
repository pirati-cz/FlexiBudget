<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Intend Class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class Intend extends VoteSubject
{
    /**
     * Agenda keyword
     * @var string
     */
    public $keyword = 'intend';

    /**
     * We work with table
     * @var string
     */
    public $myTable = 'Intend';

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
        'Limit' => ['type' => 'decimal'],
        'Name' => ['type' => 'string'],
        'Description' => ['type' => 'string', 'limit' => 45],
        'Creator' => ['type' => 'user'],
        'Goodman' => ['type' => 'goodman'],
        'approval_at' => ['type' => 'date'],
        'Begin' => ['type' => 'date'],
        'End' => ['type' => 'date'],
        'AcceptURL' => ['type' => 'string'],
    ];

    /**
     * 
     * @param mixed $init
     */
    public function __construct($init = null)
    {
        $this->columns['Limit']['title']       = _('Limit');
        $this->columns['Name']['title']        = _('Name');
        $this->columns['Description']['title'] = _('Description');
        $this->columns['approval_at']['title'] = _('Approval At');
        $this->columns['Goodman']['title']     = _('Goodman');
        $this->columns['Creator']['title']     = _('Creator');
        $this->columns['Creator']['default']   = \Ease\Shared::user()->getUserID();
        $this->columns['Begin']['title']       = _('Valid From');
        $this->columns['End']['title']         = _('Valit To');
        $this->columns['AcceptURL']['title']   = _('Accept URL');

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
        $creator        = User::icoLink($row['Creator'],
                ['class' => 'list-icon']);
        $creator->addItem(' '.$creator->getTagProperty('data-name'));
        $row['Creator'] = (string) $creator;
        $goodman        = User::icoLink($row['Goodman'],
                ['class' => 'list-icon']);
        $goodman->addItem(' '.$goodman->getTagProperty('data-name'));
        $row['Goodman'] = (string) $goodman;
        $row['AcceptURL'] = '<a href="'.$row['AcceptURL'].'">'.$row['AcceptURL'].'</a>';
        return parent::htmlizeRow($row);
    }
}
