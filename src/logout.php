<?php

namespace FlexiBudget;

/**
 * Sign Off page.
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright Vitex@hippy.cz (G) 2009,2011
 */
require_once 'includes/Init.php';

if ($oUser->getUserID()) {
    $oUser->logout();
    $messagesBackup = $oUser->getStatusMessages(true);
    \Ease\Shared::user(new \Ease\Anonym());
    $oUser->addStatusMessages($messagesBackup);
}

$oPage->addItem(new ui\PageTop(_('Sign Off')));

$byerow  = new \Ease\TWB\Row();
$byerow->addColumn(2);
$byeInfo = $byerow->addColumn(6, new \Ease\Html\H1Tag(_('Good bye')));


$byeInfo->addItem('<br/><br/><br/><br/>');
$byeInfo->addItem(new \Ease\Html\Div(new \Ease\Html\ATag('login.php',
    _('
Thank you for your patronage and look forward to another visit'),
    ['class' => 'jumbotron'])));
$byeInfo->addItem('<br/><br/><br/><br/>');

$oPage->container->addItem($byerow);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
