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

$oPage->addItem(new ui\PageTop(_('Faktura')));


//$newInvoiceUrl = (constant('FLEXIBEE_URL').'/c/'.constant('FLEXIBEE_COMPANY').'/faktura-prijata;new?inDesktopApp=true');
//
//$oPage->container->addItem(new \Ease\Html\IframeTag($newInvoiceUrl,
//    ['style' => 'width: 100%; height: 600px', 'frameborder' => 0]));



$invoice     = new \FlexiPeeHP\FakturaVydana();
$invoiceForm = new ui\InvoiceForm($invoice);
$oPage->container->addItem(new \Ease\TWB\Well($invoiceForm));

$oPage->addItem(new ui\PageBottom());

$oPage->draw();
