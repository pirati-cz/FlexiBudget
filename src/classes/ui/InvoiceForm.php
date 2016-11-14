<?php
namespace FlexiBudget\ui;

/**
 * Description of InvoiceForm
 *
 * @author vitex
 */
class InvoiceForm extends \Ease\TWB\Form
{

    /**
     * First Invoice Row (Heading)
     *
     * @return \Ease\TWB\Row
     */
    public function invoiceHead()
    {
        $rowI                = new \Ease\TWB\Row();
        $providerLogoHeading = new \Ease\Html\H1Tag(new \Ease\Html\ATag($this->getDataValue('providerUrl'),
            [new \Ease\Html\ImgTag($this->getDataValue('providerLogo')), $this->getDataValue('providerNick')]));
        $rowI->addColumn(6, $providerLogoHeading, 'xs');

        $invoiceLogoHeading = [new \Ease\Html\H1Tag(_('Invoice')), new \Ease\Html\H1Tag(new \Ease\Html\SmallTag(sprintf(_('Invoice #%s'),
                    $this->getDataValue('number'))))];

        $rowI->addColumn(6, $invoiceLogoHeading, 'xs', ['class' => 'text-right']);
        return $rowI;
    }

    /**
     * Second Invoice Row (provider/customer info)
     *
     * @return \Ease\TWB\Row
     */
    public function sidesInfo()
    {
        $rowII         = new \Ease\TWB\Row();
        $providerPanel = new \Ease\TWB\Panel(new \Ease\Html\H4Tag([_('From').': ',
            new \Ease\Html\ATag($this->getDataValue('providerRef'),
                $this->getDataValue('providerName'))]), 'default',
            new \Ease\Html\PTag(nl2br($this->getDataValue('providerAddress'))));

        $rowII->addColumn(5, $providerPanel, 'xs');

        $customerPanel = new \Ease\TWB\Panel(new \Ease\Html\H4Tag([_('To').': ',
            new \Ease\Html\ATag($this->getDataValue('customerRef'),
                $this->getDataValue('customerName'))]), 'default',
            new \Ease\Html\PTag(nl2br($this->getDataValue('customerAddress'))));

        $rowII->addColumn(5, $customerPanel, 'xs',
            ['class' => 'col-xs-offset-2 text-right']);


        return $rowII;
    }

    /**
     * Items of invoice
     *
     * @return \Ease\Html\TableTag
     */
    public function invoiceItemsTable()
    {
        $itemTable = new \Ease\Html\TableTag(null,
            ['class' => 'table table-bordered']);
        $itemTable->addRowHeaderColumns([_('Service'), _('Description'), _('Hrs/Qty'),
            _('Rate/Price'), _('Sub Total')]);

        $items = $this->getDataValue('items');
        if (count($items)) {
            foreach ($items as $item) {
                $itemTable->addRowColumns($item);
            }
        }
        return $itemTable;
    }

    /**
     * Third Invoice Row (Totals)
     *
     * @return \Ease\TWB\Row
     */
    public function totals()
    {
        $rowIII = new \Ease\TWB\Row();

        $rowIII->addColumn(2,
            new \Ease\Html\PTag(
            new \Ease\Html\StrongTag(
            _('Sub Total').' : <br>
            '._('TAX').' : <br>
            '._('Total').' : <br>')
            ), 'xs', ['class' => 'col-xs-offset-8']);

        $rowIII->addColumn(2,
            new \Ease\Html\PTag(
            new \Ease\Html\StrongTag(
            ' X <br>
             X <br>
             X <br>')
            ), 'xs');
        return $rowIII;
    }

    function finalize()
    {
        $this->setData(['providerUrl' => 'https://www.vitexsoftware.cz/',
            'providerLogo' => 'https://www.vitexsoftware.cz/img/tux-server.png',
            'providerNick' => 'Vitex',
            'number' => '00001',
            'providerRef' => 'https://demo.flexibee.eu/c/demo/adresar/1009',
            'providerName' => 'Vitex Software',
            'providerAddress' => 'Melodická 11'."\n".'Stodůlky',
            'customerRef' => 'ref',
            'customerName' => 'Pirati',
            'customerAddress' => 'Mesto'."\n".'ulice',
            'items' => [['A', 'B', 'C', 'D', 'E'], ['a', 'b', 'c', 'd', 'e']],
        ]);

        $container = new \Ease\TWB\Container();
        $container->addItem($this->invoiceHead());
        $container->addItem($this->sidesInfo());
        $container->addItem($this->invoiceItemsTable());
        $container->addItem($this->totals());

        $this->addItem($container);
        parent::finalize();
    }

    public function getDataValue($columnName)
    {
        if (!array_key_exists($columnName, $this->data)) {
            $this->addStatusMessage("??? $columnName");
        }
        return parent::getDataValue($columnName);
    }
}
