<?php

namespace FlexiBudget;

/**
 * FlexiBudget - Našeptávač vyhledávače.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */
require_once 'includes/Init.php';

$query = $oPage->getRequestValue('q');

$found = [];

$searcher = new Searcher($oPage->getRequestValue('class'), $oPage->getRequestValue('selector'));

header('ContentType: text/json');

if (strlen($query) > 1) {
    $results = $searcher->searchAll($query);

    foreach ($results as $rectype => $records) {
        foreach ($records as $recid => $record) {
            $found[] = ['id' => $recid, 'url' => $rectype.'.php?'.$rectype.'_id='.$recid, 'name' => current($record), 'type' => $rectype, 'what' => $record['what']];
        }
    }
}
echo json_encode($found);
