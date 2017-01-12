<?php
/**
 * FlexiBudget - Main tree data source.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016-2017 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$treedata = [
        ['name' => 'a', 'type' => 'folder', 'attr' => ['id' => 1, 'data-icon' => 'images/users_150.png',
            'hasChildren' => true]],
        ['name' => 'b', 'type' => 'folder', 'attr' => ['id' => 2, 'data-icon' => 'images/users_150.png',
            'hasChildren' => true]],
        ['name' => 'c', 'type' => 'folder', 'attr' => ['id' => 3, 'data-icon' => 'images/users_150.png',
            'hasChildren' => true]],
];

$oPage->addToLog(serialize($_REQUEST), 'debug');

echo json_encode($treedata);
