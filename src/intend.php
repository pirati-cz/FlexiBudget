<?php
/**
 * FlexiBudget - Intend Page.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$intend = new Intend($oPage->getRequestValue('id', 'int'));


switch ($oPage->getRequestValue('action')) {
    default :
        if ($oPage->getRequestValue('delete') == 'true') {
            if ($intend->delete()) {
                $oPage->redirect('intends.php');
                exit;
            }
        }

        if ($oPage->isPosted()) {
            $intend->takeData($_REQUEST);

            if (is_null($intend->saveToSQL())) {
                $intend->addStatusMessage(_('Intend was not saved'), 'warning');
            } else {
                $intend->addStatusMessage(_('Intend was saved'), 'success');
            }
        }
        break;
}


$oPage->addItem(new ui\PageTop(_('Intend').' '.$intend->getRecordName()));


switch ($oPage->getRequestValue('action')) {
    case 'delete':

        $confirmBlock = new \Ease\TWB\Well();

        $confirmBlock->addItem($intend);

        $confirmator = $confirmBlock->addItem(new \Ease\TWB\Panel(_('Really delete ?')),
            'danger');
        $confirmator->addItem(new \Ease\TWB\LinkButton('?id='.$intend->getMyKey(),
            _('No').' '.\Ease\TWB\Part::glyphIcon('ok'), 'success'));
        $confirmator->addItem(new \Ease\TWB\LinkButton('?delete=true&'.$intend->myKeyColumn.'='.$intend->getMyKey(),
            _('Yes').' '.\Ease\TWB\Part::glyphIcon('remove'), 'danger'));

        $oPage->container->addItem(new \Ease\TWB\Panel('<strong>'.$intend->getName().'</strong>',
            'info', $confirmBlock));

        break;
    default :

//        $operationsMenu = $user->operationsMenu();
//        $operationsMenu->setTagCss(['float' => 'right']);
//        $operationsMenu->dropdown->addTagClass('pull-right');
//
        $oPage->container->addItem(new \Ease\TWB\Panel(_('Intend').' '.$intend->getRecordName(),
            'warning', new ui\IntendEditor($intend)));
        break;
}



$oPage->addItem(new ui\PageBottom());

$oPage->draw();
