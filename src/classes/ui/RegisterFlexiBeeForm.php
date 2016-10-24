<?php
/**
 * FlexiBudget - BootStrap Menu.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2016 Vitex Software
 */

namespace FlexiBudget\ui;

/**
 * Description of RegisterFlexiBeeForm
 *
 * @author vitex
 */
class RegisterFlexiBeeForm extends ColumnsForm
{

    public function afterAdd()
    {
        $this->addInput(new \Ease\Html\InputTextTag('name'),
            _('FlexiBee instance Name'));
        $this->addInput(new \Ease\Html\InputTextTag('url'),
            _('RestAPI endpoint url'));
        $this->addInput(new \Ease\Html\InputTextTag('user'),
            _('REST API Username'));
        $this->addInput(new \Ease\Html\InputTextTag('password'),
            _('Rest API Password'));
        $this->addInput(new \Ease\Html\InputTextTag('company'),
            _('Company Code'));
        $this->addInput(new TWBSwitch('rw'), _('Read/Write access ?'));

        $this->addInput(new \Ease\TWB\SubmitButton(_('Save'), 'success'));

        if (!is_null($this->engine->getDataValue('id'))) {
            $this->addItem(new \Ease\Html\InputHiddenTag('id'));
        }

        if ($this->engine->getDataCount()) {
            $this->fillUp($this->engine->getData());
        }
    }
 }