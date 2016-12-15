<?php
/**
 * FlexiBudget - Vote Form.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015 Vitex Software
 */

namespace FlexiBudget\ui;

/**
 * Description of VoteForm
 *
 * @author vitex
 */
class VoteForm extends \Ease\TWB\Form
{

    /**
     * Vote Form
     *
     * @param \FlexiBudget\VoteSubject $subject current Budget or Intend
     */
    public function __construct($subject)
    {
        parent::__construct('voteForm', 'vote.php');
        $this->addItem(new VoteOptions());
        $this->addItem(new \Ease\Html\InputHiddenTag('subject',
            get_class($subject)));
        $this->addItem(new \Ease\Html\InputHiddenTag('action', 'vote'));
        $this->addItem(new \Ease\Html\InputHiddenTag('id', $subject->getMyKey()));
        $this->addItem(new \Ease\TWB\SubmitButton(_('Vote'), 'success'));
    }
}
