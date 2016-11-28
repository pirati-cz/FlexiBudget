<?php
/**
 * FlexiBudget - Vote Options Widget.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */

namespace FlexiBudget\ui;

/**
 * Description of VoteOptions
 *
 * @author vitex
 */
class VoteOptions extends FuelUX\Selectlist
{

    /**
     * Vote Options Selector
     *
     * @param string $name
     * @param string $label
     */
    public function __construct($name = 'vote', $label = '')
    {
        parent::__construct($name, $label);
        $this->addSelectListItem(_('Abstain on resolution'), null);
        $this->addSelectListItem(_('Yes'), 1);
        $this->addSelectListItem(_('No'), 0);
    }
}
