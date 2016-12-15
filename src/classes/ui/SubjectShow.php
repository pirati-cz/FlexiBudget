<?php

namespace FlexiBudget\ui;

/**
 * FlexiBudget - Subject of Vote.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2016 Vitex Software
 */
class SubjectShow extends \Ease\TWB\Panel
{

    /**
     * Show Intend Info & Status
     *
     * @param \FlexiBudget\VoteSubject $subject
     */
    public function __construct($subject)
    {
        parent::__construct($subject->getName(),
            \FlexiBudget\VoteSubject::getTwbStatus($subject->getVotingStatus()),
            $subject->getDataValue('description'), $subject->getVoteBlock());
    }
}
