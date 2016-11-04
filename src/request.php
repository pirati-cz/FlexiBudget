<?php
/**
 * FlexiBudget - Hlavní strana.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Request for payment')));

$flexiBees = new FlexiBees();

$mainPageMenu = new ui\MainPageMenu();
$mainPageMenu->addMenuItem('images/createinvoice.svg', _('Create new invoice'),
    'createinvoice.php');
$mainPageMenu->addMenuItem('images/chooseinvoice.svg',
    _('Choose existing invoice'), 'chooseinvoice.php');
$oPage->container->addItem($mainPageMenu);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
