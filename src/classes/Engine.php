<?php
namespace FlexiBudget;

/**
 * Description of Engine
 *
 * @author vitex
 */
class Engine extends \Ease\Brick
{
    /**
     * Cloumn of record that contain Name
     * @var string
     */
    public $nameColumn = null;

    /**
     * App Engine Class
     *
     * @param mixed $init
     */
    public function __construct($init = null)
    {
        parent::__construct();
        if (is_integer($init)) {
            $this->loadFromSQL($init);
        } elseif (is_string($init)) {
            $this->setmyKeyColumn($this->nameColumn);
            $this->loadFromSQL($init);
            $this->restoreObjectIdentity();
        }
    }

    /**
     * Obtain contents of field $this->nameColumn
     *
     * @return string
     */
    public function getRecordName()
    {
        return $this->getDataValue($this->nameColumn);
    }
}