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

$oPage->addItem(new ui\PageTop(_('FlexiBudget')));

$flexiBees = new FlexiBees();

$mainPageMenu = new ui\MainPageMenu();
$mainPageMenu->addMenuItem('images/intend.svg', _('Intend'), 'intends.php');
$oPage->container->addItem($mainPageMenu);

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
