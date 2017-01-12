<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FlexiBudget\ui;

/**
 * Description of Tree
 *
 * @author vitex
 */
class Tree extends \Ease\Html\Div
{

    /**
     * Where to get data
     * @var string 
     */
    public $server = 'treedatasource.php';
    /**
     * https://www.jstree.com/
     * 
     * @param string $id ID of tree DIV
     * @param array $properties
     */
    public function __construct($id, $properties = [])
    {
        $properties['id'] = $id;
        parent::__construct(null, $properties);
    }

    public function finalize()
    {
        \Ease\JQuery\Part::jQueryze($this);
        $this->includeJavaScript('js/jstree.js');
        $this->includeCss('css/tree/default/style.css');
        $this->addJavaScript('
			$(\'#'.$this->getTagID().'\')
				.jstree({
					\'core\' : {
						\'data\' : {
							\'url\' : \''.$this->server.'?operation=get_node\',
							\'data\' : function (node) {
								return { \'id\' : node.id };
							}
						},
						\'check_callback\' : true,
						\'themes\' : {
							\'responsive\' : false
						}
					},
					\'force_text\' : true,
					\'plugins\' : [\'state\',\'dnd\',\'contextmenu\',\'wholerow\']
				})
				.on(\'delete_node.jstree\', function (e, data) {
					$.get(\''.$this->server.'?operation=delete_node\', { \'id\' : data.node.id })
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on(\'create_node.jstree\', function (e, data) {
					$.get(\''.$this->server.'?operation=create_node\', { \'id\' : data.node.parent, \'position\' : data.position, \'text\' : data.node.text })
						.done(function (d) {
							data.instance.set_id(data.node, d.id);
						})
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on(\'rename_node.jstree\', function (e, data) {
					$.get(\''.$this->server.'?operation=rename_node\', { \'id\' : data.node.id, \'text\' : data.text })
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on(\'move_node.jstree\', function (e, data) {
					$.get(\''.$this->server.'?operation=move_node\', { \'id\' : data.node.id, \'parent\' : data.parent, \'position\' : data.position })
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on(\'copy_node.jstree\', function (e, data) {
					$.get(\''.$this->server.'?operation=copy_node\', { \'id\' : data.original.id, \'parent\' : data.parent, \'position\' : data.position })
						.always(function () {
							data.instance.refresh();
						});
				})
				.on(\'changed.jstree\', function (e, data) {
					if(data && data.selected && data.selected.length) {
						$.get(\''.$this->server.'?operation=get_content&id=\' + data.selected.join(\':\'), function (d) {
							$(\'#data .default\').text(d.content).show();
						});
					}
					else {
						$(\'#data .content\').hide();
						$(\'#data .default\').text(\'Select a file from the tree.\').show();
					}
				});
            
            ');
        parent::finalize();
    }
}
