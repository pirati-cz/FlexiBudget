<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Transakce.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$oPage->onlyForLogged();

$transaction_id = $oPage->getRequestValue('id', 'int');

$transaction = Engine::doThings($oPage);
if (is_null($transaction)) {
    $transaction = new PokladniPohyb($transaction_id);
}

if ($oPage->getGetValue('delete', 'bool') == 'true') {
    if ($transaction->delete()) {
        $oPage->redirect('transactions.php');
        exit;
    }
}

$oPage->addItem(new ui\PageTop(_('Transactiona')));

switch ($oPage->getRequestValue('action')) {
    case 'delete':

        $confirmBlock = new \Ease\TWB\Well();

        $confirmBlock->addItem(new RecordShow($transaction));

        $confirmator = $confirmBlock->addItem(new \Ease\TWB\Panel(_('Opravdu smazat ?')), 'danger');
        $confirmator->addItem(new \Ease\TWB\LinkButton('transaction.php?id='.$transaction->getId(), _('Ne').' '.\Ease\TWB\Part::glyphIcon('ok'), 'success'));
        $confirmator->addItem(new \Ease\TWB\LinkButton('?delete=true&'.$transaction->myKeyColumn.'='.$transaction->getID(), _('Ano').' '.\Ease\TWB\Part::glyphIcon('remove'), 'danger'));

        $oPage->container->addItem(new \Ease\TWB\Panel('<strong>'.$transaction->getName().'</strong>', 'info', $confirmBlock));

        break;
    default :

        $operationsMenu = $transaction->operationsMenu();
        $operationsMenu->setTagCss(['float' => 'right']);
        $operationsMenu->dropdown->addTagClass('pull-right');

        $oPage->container->addItem(new \Ease\TWB\Panel(['<strong>'.$transaction->getName().'</strong>', $operationsMenu], 'info', new CashForm($transaction)));
        break;
}

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
