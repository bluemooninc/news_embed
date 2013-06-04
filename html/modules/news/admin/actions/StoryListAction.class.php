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
	function &getUnameArray(&$objects){
		$ret = $uids = array();
		foreach($objects as $object){
			$uids[$object->getVar('uid')] = $object->getVar('uid');
		}
		$criteria = new Criteria('uid',implode(",",$uids),"IN");
		$userHandler = xoops_getmodulehandler("users","user");
		$userObjects = $userHandler->getObjects($criteria);
		foreach($userObjects as $userObject){
			$ret[$userObject->getVar('uid')] = $userObject->getVar('uname');
		}
		return $ret;
	}
	function &getTopicNameArray(&$objects){
		$ret = $tids = array();
		foreach($objects as $object){
			$tids[$object->getVar('topicid')] = $object->getVar('topicid');
		}
		$criteria = new Criteria('topic_id',implode(",",$tids),"IN");
		$topicHandler = xoops_getmodulehandler("topics");
		$topicObjects = $topicHandler->getObjects($criteria);
		foreach($topicObjects as $topicObject){
			$ret[$topicObject->getVar('topic_id')] = $topicObject->getVar('topic_title');
		}
		return $ret;
	}
	function executeViewIndex(&$controller, &$render)
	{
		$render->setTemplateName("story_list.html");
		$render->setAttribute("unameArray", $this->getUnameArray($this->mObjects));
		$render->setAttribute("topicNameArray", $this->getTopicNameArray($this->mObjects));
		$render->setAttribute("objects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
		$topicsHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("topicsList", $topicsHandler->getTopicsOptions());
	}
}

