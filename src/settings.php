<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Settings')));

$oPage->container->addItem(new \Ease\TWB\LinkButton('changepassword.php',
    _('Změna hesla'), 'warning'));
$oPage->container->addItem(new \Ease\TWB\LinkButton('rights.php',
    _('Oprávnění'), 'warning'));

$oPage->container->addItem(new ui\FlexiBeeStatus());

$oPage->container->addItem(new \Ease\TWB\LinkButton('flexibeeinit.php',
    _('Init FlexiBee'), 'warning'));


$oPage->addItem(new ui\PageBottom());

$oPage->draw();
