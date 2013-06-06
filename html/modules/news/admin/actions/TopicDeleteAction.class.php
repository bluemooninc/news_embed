<?php
/**
 * @package news
 * @version $Id: TopicDeleteAction.class.php,v 1.2 2007/08/24 14:17:42 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractDeleteAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/TopicAdminDeleteForm.class.php";

class news_TopicDeleteAction extends news_AbstractDeleteAction
{
	function _getId()
	{
		return xoops_getrequest('topic_id');
	}

	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('topics');
		return $handler;
	}

	function _setupActionForm()
	{
		$this->mActionForm =new news_TopicAdminDeleteForm();
		$this->mActionForm->prepare();
	}
	
	function _doExecute()
	{
		$handler =& xoops_getmodulehandler('topics');
		$topic =& $handler->get($this->mObject->get('topic_id'));
				
		if (!$handler->delete($topic)) {
			return NEWS_FRAME_VIEW_ERROR;
		}
		
		return NEWS_FRAME_VIEW_SUCCESS;
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("topic_delete.html");
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
	}

	function executeViewSuccess(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=TopicList");
	}

	function executeViewError(&$controller,  &$render)
	{
		$controller->executeRedirect("./index.php?action=TopicList", 1, _MD_NEWS_ERROR_DBUPDATE_FAILED);
	}

	function executeViewCancel(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=TopicList");
	}
}