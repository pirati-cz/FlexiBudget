<?php
/**
 * FlexiBudget - Invoices listing.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Invoices')));

$oPage->addItem(new \Ease\TWB\Container(new ui\FlexiDataGrid(_('Invoices'),
    new Invoice())));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
