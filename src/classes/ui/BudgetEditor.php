<?php

namespace FlexiBudget\ui;

/**
 * Description of BudgetEditor
 *
 * @author vitex
 */
class BudgetEditor extends \Ease\TWB\Form
{
    /**
     * Budget object
     *
     * @var \FlexiBudget\Budget
     */
    public $budget = null;

    /**
     * Edit Form for Budget record
     *
     * @param \FlexiBudget\Budget $budget
     */
    public function __construct($budget)
    {
        $this->budget = $budget;
        $this->setTagID();
        parent::__construct('budget', null, 'post');
        
        $creator = \FlexiBudget\User::icoLink($budget->getDataValue('Creator'),['class'=>'list-icon']);
        $creator->addItem(' '.$creator->getTagProperty('data-name'));
        $this->addItem(new \Ease\Html\H4Tag(_('Creator')));
        $this->addItem($creator);

        $this->addItem(new \Ease\Html\InputHiddenTag('Creator', \Ease\Shared::user()->getMyKey()));
        
        $this->addItem($budget->inputWidget('Name',
                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
//        $this->addItem($budget->inputWidget('description',
//                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
//        $this->addItem($budget->inputWidget('limit', ['class' => 'required']));
        $this->addItem($budget->inputWidget('Year',
                ['class' => 'required', 'default' => date('Y')]));
        $this->addItem($budget->inputWidget('Goodman',
                ['class' => 'required', 'default' => \Ease\Shared::user()->getUserID()]));

        $approval_at = $budget->getDataValue('approval_at');
        if (isset($approval_at)) {
            $approvalBlock = new \Ease\Html\InputTextTag('approval_at',
                $approval_at, ['disabled' => true]);
        } else {
            $approvalBlock = new TWBSwitch('approval_at', false, 'approve');
        }

        $this->addInput($approvalBlock, _('Approval'));
        $id = $budget->getMyKey();
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
