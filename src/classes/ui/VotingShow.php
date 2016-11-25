<?php

namespace FlexiBudget\ui;

/**
 * Description of VotingShow
 *
 * @author vitex
 */
class VotingShow extends \Ease\TWB\Panel
{

    /**
     * Show Voting results
     *
     * @param \FlexiBudget\VoteSubject $subject
     */
    public function __construct($subject)
    {
        $footer = new \Ease\TWB\Label($subject->getTwbStatus(),
            $subject->getStatusString());

        parent::__construct(_('Voting Results'), 'info', null, $footer);
        $headRow = new \Ease\TWB\Row();
        $headRow->addColumn(3, _('not yet'), 'md',
            ['class' => 'heading']);
        $headRow->addColumn(3, _('Yes'), 'md', ['class' => 'heading']);
        $headRow->addColumn(3, _('No'), 'md', ['class' => 'heading']);
        $headRow->addColumn(3, _('Deny to vote'), 'md', ['class' => 'heading']);

        $this->addItem($headRow);
    }
}
