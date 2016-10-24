<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FlexiBudget\ui;

/**
 * Description of SyncResult
 *
 * @author vitex
 */
class SyncResult extends \Ease\TWB\Panel
{
    /**
     * Show how synchronization happend
     *
     * @param \FlexiBudget\Syncer $syncer
     */
    public function __construct($syncer)
    {
        parent::__construct(_('Sync Result'), 'info', 'XXX', 'YYY');
    }
}