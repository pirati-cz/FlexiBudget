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
        $status = $subject->getVotingStatus();
        $footer = new \Ease\TWB\Label(\FlexiBudget\VoteSubject::getTwbStatus($status),
            \FlexiBudget\VoteSubject::getStatusString($status));

        parent::__construct(_('Voting Results'), 'info', null, $footer);
        $headRow = new \Ease\TWB\Row();
        $headRow->addColumn(3, _('not yet'), 'md', ['class' => 'heading']);
        $headRow->addColumn(3, _('Yes'), 'md', ['class' => 'heading']);
        $headRow->addColumn(3, _('No'), 'md', ['class' => 'heading']);
        $headRow->addColumn(3, _('Abstain to vote'), 'md',
            ['class' => 'heading']);
        $this->addItem($headRow);

        $votes   = ['needvote' => [], 'accepted' => [], 'denyed' => [], 'abstain' => [
            ]];
        $results = $subject->getVotingResults();
        foreach ($results as $result) {
            $votes[$result['vote']][] = $result;
        }

        $resultsRow = new \Ease\TWB\Row();
        $headRow->addColumn(3, self::showVoters($votes['needvote']));
        $headRow->addColumn(3, self::showVoters($votes['accepted']));
        $headRow->addColumn(3, self::showVoters($votes['denyed']));
        $headRow->addColumn(3, self::showVoters($votes['abstain']));

        $this->addItem($resultsRow);
    }

    /**
     * Gives you column with voters icons
     * 
     * @param array $voters
     * @return \Ease\Html\Div
     */
    static function showVoters($voters)
    {
        $userBlock = [];
        foreach ($voters as $voter) {
            $userBlock[$voter['login']][] = new \Ease\Html\ATag('user.php?id='.$voter['id'],
                new \Ease\Html\ImgTag($voter['icon'], $voter['login']));
            $userBlock[$voter['login']][] = new \Ease\Html\ATag('user.php?id='.$voter['id'],
                new \Ease\Html\Div($voter['firstname'].' '.$voter['lastname']));
        }
        return $userBlock;
    }
}
