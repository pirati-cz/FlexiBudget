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
     * Vote Status Cache
     * @var string
     */
    public $voteStatus = null;

    /**
     * Give you TwitterBootstrap Staus depends on intend voting status
     *
     * @param string $status One of: accepted|denyed|needvote|abstain
     * @return string succes|warning|danger|default
     */
    public static function getTwbStatus($status)
    {
        $choice['accepted'] = 'success';
        $choice['denyed']   = 'danger';
        $choice['needvote'] = 'default';
        $choice['abstain']  = 'info';
        return $choice[$status];
    }

    /**
     * Obtain overall voting state
     *
     * @return string One of: accepted|denyed|needvote|abstain
     */
    public function getVotingStatus()
    {
        if (is_null($this->voteStatus)) {
            $results = $this->getAllResults();
            if ($this->dblink->numRows === 0) {
                $this->voteStatus = 'needvote';
            } else {
                $counter = [];
                foreach ($results as $result) {
                    if (is_null($result['vote'])) {
                        $result['vote'] = 'abstain';
                    } elseif ($result['vote'] === true) {
                        $result['vote'] = 'accepted';
                    } else {
                        $result['vote'] = 'denied';
                    }
                    if (array_key_exists($result['vote'], $counter)) {
                        $counter[$result['vote']] ++;
                    } else {
                        $counter[$result['vote']] = 1;
                    }
                }
                $this->voteStatus = current(array_keys($counter, max($counter)));
            }
        }
        return $this->voteStatus;
    }

    /**
     * Obtain Intend voting state for one voter
     *
     * @param int $voterId Id of voter
     * @return string One of: accepted|denyed|needvote|abstain
     */
    public function getStatusForVoter($voterId)
    {
        return $this->voteInSqlResultToCode($this->dblink->queryToValue('SELECT vote FROM "Voting" WHERE subject LIKE \''.addslashes(get_class($this)).'\' AND subject_id = '.$this->getMyKey().' AND user_id='.intval($voterId)));
    }

    /**
     * Convert Vote status stored in SQL to string
     *
     * @param boolean $voteStatus false|null|true
     * @return string vote status code accepted|denyed|abstain|needvote
     */
    public function voteInSqlResultToCode($voteStatus)
    {
        if ($voteStatus === true) {
            $voteStatus = 'accepted';
        } elseif ($voteStatus === false) {
            $voteStatus = 'denyed';
        } else {
            if (($this->dblink->numRows == 1) && is_null($voteStatus)) {
                $voteStatus = 'abstain';
            } else {
                $voteStatus = 'needvote';
            }
        }
        return $voteStatus;
    }

    /**
     * Obtain short word code
     *
     * @param string $status One of: accepted|denyed|needvote|abstain
     * @return string
     */
    public static function getStatusString($status)
    {
        $choice['accepted'] = _('Accepted');
        $choice['denyed']   = _('Denied');
        $choice['needvote'] = _('Need vote');
        $choice['abstain']  = _('Abstain on resolution');
        return $choice[$status];
    }

    /**
     * Accept Vote
     *
     * @param boolean $vote true: yes; false: no; null;
     * @return boolean
     */
    public function saveVote($vote)
    {
        if ($vote == 1) {
            $vote = true;
        } elseif ($vote === '') {
            $vote = null;
        } else {
            $vote = false;
        }

        $record                = ['subject' => get_class($this),
            'subject_id' => $this->getMyKey(),
            'user_id' => \Ease\Shared::user()->getMyKey(),
            'vote' => $vote,
            'when' => 'NOW()'];
        $this->dblink->myTable = 'Voting';
        $result                = $this->dblink->arrayToInsert($record);
        return $result;
    }

    /**
     * Vote status & Vote Form if unvoted already
     *
     * @return array
     */
    public function getVoteBlock()
    {
        $status  = $this->getVotingStatus();
        $block[] = new \Ease\TWB\Label(self::getTwbStatus($status),
            self::getStatusString($status));
        if ($status === 'needvote') {
            $block[] = new ui\VoteForm($this);
        }
        return $block;
    }

    public function getAllVoters()
    {
        $user = new \FlexiBudget\User();
        return $user->getColumnsFromSQL(['id', 'email', 'login', 'lastname', 'firstname'],
                null, 'login', 'id');
    }

    public function getAllResults()
    {
        return $this->dblink->queryToArray('SELECT user_id,vote FROM "Voting" WHERE subject LIKE \''.addslashes(get_class($this)).'\' AND subject_id = '.$this->getMyKey());
    }

    /**
     * Return all voters votes
     * 
     * @return array
     */
    public function getVotingResults()
    {
        $allvoters = $this->getAllVoters();
        foreach ($allvoters as $voterId => $voter) {
            $allvoters[$voterId]['vote'] = 'needvote';
        }
        $results   = $this->getAllResults();
        foreach ($results as $result) {
            $allvoters[$result['user_id']]['vote'] = $this->voteInSqlResultToCode($result['vote']);
        }
        return $allvoters;
    }
}
