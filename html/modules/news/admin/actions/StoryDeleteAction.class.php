<?php
/**
 * @package news
 * @version $Id: StoryDeleteAction.class.php,v 1.2 2007/08/24 14:17:42 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractDeleteAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/StoryAdminDeleteForm.class.php";

class news_StoryDeleteAction extends news_AbstractDeleteAction
{
	function _getId()
	{
		return xoops_getrequest('storyid');
	}

	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('stories');
		return $handler;
	}

	function _setupActionForm()
	{
		$this->mActionForm =new news_StoryAdminDeleteForm();
		$this->mActionForm->prepare();
	}
	
	function _doExecute()
	{
		$handler =& xoops_getmodulehandler('stories');
		$story =& $handler->get($this->mObject->get('storyid'));
				
		if (!$handler->delete($story)) {
			return NEWS_FRAME_VIEW_ERROR;
		}
		
		return NEWS_FRAME_VIEW_SUCCESS;
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("story_delete.html");
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
	}

	function executeViewSuccess(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=StoryList");
	}

	function executeViewError(&$controller,  &$render)
	{
		$controller->executeRedirect("./index.php?action=StoryList", 1, _MD_NEWS_ERROR_DBUPDATE_FAILED);
	}

	function executeViewCancel(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=StoryList");
	}
}