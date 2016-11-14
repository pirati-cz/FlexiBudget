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
        $fbico = '<img width="20" src="images/flexibee-logo.png">&nbsp;';
        if (isset($info['nastaveni']) && count($info['nastaveni'])) {
            $return = new \Ease\TWB\LinkButton(constant('FLEXIBEE_URL').'/c/'.constant('FLEXIBEE_COMPANY'),
                $fbico.$info['nastaveni'][0]['nazFirmy'], 'success');
        } else {
            $return = new \Ease\TWB\LinkButton(constant('FLEXIBEE_URL').'/c/'.constant('FLEXIBEE_COMPANY'),
                $fbico._('Chyba komunikace'), 'danger');
        }

        $return->draw();
    }
}
