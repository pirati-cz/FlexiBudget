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
        $footer = new \Ease\TWB\Label($subject->getTwbStatus(),
            $subject->getStatusString());
        parent::__construct($subject->getName(), $subject->getTwbStatus(),
            $subject->getDataValue('description'), $footer);
    }
}
