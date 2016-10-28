<?php
/**
 * FlexiBudget - Budgets listing.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Budgets')));

$oPage->addItem(new \Ease\TWB\Container(new ui\DataGrid(_('Budgets'),
    new Budget())));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
