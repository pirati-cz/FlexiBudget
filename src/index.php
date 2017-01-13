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

//$mainPageMenu = new ui\MainPageMenu();
//$mainPageMenu->addMenuItem('images/budget.svg', _('Budget'), 'budgets.php');
//$mainPageMenu->addMenuItem('images/request.svg', _('Request for payment'),
//    'request.php');
//$mainPageMenu->addMenuItem('images/intend.svg', _('Intend'), 'intends.php');
//$oPage->container->addItem($mainPageMenu);


$oPage->container->addItem(new \Ease\TWB\Well(new ui\Tree('tree')));
$oPage->addItem(new ui\PageBottom());

$oPage->draw();
