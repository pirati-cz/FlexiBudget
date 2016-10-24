<?php
/**
 * FlexiBudget - FlexiBee instances.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2016 Vitex Software
 */

namespace FlexiBudget;

/**
 * Description of flexibees
 *
 * @author vitex
 */
class FlexiBees extends Engine
{
    public $keyword = 'flexibee';

    /**
     * Column with name of record
     * @var string
     */
    public $nameColumn = 'name';

    /**
     * We Work With Table
     * @var string
     */
    public $myTable = 'flexibees';

    /**
     * Column with record create time
     * @var string
     */
    public $myCreateColumn = 'DatCreate';

    /**
     * Column with last record upadate time
     * @var string
     */
    public $myLastModifiedColumn = 'DatSave';

    /**
     * Filter Input data
     *
     * @param array $data
     * @return int data taken count
     */
    public function takeData($data)
    {
        unset($data['class']);
        if (isset($data['id'])) {
            if (!strlen($data['id'])) {
                unset($data['id']);
            } else {
                $data['id'] = intval($data['id']);
            }
        }
        if (isset($data['rw'])) {
            $data['rw'] = true;
        } else {
            $data['rw'] = false;
        }
        return parent::takeData($data);
    }

    /**
     * Obtain link to FlexiBee webserver
     *
     * @return string
     */
    function getLink()
    {
        return $this->getDataValue('url').'/c/'.$this->getDataValue('company');
    }

    /**
     * Get Copany Identification number, establish webhook and save
     *
     * @param array $data
     * @param boolean $searchForID
     * @return int result
     */
    public function saveToSQL($data = null, $searchForID = false)
    {
        if (is_null($data)) {
            $data = $this->getData();
        }
        if (!isset($data['ic'])) {
            $flexiBeeData = new \FlexiPeeHP\Nastaveni(1, $data);
            $ic           = $flexiBeeData->getDataValue('ic');
            if (strlen($ic)) {
                $data['ic'] = intval($ic);
                $this->addStatusMessage(sprintf(_('Succesfully obtained organisation identification number #%d from FlexiBee %s'),
                        $data['ic'], $data['name']), 'success');
            } else {
                $this->addStatusMessage(sprintf(_('Cannot obtain organisation identification number for FlexiBee %s'),
                        $data['name']), 'error');
            }
        }
        if ($data['rw']) {
            //Enable ChangesAPI and establish WebHook here
        }
        return parent::saveToSQL($data, $searchForID);
    }

}
