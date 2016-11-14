<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Zdroj dat datagridu.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$class    = $oPage->getRequestValue('class');
$evidence = $oPage->getRequestValue('evidence');
if ($class) {
    if (current(class_parents($class)) == 'FlexiBudget\Flexplorer') {
        $source = new FlexiDataSource(new $class());
    } else {
        $source = new DataSource(new $class());
    }
    $source->output();
}
