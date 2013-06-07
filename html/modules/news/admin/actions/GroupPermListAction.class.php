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
	private function &getGPermObjects($permNumber){
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
		$mid = $this->root->mContext->mXoopsModule->get('mid');
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('gperm_modid',$mid));
		$criteria->add(new Criteria('gperm_name',$perm_name));
		$criteria->addSort('gperm_groupid');
		$gPermHandler =& xoops_getmodulehandler('group_permission','legacy');
		$gPermObjects = $gPermHandler->getObjects($criteria);
		return $gPermObjects;
	}
	private function &getTopicArray(){
		$topicHandler = xoops_getmodulehandler('topics');
		$topicObjects = $topicHandler->getObjects();
		$topicArray = array();
		foreach($topicObjects as $topicObject){
			$topicArray[$topicObject->getVar('topic_id')] = $topicObject->getVar('topic_title');
		}
		return $topicArray;
	}
	private function &getGroupArray(){
		$groupHandler = xoops_getmodulehandler('groups','user');
		$groupObjects = $groupHandler->getObjects();
		$groupArray = array();
		foreach($groupObjects as $groupObject){
			$groupArray[$groupObject->getVar('groupid')] = $groupObject->getVar('name');
		}
		return $groupArray;
	}
	function executeViewIndex(&$controller, &$render)
	{
		$gPermObjects = $this->getGPermObjects($this->permNumber);
		$gPermArray = array();
		foreach($gPermObjects as $gPermObject){
			$gPermArray[$gPermObject->getVar('gperm_groupid')][$gPermObject->getVar('gperm_itemid')] = 1;
		}
		$render->setTemplateName("groupPerm_list.html");
		$render->setAttribute("permNumber", $this->permNumber);
		$render->setAttribute("gPermArray", $gPermArray);
		$render->setAttribute("topicArray",$this->getTopicArray());
		$render->setAttribute("groupArray",$this->getGroupArray());
		$render->setAttribute("topicObjects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
	}
}

