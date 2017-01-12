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

$fs = new TreeData(['structure_table' => 'tree_struct', 'data_table' => 'tree_data', 'data' => ['nm','icon','url']]);
$fs->getJson();
