<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractListAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/StoryFilterForm.class.php";

class news_StoryListAction extends news_AbstractListAction
{
	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('stories');
		return $handler;
	}

	function &_getFilterForm()
	{
		$filter =new news_StoryFilterForm($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	function _getBaseUrl()
	{
		return "./index.php?action=StoryList";
	}

	function executeViewIndex(&$controller, &$render)
	{
		$render->setTemplateName("story_list.html");
		$render->setAttribute("objects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
		$topicsHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("topicsList", $topicsHandler->getTopicsOptions());
	}
}

