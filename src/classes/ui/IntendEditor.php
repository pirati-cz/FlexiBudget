<?php
namespace FlexiBudget\ui;

/**
 * Description of IntendEditor
 *
 * @author vitex
 */
class IntendEditor extends \Ease\TWB\Form
{
    /**
     * Intend object
     *
     * @var \FlexiBudget\Intend 
     */
    public $intend = null;

    /**
     * Edit Form for Intend record
     *
     * @param \FlexiBudget\Intend $intend
     */
    public function __construct($intend)
    {
        $this->intend = $intend;
        parent::__construct('intend', null, 'post');
        $this->addItem($intend->inputWidget('name'));
        $this->addItem($intend->inputWidget('description'));
        $this->addItem($intend->inputWidget('limit'));
        $this->addItem($intend->inputWidget('approval_at'));
        $id           = $intend->getMyKey();
        if (!is_null($id)) {
            $this->addItem(new \Ease\Html\InputHiddenTag('id', $id));
        }
        $this->addItem(new \Ease\TWB\SubmitButton(_('Save'), 'success'));
    }

}
