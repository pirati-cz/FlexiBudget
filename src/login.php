<?php

namespace FlexiBudget;

/**
 * Přihlašovací stránka.
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright Vitex@hippy.cz (C) 2016
 */
require_once 'includes/Init.php';

if (!is_object($oUser)) {
    die(_('Cookies required'));
}

$login = $oPage->getRequestValue('login');
if ($login) {
    $oUser = \Ease\Shared::user(new User());
//    \Ease\Shared::user()->SettingsColumn = 'settings';
    if ($oUser->tryToLogin($_POST)) {
        $oPage->redirect('index.php');
        exit;
    }
} else {
    $forceID = $oPage->getRequestValue('force_id', 'int');
    if (!is_null($forceID)) {
        \Ease\Shared::user(new User($forceID));
        $oUser->setSettingValue('admin', true);
        $oUser->addStatusMessage(_('Signed As: ').$oUser->getUserLogin(),
            'success');
        \Ease\Shared::user()->loginSuccess();
        $oPage->redirect('main.php');
        exit;
    } else {
        $oPage->addStatusMessage(_('Please enter your Login information'));
    }
}

$oPage->addItem(new ui\PageTop(_('Sign In')));

$loginFace = new \Ease\Html\Div(null, ['id' => 'LoginFace']);

$oPage->container->addItem($loginFace);

$loginRow   = new \Ease\TWB\Row();
$infoColumn = $loginRow->addItem(new \Ease\TWB\Col(4));

$infoBlock = $infoColumn->addItem(new \Ease\TWB\Well(new \Ease\Html\ImgTag('images/password.png')));
$infoBlock->addItem(_('Welcome to FlexiBudget'));
$infoBlock->addItem(new ui\OpenIDLoginForm());

$loginColumn = $loginRow->addItem(new \Ease\TWB\Col(4));

$submit = new \Ease\TWB\SubmitButton(_('Sign In'), 'success');

$titlerow = new \Ease\TWB\Row();
$titlerow->addColumn(4, new \Ease\Html\ImgTag('images/poklad.svg'), _('Budget'),
    ['style' => 'height: 50px; width: 50px; float: right;']);
$titlerow->addColumn(8, new \Ease\Html\H2Tag(_('Singn In')));

$loginPanel = new \Ease\TWB\Panel(new \Ease\TWB\Container($titlerow), 'success',
    null, $submit);
$loginPanel->addItem(new \Ease\TWB\FormGroup(_('Username'),
    new \Ease\Html\InputTextTag('login', $login)));
$loginPanel->addItem(new \Ease\TWB\FormGroup(_('Password'),
    new \Ease\Html\InputPasswordTag('password')));
$loginPanel->body->setTagProperties(['style' => 'margin: 20px']);
$loginColumn->addItem(new \Ease\TWB\Form('Login', null, 'POST', $loginPanel));

$passRecoveryColumn = $loginRow->addItem(new \Ease\TWB\Col(4,
    new \Ease\TWB\LinkButton('passwordrecovery.php',
    '<i class="fa fa-key"></i>
'._('Password Recovery'), 'warning')));

$passRecoveryColumn->additem(new \Ease\TWB\LinkButton('createaccount.php',
    '<i class="fa fa-user"></i>
'._('Sign On'), 'success'));

$oPage->container->addItem($loginRow);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
