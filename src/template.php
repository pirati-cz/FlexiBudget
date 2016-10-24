<?php

namespace FlexiBudget;

/**
 * FlexiBudget - předloha stránky.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once './includes/Init.php';

$oPage->onlyForLogged();

$oPage->addItem(new ui\PageTop(_('Vitex Software')));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
