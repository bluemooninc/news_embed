<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractListAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/TopicFilterForm.class.php";

class news_TopicListAction extends news_AbstractListAction
{
	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('topics');
		return $handler;
	}

	function &_getFilterForm()
	{
		$filter =new news_TopicFilterForm($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	function _getBaseUrl()
	{
		return "./index.php?action=TopicList";
	}
	function executeViewIndex(&$controller, &$render)
	{
		$render->setTemplateName("topic_list.html");
		$render->setAttribute("objects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
		$topicsHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("topicsList", $topicsHandler->getTopicsOptions());
	}
}

