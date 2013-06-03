<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractEditAction.class.php";

class news_AbstractDeleteAction extends news_AbstractEditAction
{
	function isEnableCreate()
	{
		return false;
	}

	function _doExecute()
	{
		return $this->mObjectHandler->delete($this->mObject);
	}
}

?>
