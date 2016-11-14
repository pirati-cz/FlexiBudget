<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Settings Page.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Settings')));

$oPage->container->addItem(new \Ease\TWB\LinkButton('changepassword.php',
    _('Password Change'), 'warning'));
$oPage->container->addItem(new \Ease\TWB\LinkButton('rights.php',
    _('Oprávnění'), 'warning'));

$oPage->container->addItem(new ui\FlexiBeeStatus());

$oPage->container->addItem(new \Ease\TWB\LinkButton('flexibeeinit.php',
    _('Init FlexiBee'), 'warning'));


$oPage->addItem(new ui\PageBottom());

$oPage->draw();
