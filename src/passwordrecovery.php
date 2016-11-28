<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Password Recovery.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';
$success = false;

$emailTo = $oPage->getPostValue('Email');

$oPage->includeJavaScript('js/jquery.validate.js');
$oPage->addJavascript('$("#PassworRecovery").validate({
  rules: {
    Email: {
      required: true,
      email: true
    }
  }
});', null, true);

if ($emailTo) {
    $userEmail = \Ease\Shared::db()->easeAddSlashes($emailTo);

    $controlUser = new User();
    $controlData = $controlUser->getColumnsFromSql($controlUser->getmyKeyColumn(),
        ['email' => $userEmail]);

    if (count($controlData)) {
        $controlUser->loadFromSQL((int) $controlData[0][$controlUser->getmyKeyColumn()]);
        $userLogin   = $controlUser->getUserLogin();
        $newPassword = $oPage->randomString(8);

        $controlUser->passwordChange($newPassword);

        $email = $oPage->addItem(new \Ease\Mailer($userEmail,
            constant('LOG_NAME').' - '.sprintf(_('New password for %s'),
                $_SERVER['SERVER_NAME'])));

        $email->setMailHeaders(['From' => constant('EMAIL_FROM')]);
        $email->addItem(_('Sign On informations was changed').":\n");

        $email->addItem(_('Username').': '.$userLogin."\n");
        $email->addItem(_('Password').': '.$newPassword."\n");

        $email->send();

        \Ease\Shared::user()->addStatusMessage(sprintf(_('Your new password was sent to %s'),
                '<strong>'.$_REQUEST['Email'].'</strong>'));
        $success = true;
    } else {
        \Ease\Shared::user()->addStatusMessage(sprintf(_('unknow email address %s'),
                '<strong>'.$_REQUEST['Email'].'</strong>'), 'warning');
    }
} else {
    $oUser->addStatusMessage(_('Please enter your email.'));
}

$oPage->addItem(new ui\PageTop(_('Lost password recovery')));
$oPage->addPageColumns();

if (!$success) {
    $oPage->columnIII->addItem(new \Ease\TWB\Label('info', _('Tip')));

    $oPage->columnIII->addItem(_('Forgot your password? Enter your e-mail address you entered during the registration and we will send you a new one.'));

    $titlerow = new \Ease\TWB\Row();
    $titlerow->addColumn(4, new \Ease\Html\ImgTag('images/password.png'));
    $titlerow->addColumn(8, new \Ease\Html\H3Tag(_('Password Recovery')));

    $loginPanel = new \Ease\TWB\Panel(new \Ease\TWB\Container($titlerow),
        'success', null,
        new \Ease\TWB\SubmitButton(_('Send New Password'), 'success'));
    $loginPanel->addItem(new \Ease\TWB\FormGroup(_('Email'),
        new \Ease\Html\InputTextTag('Email', $emailTo, ['type' => 'email'])));
    $loginPanel->body->setTagProperties(['style' => 'margin: 20px']);

    $mailForm = $oPage->columnII->addItem(new \Ease\TWB\Form('PasswordRecovery'));
    $mailForm->addItem($loginPanel);

    if ($oPage->isPosted()) {
        $mailForm->fillUp($_POST);
    }

    $oPage->addItem(new ui\PageBottom());

    $oPage->draw();
} else {
    $oPage->columnII->addItem(new \Ease\TWB\LinkButton('login.php',
        _('Continue')));
    $oPage->redirect('login.php');
}

