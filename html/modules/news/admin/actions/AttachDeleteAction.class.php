<?php
/**
 * @package news
 * @version $Id: AttachDeleteAction.class.php,v 1.2 2007/08/24 14:17:42 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractDeleteAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/AttachAdminDeleteForm.class.php";

class news_AttachDeleteAction extends news_AbstractDeleteAction
{
	function _getId()
	{
		return xoops_getrequest('fileid');
	}

	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('stories_files');
		return $handler;
	}

	function _setupActionForm()
	{
		$this->mActionForm =new news_AttachAdminDeleteForm();
		$this->mActionForm->prepare();
	}
	
	function _doExecute()
	{
		$handler =& xoops_getmodulehandler('stories_files');
		$attachObject =& $handler->get($this->mObject->get('fileid'));
		$original_filename = XOOPS_ROOT_PATH."/uploads/".$attachObject->getVar('realfilename');

		if (file_exists($original_filename)){
			unlink($original_filename);
		}
		if (!$handler->delete($attachObject)) {
			return NEWS_FRAME_VIEW_ERROR;
		}
		
		return NEWS_FRAME_VIEW_SUCCESS;
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("attach_delete.html");
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
	}

	function executeViewSuccess(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=AttachList&storyid=".xoops_getrequest('storyid'));
	}

	function executeViewError(&$controller,  &$render)
	{
		$controller->executeRedirect("./index.php?action=AttachList&storyid=".xoops_getrequest('storyid'), 1, _MD_NEWS_ERROR_DBUPDATE_FAILED);
	}

	function executeViewCancel(&$controller,  &$render)
	{
		$controller->executeForward("./index.php?action=AttachList&storyid=".xoops_getrequest('storyid'));
	}
}