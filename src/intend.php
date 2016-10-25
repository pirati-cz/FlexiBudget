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

$intend = new Intend($oPage->getRequestValue('id', 'int'));

if ($oPage->isPosted()) {
    $intend->takeData($_REQUEST);

    if (is_null($intend->saveToSQL())) {
        $intend->addStatusMessage(_('Intend was not saved'), 'warning');
    } else {
        $intend->addStatusMessage(_('Intend was saved'), 'success');
    }
}

$oPage->addItem(new ui\PageTop(_('Intend').' '.$intend->getRecordName()));

$oPage->container->addItem(new \Ease\TWB\Panel(_('Intend').' '.$intend->getRecordName(),
    'warning', new ui\IntendEditor($intend)));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
