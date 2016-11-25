<?php
namespace FlexiBudget;

/**
 * FlexiBudget - Invoice Data Class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class Invoice extends Flexplorer
{
    /**
     * We work with this evidence
     * @var string
     */
    public $evidence = 'faktura-prijata';

    /**
     *
     * @var type
     */
    public $keyword = 'invoice';

    /**
     * Show only columns requested
     * @var array
     */
    public $showOnlyColumns = ['id', 'nazev'];

}
