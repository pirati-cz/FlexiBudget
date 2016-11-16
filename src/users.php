<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Přehled uživatelů.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

Engine::doThings($oPage);

$oPage->addItem(new ui\PageTop(_('Users Listing')));

$oPage->addItem(new \Ease\TWB\Container(new ui\DataGrid(_('Users'), new User())));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
