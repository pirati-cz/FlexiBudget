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
        $this->setTagID();
        parent::__construct('intend', null, 'post');
        $this->addItem($intend->inputWidget('name',
                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
        $this->addItem($intend->inputWidget('description',
                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
        $this->addItem($intend->inputWidget('limit', ['class' => 'required']));
        $this->addItem($intend->inputWidget('approval_at',
                ['class' => 'required']));
        $id           = $intend->getMyKey();
        if (!is_null($id)) {
            $this->addItem(new \Ease\Html\InputHiddenTag('id', $id));
        }
        $this->addItem(new \Ease\TWB\SubmitButton(_('Save'), 'success'));
        $this->addItem(new \Ease\Html\JavaScript('$("#'.$this->getTagID().'").validate();'));
    }

    function finalize()
    {
        $this->includeJavaScript('js/jquery.validate.js');
    }
}
