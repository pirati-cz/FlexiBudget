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

$class = $oPage->getRequestValue('class');
if ($class) {
    if (file_exists('classes/'.$class.'.php')) {
        require_once 'classes/'.$class.'.php';
    }
    $source = new DataSource(new $class());
    $source->output();
}
