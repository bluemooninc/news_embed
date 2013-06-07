<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once XOOPS_MODULE_PATH . "/news/class/AbstractListAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/GroupPermFilterForm.class.php";

class news_GroupPermListAction extends news_AbstractListAction
{
	protected $permNumber;
	function __construct(){
		parent::__construct();
		$this->permNumber = $this->root->mContext->mRequest->getRequest('permNumber');
		if (!$this->permNumber) $this->permNumber=3;
	}
	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('topics');
		return $handler;
	}

	function &_getFilterForm()
	{
		$filter =new news_GroupPermFilterForm($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	function _getBaseUrl()
	{
		return "./index.php?action=GroupPermList";
	}

	/**
	 * TODO : move to model
	 * @param $permNumber
	 * @return XoopsGroupPermForm
	 */
	private function &forge_GroupPerm($mid,$permNumber){
		switch($permNumber)
		{
			case 1:
				$title_of_form = _AD_APPROVEFORM;
				$perm_name = "news_approve";
				$perm_desc = _AD_APPROVEFORM_DESC;
				break;
			case 2:
				$title_of_form = _AD_SUBMITFORM;
				$perm_name = "news_submit";
				$perm_desc = _AD_SUBMITFORM_DESC;
				break;
			case 3:
				$title_of_form = _AD_VIEWFORM;
				$perm_name = "news_view";
				$perm_desc = _AD_VIEWFORM_DESC;
				break;
		}
		$groupPerm = new XoopsGroupPermForm($title_of_form, $mid, $perm_name, $perm_desc);
		return $groupPerm;
	}

	function &getGroupPerm(&$topicObjects){
		$mid = $this->root->mContext->mXoopsModule->get('mid');
		$groupPerm = $this->forge_GroupPerm($mid,$this->permNumber);
		foreach ($topicObjects as $object) {
			$groupPerm->addItem($object->getVar('topic_id'), $object->getVar('topic_title'), $object->getVar('topic_pid'));
		}
		$gperm_handler =& xoops_gethandler('groupperm');
		$member_handler =& xoops_gethandler('member');
		$glist =& $member_handler->getGroupList();
		$elements = array();
		foreach (array_keys($glist) as $i) {
			// get selected item id(s) for each group
			$selected = $gperm_handler->getItemIds($groupPerm->_permName, $i, $mid);
			$elements[] = array(
				$glist[$i],
				'perms[' . $groupPerm->_permName . ']',
				$i,
				$selected
			);
		}
		adump($elements);
		return $elements;
	}
	function executeViewIndex(&$controller, &$render)
	{
		$render->setTemplateName("groupPerm_list.html");
		$render->setAttribute("groupPerm", $this->getGroupPerm($this->mObjects));
		$render->setAttribute("objects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
	}
}

