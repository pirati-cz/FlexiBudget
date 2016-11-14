<?php
/**
 * FlexiBudget - BootStrap Switch.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2016 Vitex Software
 */

namespace FlexiBudget\ui;

/**
 * Description of \Ease\TWB\Switch
 *
 * @author vitex
 */
class TWBSwitch extends \Ease\Html\CheckboxTag
{
    public $properties = [];

    /**
     * Zobrazuje HTML Checkbox
     *
     * @param string $name       jméno tagu
     * @param bool   $checked    stav checkboxu
     * @param string $value      vracená hodnota checkboxu
     * @param array  $properties parametry tagu
     */
    public function __construct($name, $checked = false, $value = null,
                                $properties = [])
    {
        parent::__construct($name, $checked, $value, $properties);
        if (!isset($properties['onText'])) {
            $properties['onText'] = _('Yes');
        }
        if (!isset($properties['offText'])) {
            $properties['offText'] = _('No');
        }

        $this->setProperties($properties);
    }

    function setProperties($properties)
    {
        $this->properties = array_merge($this->properties, $properties);
    }

    function finalize()
    {
        \Ease\TWB\Part::twBootstrapize();
        $this->includeCss('/javascript/twitter-bootstrap/css/bootstrap-switch.css');
        $this->includeJavascript('/javascript/twitter-bootstrap/js/bootstrap-switch.js');
        $this->addJavascript('$("[name=\''.$this->getTagName().'\']").bootstrapSwitch('.json_encode($this->properties).')',
            null, true);
    }

}
