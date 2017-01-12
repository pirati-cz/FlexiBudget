<?php

namespace FlexiBudget;

/**
 * SignIN page.
 *
 * @author    Vitex <vitex@hippy.cz>
 * @copyright Vitex@hippy.cz (C) 2016-2017
 */
require_once 'includes/Init.php';

if (!is_object($oUser)) {
    $oPage->addStatusMessages(_('Cookies required'));
}

$oPage->addItem(new ui\PageTop(_('Sign In')));

$loginFace = new \Ease\Html\Div(null, ['id' => 'LoginFace']);

$oPage->container->addItem($loginFace);

$loginRow   = new \Ease\TWB\Row();
$infoColumn = $loginRow->addItem(new \Ease\TWB\Col(4));

$infoBlock = $infoColumn->addItem(new \Ease\TWB\Well(new \Ease\Html\ImgTag('images/password.png')));
$infoBlock->addItem(_('Welcome to FlexiBudget'));
$infoBlock->addItem(new ui\OpenIDLoginForm());


$oPage->container->addItem($loginRow);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
