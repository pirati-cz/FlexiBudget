<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Engine.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class Engine extends \Ease\Brick
{
    /**
     * Keyword
     *
     * @var string
     */
    public $keyword = null;

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
        if (is_null($this->keyword)) {
            $this->keyword = $this->getMyTable();
        }
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
     * Take only columns defined in $this->columns
     *
     * @param array $data
     * @return int columns takn
     */
    public function takeData($data)
    {
        foreach ($data as $columnName => $columnValue) {
            if (!array_key_exists($columnName, $this->columns) && ($columnName != 'id')) {
                unset($data[$columnName]);
            }
        }
        return parent::takeData($data);
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

    /**
     * Vrací všechny záznamy jako html
     *
     * @param array $data
     * @return array
     */
    public function htmlizeData($data)
    {
        if (is_array($data) && count($data)) {
            foreach ($data as $rowId => $row) {
                $htmlized = $this->htmlizeRow($row);
                if (is_array($htmlized)) {
                    foreach ($htmlized as $key => $value) {
                        if (!is_null($value)) {
                            $data[$rowId][$key] = $value;
                        } else {
                            if (!isset($data[$rowId][$key])) {
                                $data[$rowId][$key] = $value;
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Vrací řádek dat v HTML interpretaci
     *
     * @param array $row
     * @return array
     */
    public function htmlizeRow($row)
    {
        if (is_array($row) && count($row)) {
            foreach ($row as $key => $value) {
                if ($key == $this->myKeyColumn) {
                    continue;
                }
                if (!isset($this->useKeywords[$key])) {
                    continue;
                }
                $fieldType = $this->useKeywords[$key];
                $fType     = preg_replace('/\(.*\)/', '', $fieldType);
                switch ($fType) {
                    case 'BOOL':
                        if (is_null($value) || !strlen($value)) {
                            $row[$key] = '<em>NULL</em>';
                        } else {
                            if ($value === '0') {
                                $row[$key] = \Ease\TWB\Part::glyphIcon('unchecked')->__toString();
                            } else {
                                if ($value === '1') {
                                    $row[$key] = \Ease\TWB\Part::glyphIcon('check')->__toString();
                                }
                            }
                        }
                        break;
                    case 'IDLIST':
                        if (!is_array($value) && strlen($value)) {
                            if (strstr($value, ':{')) {
                                $values = unserialize(stripslashes($value));
                            } else {
                                $values = ['0' => $value];
                            }
                            if (!is_array($values)) {
                                $this->addStatusMessage(sprintf(_('Unserialization error %s #%s '),
                                        $value, $key));
                            }
                            if (isset($this->columns[$key]['refdata'])) {
                                $idcolumn     = $this->columns[$key]['refdata']['idcolumn'];
                                $table        = $this->columns[$key]['refdata']['table'];
                                $searchColumn = $this->columns[$key]['refdata']['captioncolumn'];
                                $target       = str_replace('_id', '.php',
                                    $idcolumn);
                                foreach ($values as $id => $name) {
                                    if ($id) {
                                        $values[$id] = '<a title="'.$table.'" href="'.$target.'?'.$idcolumn.'='.$id.'">'.$name.'</a>';
                                    } else {
                                        $values[$id] = '<a title="'.$table.'" href="search.php?search='.$name.'&table='.$table.'&column='.$searchColumn.'">'.$name.'</a> '.\Ease\TWB\Part::glyphIcon('search');
                                    }
                                }
                            }
                            $value     = implode(',', $values);
                            $row[$key] = $value;
                        }
                        break;
                    default :
                        if (isset($this->columns[$key]['refdata']) && strlen(trim($value))) {
                            $table        = $this->columns[$key]['refdata']['table'];
                            $searchColumn = $this->columns[$key]['refdata']['captioncolumn'];
                            $row[$key]    = '<a title="'.$table.'" href="search.php?search='.$value.'&table='.$table.'&column='.$searchColumn.'">'.$value.'</a> '.\Ease\TWB\Part::glyphIcon('search');
                        }
                        if (strstr($key, 'url')) {
                            $row[$key] = '<a href="'.$value.'">'.$value.'</a>';
                        }

                        break;
                }
            }
        }
        return $row;
    }

    /**
     * Připaví data na export jak CSV
     *
     * @param array $data
     * @return array
     */
    public function csvizeData($data)
    {
        if (is_array($data) && count($data)) {
            foreach ($data as $rowId => $row) {
                foreach ($row as $column => $value) {
                    if (strstr($value, ':{')) {
                        $value = unserialize($value);
                        if (is_array($value)) {
                            $data[$rowId][$column] = implode('|', $value);
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Add input widget for one column
     *
     * @param string $columnName
     * @param array $properties Forced input properties
     * @return \Ease\TWB\FormGroup
     */
    public function inputWidget($columnName, $properties = [])
    {
        $value = $this->getDataValue($columnName);
        if (is_null($value) && isset($properties['default'])) {
            $value = $properties['default'];
        }
        $inputProperties = array_merge($this->columns[$columnName], $properties);
        $type            = $inputProperties['type'];
        switch ($inputProperties['type']) {
            case 'numeric':
            case 'decimal':
                $inputProperties['pattern']     = '^\d+(\.|\,)\d{2}$';
                $widget                         = new \Ease\Html\InputNumberTag($columnName,
                    $value, $inputProperties);
                break;
            case 'integer':
                $widget                         = new \Ease\Html\InputNumberTag($columnName,
                    $value, $inputProperties);
                break;
            case 'logic':
                $widget                         = new ui\TWBSwitch($columnName,
                    $value, true, $inputProperties);
                break;
            case 'date':
                $inputProperties['data-format'] = 'YYYY-MM-DD+01:00';
                $inputProperties['type']        = 'date';
                $widget                         = new ui\DateTimePicker($columnName,
                    $value, $inputProperties);
                break;
            case 'datetime':
                $inputProperties['data-format'] = 'YYYY-MM-DD\'T\'HH:mm:ss.SSS';
                $widget                         = new ui\DateTimePicker($columnName,
                    $value, $inputProperties);
                break;
            case 'user':
                $widget                         = new ui\UserSelect($columnName,
                    $value, $inputProperties);
                break;
            case 'goodman':
                $widget                         = new ui\GoodmanSelect($columnName,
                    $value, $inputProperties);
                break;
            case 'string':
                $widget                         = new \Ease\Html\InputTextTag($columnName,
                    $value, $inputProperties);
                break;
            default:
                $this->addStatusMessage(sprintf(_('Unknown type of data %s'),
                        $type), 'warning');
                $widget                         = new \Ease\Html\InputTag($columnName,
                    $value, $inputProperties);
                break;
        }
        $helptext = '';
        if (isset($this->columns[$columnName]['description'])) {
            $helptext = $this->columns[$columnName]['description'];
        }
        return new \Ease\TWB\FormGroup($this->columns[$columnName]['title'],
            $widget, $this->getDataValue($columnName), $helptext);
    }

    /**
     * Delete record
     */
    public function delete()
    {
        $result = $this->deleteFromSQL();
        if ($result === true) {
            $this->addStatusMessage(_('Record was deleted'), 'success');
        } else {
            $this->addStatusMessage(_('Record was not deleted'), 'error');
        }
        return $result;
    }

    /**
     * 
     * @return type
     */
    public function getName()
    {
        return $this->getDataValue($this->nameColumn);
    }

    /**
     * 
     * @param type $oPage
     * @return \FlexiBudget\class
     */
    static function &doThings($oPage)
    {
        $engine = null;
        $class  = $oPage->getRequestValue('class');
        if ($class) {
            $engine = new $class;
            $key    = $oPage->getRequestValue($engine->myKeyColumn);
            if ($key) {
                $engine->setMyKey((int) $key);
            }

            if ($oPage->isPosted()) {
                $engine->takeData($_POST);
                if ($engine->saveToSQL()) {
                    $engine->addStatusMessage('ok', 'success');
                } else {
                    $engine->addStatusMessage(':(', 'warning');
                }
            } else {
                $engine->loadFromMySQL();
            }
        }

        return $engine;
    }

}
