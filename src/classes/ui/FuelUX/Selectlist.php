<?php
/**
 * FlexiBudget - FuelUX SelectList.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */

namespace FlexiBudget\ui\FuelUX;

/**
 * Description of Selectlist
 *
 * @author vitex
 */
class Selectlist extends \Ease\TWB\ButtonGroup
{
    /**
     * Name for returned value field
     * @var string
     */
    public $name = 'Selectlist';

    /**
     * ListSelect items
     * @var \Ease\Html\UlTag
     */
    public $items = [];

    /**
     * Select Properties
     * @var string 
     */
    public $init = '';

    /**
     * FuelUX SelectList
     *
     * @param string $name   ID of select
     * @param string $value  Value
     */
    public function __construct($name, $value = null)
    {
        $this->name = $name;
        parent::__construct($name);
        $this->addTagClass('selectlist');
        $this->setTagProperties(['data-resize' => 'auto', 'data-initialize' => 'selectlist']);
        $this->setTagID('Selectlist'.$name);
        
        if(isset($value)){
          $this->init = "'selectByValue', ".$value;
        }

        $this->addButton([
            new \Ease\Html\Span('&nbsp;', ['class' => 'selected-label']),
            new \Ease\Html\Span('', ['class' => 'caret']),
            new \Ease\Html\Span(_('Toggle Dropdown'), ['class' => 'sr-only'])
            ], 'default',
            ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'type' => 'button']);

        $this->items = $this->addItem(new \Ease\Html\UlTag(null,
            ['class' => 'dropdown-menu', 'role' => 'menu']));
    }

    /**
     * Add SelectList item
     *
     * @param string $label
     * @param string $value
     *
     * @return \Ease\Html\LiTag item inserted
     */
    public function addSelectListItem($label, $value)
    {
        return $this->items->addItemSmart(new \Ease\Html\ATag('#', $label),
                ['data-value' => $value]);
    }

    /**
     * Add Hidden input
     */
    public function finalize()
    {
        \Ease\TWB\Part::twBootstrapize();

        \Ease\Shared::webPage()->body->addTagClass('fuelux');
        \Ease\Shared::webPage()->includeCss('twitter-bootstrap/css/fuelux.css',
            true);

        \Ease\Shared::webPage()->includeJavascript('/javascript/twitter-bootstrap/fuelux.js');
        \Ease\Shared::webPage()->addJavascript("$('#".$this->getTagID()."').selectlist(". $this->init .");");

        $this->addItem(new \Ease\Html\InputTextTag($this->name, null,
            ['class' => 'hidden hidden-field', 'readonly' => 'readonly', 'aria-hidden' => 'true']));
        parent::finalize();
    }
}
