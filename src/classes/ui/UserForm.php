<?php
/**
 * FlexiBudget - Uživatel.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */

namespace FlexiBudget\ui;

class UserForm extends \Ease\TWB\Form
{
    /**
     * Otázky.
     *
     * @var type
     */
    public $user = null;

    /**
     * User Properties edit form
     *
     * @param \FlexiBudget\User $user
     */
    public function __construct($user)
    {
        $userID     = $user->getMyKey();
        $this->user = $user;
        parent::__construct('user'.$userID);
       
        $this->addInput(new \Ease\Html\InputTag('firstname',
            $user->getDataValue('firstname')), _('Firstname'));
        $this->addInput(new \Ease\Html\InputTag('lastname',
            $user->getDataValue('lastname')), _('Lastname'));
        $this->addInput(new \Ease\Html\InputTag('email',
            $user->getDataValue('email')), _('Email'));
        $this->addInput(new \Ease\Html\InputTag('login',
            $user->getDataValue('login')), _('Login Name'));

        $this->addInput(new \Ease\Html\TextareaTag('icon',
            $user->getDataValue('icon')), _('Icon'));
        
        $this->addItem(new \Ease\Html\InputHiddenTag('class', get_class($user)));

        $this->addItem(new \Ease\Html\Div(new \Ease\TWB\SubmitButton(_('Uložit'),
            'success'), ['style' => 'text-align: right']));

        if (!is_null($userID)) {
            $this->addItem(new \Ease\Html\InputHiddenTag($user->myKeyColumn,
                $userID));
        }
    }
}