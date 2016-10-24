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

$oPage->addItem(new ui\PageTop(_('Oprávnění')));

$oPage->container->addItem(new RightsForm('Rights'));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
