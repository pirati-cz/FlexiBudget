<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FlexiBudget\ui\FuelUX;

/**
 * Description of Tree
 *
 * @author vitex
 */
class Tree extends \Ease\Html\UlTag
{
    /**
     * Where to get Tree Data
     * @var string URL
     */
    public $dataSourceURL = null;

    /**
     * Tree Object Properties
     * @var array|string
     */
    public $jsProperties = null;

    /**
     * FuelUX Tree component
     *
     * @see http://getfuelux.com/javascript.html#tree
     * @param string $id tree name
     * @param array $properties tree properties
     */
    public function __construct($id, $jsProperties, $properties = [])
    {
        $properties['role'] = 'tree';
        $this->jsProperties = $jsProperties;

        $header = new \Ease\Html\Div(new \Ease\Html\ButtonTag(new \Ease\Html\Span(_('Open'),
            ['class' => 'sr-only']),
            ['class' => 'glyphicon icon-caret glyphicon-play', 'type' => 'button']),
            ['class' => 'tree-branch-header']);
        $header->addItem(new \Ease\Html\ButtonTag([new \Ease\Html\Span(null,
                ['class' => 'glyphicon icon-folder glyphicon-folder-close']), new \Ease\Html\Span(null,
                ['class' => 'tree-label'])], ['classs' => 'tree-branch-name']));
        $branch = new \Ease\Html\LiTag($header,
            ['class' => 'tree-branch hide', 'data-template' => 'treebranch', 'role' => 'treeitem',
            'aria-expanded' => 'false']);
        $branch->addItem(new \Ease\Html\UlTag(null,
            ['class' => 'tree-branch-children', 'role' => 'group']));
        $branch->addItem(new \Ease\Html\Div(_('Loading ...'),
            ['class' => 'tree-loader', 'role' => 'alert']));


        parent::__construct($branch, $properties);
        $this->addTagClass('tree tree-folder-select');
        $this->setTagID($id);


        $this->addItem(new \Ease\Html\LiTag(new \Ease\Html\ButtonTag([new \Ease\Html\Span(null,
                ['class' => 'glyphicon icon-item fueluxicon-bullet']), new \Ease\Html\Span(null,
                ['class' => 'tree-label'])],
            ['type' => 'button', 'class' => 'tree-item-name']),
            ['class' => 'tree-item hide', 'data-template' => 'treeitem', 'role' => 'treeitem']));
    }

    public function finalize()
    {
        $properties = is_array($this->jsProperties) ? \Ease\JQuery\Part::partPropertiesToString($this->jsProperties)
                : $this->jsProperties;

        $this->addJavaScript('

$(\'#'.$this->getTagID().'\').tree({ '.$properties.' });
            ');
        parent::finalize();
        \Ease\TWB\Part::twBootstrapize();

        \Ease\Shared::webPage()->body->addTagClass('fuelux');
        \Ease\Shared::webPage()->includeCss('twitter-bootstrap/css/fuelux.css',
            true);

        \Ease\Shared::webPage()->includeJavascript('/javascript/twitter-bootstrap/fuelux.js');

        $this->parentObject->addTagClass('tree');
    }
}
