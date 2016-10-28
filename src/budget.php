<?php
/**
 * FlexiBudget - Budget Page.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$budget = new Budget($oPage->getRequestValue('id', 'int'));


switch ($oPage->getRequestValue('action')) {
    default :
        if ($oPage->getRequestValue('delete') == 'true') {
            if ($budget->delete()) {
                $oPage->redirect('budgets.php');
                exit;
            }
        }

        if ($oPage->isPosted()) {
            $budget->takeData($_REQUEST);

            if (is_null($budget->saveToSQL())) {
                $budget->addStatusMessage(_('Budget was not saved'), 'warning');
            } else {
                $budget->addStatusMessage(_('Budget was saved'), 'success');
            }
        }
        break;
}


$oPage->addItem(new ui\PageTop(_('Budget').' '.$budget->getRecordName()));


switch ($oPage->getRequestValue('action')) {
    case 'delete':

        $confirmBlock = new \Ease\TWB\Well();

        $confirmBlock->addItem($budget);

        $confirmator = $confirmBlock->addItem(new \Ease\TWB\Panel(_('Really delete ?')),
            'danger');
        $confirmator->addItem(new \Ease\TWB\LinkButton('?id='.$budget->getMyKey(),
            _('No').' '.\Ease\TWB\Part::glyphIcon('ok'), 'success'));
        $confirmator->addItem(new \Ease\TWB\LinkButton('?delete=true&'.$budget->myKeyColumn.'='.$budget->getMyKey(),
            _('Yes').' '.\Ease\TWB\Part::glyphIcon('remove'), 'danger'));

        $oPage->container->addItem(new \Ease\TWB\Panel('<strong>'.$budget->getName().'</strong>',
            'info', $confirmBlock));

        break;
    default :

//        $operationsMenu = $user->operationsMenu();
//        $operationsMenu->setTagCss(['float' => 'right']);
//        $operationsMenu->dropdown->addTagClass('pull-right');
//
        $oPage->container->addItem(new \Ease\TWB\Panel(_('Budget').' '.$budget->getRecordName(),
            'warning', new ui\BudgetEditor($budget)));
        break;
}



$oPage->addItem(new ui\PageBottom());

$oPage->draw();
