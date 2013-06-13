<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractEditAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/GroupPermAdminEditForm.class.php";

class news_GroupPermEditAction extends news_AbstractEditAction
{
	function _getId()
	{
	}
	
	function _getHandler()
	{

	}

	function _setupActionForm()
	{
		$this->mActionForm =new news_GroupPermAdminEditForm();
		$this->mActionForm->prepare();
	}

	function execute(&$controller, &$render){
		$this->mActionForm->update();
		$controller->executeForward("index.php?action=GroupPermList&permNumber=".$this->mActionForm->permNumber());
	}
}
