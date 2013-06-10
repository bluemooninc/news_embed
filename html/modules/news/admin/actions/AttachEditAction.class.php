<?php
/**
 * @package news
 * @version $Id: AttachEditAction.class.php,v 1.1 2007/05/15 02:34:41 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractEditAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/AttachAdminEditForm.class.php";

class news_AttachEditAction extends news_AbstractEditAction
{
	function __construct(){
		$this->_getHandler();
	}
	function _getId()
	{
		return xoops_getrequest('fileid');
	}
	
	function &_getHandler()
	{
		$this->mObjectHandler = xoops_getmodulehandler('stories_files');
		return $this->mObjectHandler;
	}

	function _setupActionForm()
	{
		$this->mActionForm =new news_AttachAdminEditForm();
		$this->mActionForm->prepare();
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("attach_edit.html");
		$storyHandler = xoops_getmodulehandler('stories');
		$render->setAttribute("storyOptions", $storyHandler->getStoryOptions());
		$render->setAttribute("actionForm", $this->mActionForm);
	}

	function executeViewSuccess(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=AttachList&storyid=".xoops_getrequest('storyid'));
	}

	function executeViewError(&$controller, &$render)
	{
		$controller->executeRedirect("index.php?action=AttachList", 5, "Error");
	}

	function executeViewCancel(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=AttachList");
	}
}
