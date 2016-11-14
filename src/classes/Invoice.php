<?php
namespace FlexiBudget;

/**
 * Description of Invoice
 *
 * @author vitex
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
