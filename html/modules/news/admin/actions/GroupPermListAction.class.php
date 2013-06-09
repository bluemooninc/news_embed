<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
require_once XOOPS_MODULE_PATH . "/news/class/AbstractListAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/GroupPermFilterForm.class.php";
require_once XOOPS_MODULE_PATH . "/news/app/Model/GroupPerm.class.php";

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

	function getTokenName()
	{
		return "module.news.GroupPermAdminEditForm.TOKEN";
	}
	protected function &setToken( $name='news', $timeout=0 ) {
		$mTokenHandler = new XoopsMultiTokenHandler();
		return $mTokenHandler->create($name,$timeout);
	}
	function executeViewIndex(&$controller, &$render)
	{
		$ticket = $this->setToken($this->getTokenName());
		$render->setAttribute("tokenName", $this->getTokenName());
		$render->setAttribute("tokenValue", $ticket->getTokenValue());
		$Model_GroupPerm = Model_GroupPerm::forge();
		$gPermObjects = $Model_GroupPerm->getGPermObjects($this->permNumber);
		$gPermArray = array();
		foreach($gPermObjects as $gPermObject){
			$gPermArray[$gPermObject->getVar('gperm_groupid')][$gPermObject->getVar('gperm_itemid')] = $gPermObject->getVar('gperm_id');
		}
		$render->setTemplateName("groupPerm_list.html");
		$render->setAttribute("permNumber", $this->permNumber);
		$render->setAttribute("gPermArray", $gPermArray);
		$render->setAttribute("topicArray", $Model_GroupPerm->getTopicArray());
		$render->setAttribute("groupArray", $Model_GroupPerm->getGroupArray());
		$render->setAttribute("topicObjects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
	}
}

