<?php
/**
 * Description of SysFlexiBeeStatus.
 *
 * @author vitex
 */
namespace FlexiBudget\ui;

class FlexiBeeStatus extends \FlexiPeeHP\FlexiBeeRO
{
    /**
     * @var type
     */
    public $evidence = 'nastaveni';

    public function draw()
    {
        $info = $this->performRequest($this->evidence.'.json');

        if (isset($info['nastaveni']) && count($info['nastaveni'])) {
            $return = new \Ease\TWB\LinkButton(constant('FLEXIBEE_URL'), $info['nastaveni'][0]['nazFirmy'], 'success');
        } else {
            $return = new \Ease\TWB\LinkButton(constant('FLEXIBEE_URL'), _('Chyba komunikace'), 'danger');
        }

        $return->draw();
    }
}
