<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FlexiBudget\ui;

/**
 * Description of UserSelect
 *
 * @author vitex
 */
class UserSelect extends FuelUX\Selectlist
{
    public function finalize()
    {
        $users = \Ease\Shared::user()->getColumnsFromSQL('*',null, 'lastname', 'id');
        foreach ($users as $userId=>$user){
            $this->addSelectListItem( '<img src="'.$user['icon'].'" class="list-icon"> '.$user['lastname'].' '.$user['firstname'] , $userId);
        }
       
        parent::finalize();
    }
}
