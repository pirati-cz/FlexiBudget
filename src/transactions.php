<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Přehled transakcí.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

Engine::doThings($oPage);

$oPage->addItem(new ui\PageTop(_('Přehled transakcí')));

$oPage->addItem(new \Ease\TWB\Container(new DataGrid(_('Transakce'), new PokladniPohyb())));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
