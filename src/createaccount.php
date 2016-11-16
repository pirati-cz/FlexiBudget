<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Sign On.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';
$process = false;

$firstname = $oPage->getRequestValue('firstname');
$lastname = $oPage->getRequestValue('lastname');

if ($oPage->isPosted()) {
    $process = true;

    $emailAddress = addslashes(strtolower($_POST['email_address']));

    if (isset($_POST['parent'])) {
        $customerParent = addslashes($_POST['parent']);
    } else {
        $customerParent = $oUser->getUserID();
    }
    $login = addslashes($_POST['login']);
    if (isset($_POST['password'])) {
        $password = addslashes($_POST['password']);
    }
    if (isset($_POST['confirmation'])) {
        $confirmation = addslashes($_POST['confirmation']);
    }

    $error = false;

    if (strlen($emailAddress) < 5) {
        $error = true;
        $oUser->addStatusMessage(_('Mail address is too short'), 'warning');
    } else {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $oUser->addStatusMessage(_('invalid mail address'), 'warning');
        } else {
            $testuser = new \Ease\User();
            $testuser->setmyKeyColumn('email');
            $testuser->loadFromSQL(addslashes($emailAddress));
            if ($testuser->getUserName()) {
                $error = true;
                $oUser->addStatusMessage(sprintf(_('Mail address %s is allready registered'),
                        $emailAddress), 'warning');
            }
            unset($testuser);
        }
    }

    if (strlen($password) < 5) {
        $error = true;
        $oUser->addStatusMessage(_('password is too short'), 'warning');
    } elseif ($password != $confirmation) {
        $error = true;
        $oUser->addStatusMessage(_('Password control does not match'), 'warning');
    }

    $testuser = new \Ease\User();
    $testuser->setmyKeyColumn('login');
    $testuser->loadFromSQL(AddSlashes($login));
    $testuser->resetObjectIdentity();

    if ($testuser->getMyKey()) {
        $error = true;
        $oUser->addStatusMessage(sprintf(_('Username %s is used. Please choose another one'),
                $login), 'warning');
    }

    if ($error == false) {
        $newOUser = new User();
        $newOUser->setData(
            [
                    'email' => $emailAddress,
//                    'parent' => (int) $customerParent,
                    'login' => $login,
                    $newOUser->passwordColumn => $newOUser->encryptPassword($password),
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                ]
        );

        $userID = $newOUser->insertToSQL();

        if (!is_null($userID)) {
            $newOUser->setMyKey($userID);
            if ($userID == 0) {
                $newOUser->setSettingValue('admin', true);
                $oUser->addStatusMessage(_('Admin account created'), 'success');
                $newOUser->saveToSQL();
            } else {
                $oUser->addStatusMessage(_('User account created'), 'success');
            }

            $newOUser->loginSuccess();

            $email = $oPage->addItem(new \Ease\Mailer($newOUser->getDataValue('email'),
                _('Sign On info')));
            $email->setMailHeaders(['From' => EMAIL_FROM]);
            $email->addItem(new \Ease\Html\Div("Your new FlexiBudget accont:\n"));
            $email->addItem(new \Ease\Html\Div(' Login: '.$newOUser->GetUserLogin()."\n"));
            $email->addItem(new \Ease\Html\Div(' Password: '.$_POST['password']."\n"));
            $email->send();

            $email = $oPage->addItem(new \Ease\Mailer(SEND_INFO_TO,
                sprintf(_('New Sign On to FlexiBudget: %s'),
                    $newOUser->GetUserLogin())));
            $email->setMailHeaders(['From' => EMAIL_FROM]);
            $email->addItem(new \Ease\Html\Div(_("New User:\n")));
            $email->addItem(new \Ease\Html\Div(' Login: '.$newOUser->GetUserLogin()."\n"));
            $email->send();

            \Ease\Shared::user($newOUser)->loginSuccess();

            $oPage->redirect('index.php');
            exit;
        } else {
            $oUser->addStatusMessage(_('User create failed'), 'error');
            $email = $oPage->addItem(new \Ease\Mail(constant('SEND_ORDERS_TO'),
                _('Failed registraton')));
            $email->addItem(new \Ease\Html\DivTag($oPage->PrintPre($customerData)));
            $email->send();
        }
    }
}

$oPage->addItem(new ui\PageTop(_('Sign On')));

$regFace = $oPage->container->addItem(new \Ease\TWB\Panel(_('Singn On')));

$regForm = $regFace->addItem(new ui\ColumnsForm(new User()));
if ($oUser->getUserID()) {
    $regForm->addItem(new \Ease\Html\InputHiddenTag('parent', $oUser->GetUserID()));
}

$regForm->addInput(new \Ease\Html\InputTextTag('firstname', $firstname),
    _('Firstname'));
$regForm->addInput(new \Ease\Html\InputTextTag('lastname', $lastname),
    _('Lastname'));

$regForm->addInput(new \Ease\Html\InputTextTag('login'), _('User name').' *');
$regForm->addInput(new \Ease\Html\InputPasswordTag('password'),
    _('Password').' *');
$regForm->addInput(new \Ease\Html\InputPasswordTag('confirmation'),
    _('Password confirmation').' *');
$regForm->addInput(new \Ease\Html\InputTextTag('email_address'),
    _('eMail address').' *');

$regForm->addItem(new \Ease\Html\Div(new \Ease\Html\InputSubmitTag('Register',
    _('Register'),
    ['title' => _('finish registration'), 'class' => 'btn btn-success'])));

if (isset($_POST)) {
    $regForm->fillUp($_POST);
}

$oPage->addItem(new ui\PageBottom());
$oPage->draw();
