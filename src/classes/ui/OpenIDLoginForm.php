<?php
namespace FlexiBudget\ui;

/**
 * Description of OpenIDLoginForm
 *
 * @author vitex
 */
class OpenIDLoginForm extends \Ease\TWB\Form
{

    /**
     * Form for Initiate OpenID auth
     *
     * @param string $defaultProvider
     */
    public function __construct($defaultProvider = 'openid.pirati.cz')
    {
        parent::__construct('OpenID', 'try_auth.php', 'POST');
        $this->addInput(new \Ease\Html\InputTextTag('provider', $defaultProvider),
            _('OpenID Provider'), $defaultProvider,
            _('Please use your OpenID provider'));
        $this->addItem(new \Ease\TWB\SubmitButton(_('Authenticate'), 'success'));
    }
}
