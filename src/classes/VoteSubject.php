<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Subject of Vote.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class VoteSubject extends Engine
{
    /**
     * Give you TwitterBootstrap Staus depends on intend voting status
     *
     * @return string succes|warning|danger
     */
    public function getTwbStatus()
    {
        $st = $this->getStatus();
        if ($st === true) {
            $status = 'success';
        } elseif ($st === false) {
            $status = 'danger';
        } else {
            $status = 'default';
        }
        return $status;
    }

    /**
     * Obtain Intend voting state as boolean
     *
     * @return boolean true: accept, false: denied, null: need another vote
     */
    public function getStatus()
    {
        $state = null;
        return $state;
    }

    /**
     * Obtain short word code
     *
     * @return string
     */
    public function getStatusString()
    {
        $st = $this->getStatus();
        if ($st === true) {
            $status = _('Accepted');
        } elseif ($st === false) {
            $status = _('Denied');
        } else {
            $status = _('Need vote');
        }
        return $status;
    }
}
