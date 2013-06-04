<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractListAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/AttachFilterForm.class.php";

class news_AttachListAction extends news_AbstractListAction
{
	protected $storyid;
	protected $itemObject;

	function &_getHandler()
	{
		$handler =& xoops_getmodulehandler('stories_files');
		return $handler;
	}

	function &_getFilterForm()
	{
		$root =& XCube_Root::getSingleton();
		$this->storyid = $root->mContext->mRequest->getRequest('storyid');
		$itemHandler =& xoops_getmodulehandler('stories_files');
		$this->itemObject = $itemHandler->get($this->storyid);
		$filter =new news_AttachFilterForm($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	function _getBaseUrl()
	{
		return "./index.php?action=AttachList";
	}

	function executeViewIndex(&$controller, &$render)
	{
		$render->setTemplateName("attach_list.html");
		$render->setAttribute("storyid", $this->storyid);
		$render->setAttribute("itemObject", $this->itemObject);
		$render->setAttribute("objects", $this->mObjects);
		$render->setAttribute("pageNavi", $this->mFilter->mNavi);
		$categoryHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("categoryList", $categoryHandler->getTopicsOptions());
	}
}

