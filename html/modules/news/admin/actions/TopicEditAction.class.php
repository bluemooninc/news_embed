<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractEditAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/TopicAdminEditForm.class.php";

class news_TopicEditAction extends news_AbstractEditAction
{
	function _getId()
	{
		return xoops_getrequest('topic_id');
	}
	
	function &_getHandler()
	{
		$this->mObjectHandler =& xoops_getmodulehandler('topics');
		return $this->mObjectHandler;
	}

	function _setupActionForm()
	{
		$this->_getHandler();
		$this->mActionForm = new news_TopicAdminEditForm();
		$this->mActionForm->prepare();
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("topic_edit.html");
		$render->setAttribute("actionForm", $this->mActionForm);
		$topicsHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("topicOptions", $topicsHandler->getTopicsOptions());
	}

	function executeViewSuccess(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=TopicList");
	}

	function executeViewError(&$controller, &$render)
	{
		$controller->executeRedirect("index.php?action=TopicList", 5, _MD_NEWS_ERROR_DBUPDATE_FAILED);
	}

	function executeViewCancel(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=TopicList");
	}
}
