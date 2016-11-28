<?php
/**
 * FlexiBudget - Vote acceptor.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */

namespace FlexiBudget;

require_once 'includes/Init.php';

$oPage->onlyForLogged();

$subject  = $oPage->getRequestValue('subject');
$id       = $oPage->getRequestValue('id', 'int');
$response = $oPage->getRequestValue('vote');

if (!is_null($subject) && !is_null($id) && !is_null($response)) {
    /** @var \FlexiBudget\VoteSubject Vote Subject Object     */
    $acceptor = new $subject($id);
    if ($acceptor->saveVote($response)) {
        $acceptor->addStatusMessage(_('Vote accepted'), 'success');
    } else {
        $acceptor->addStatusMessage(_('Vote acceptepting failed'), 'error');
    }
} else {
    $oPage->addStatusMessage(_('Voting error'), 'error');
}

$oPage->redirect(strtolower($acceptor->getMyTable()).'.php?id='.$id);
