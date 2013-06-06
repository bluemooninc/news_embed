<?php
/**
 * Copyright (c) Bluemoon inc. GPL V3 license.
 * 2013-02-16 : Add barcode by Yoshi Sakai
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";
require_once XOOPS_MODULE_PATH . "/legacy/class/Legacy_Validator.class.php";

class news_TopicAdminEditForm extends XCube_ActionForm
{
	var $mOldFileName = null;
	var $_mIsNew = false;
	var $mFormFile = null;

	function getTokenName()
	{
		return "module.news.TopicAdminEditForm.TOKEN" . $this->get('topic_id');
	}

	function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['topic_id'] =new XCube_IntProperty('topic_id');
		$this->mFormProperties['topic_title'] =new XCube_StringProperty('topic_title');
		$this->mFormProperties['topic_pid'] =new XCube_IntProperty('topic_pid');
		//
		// Set field properties
		//
		/*
		$this->mFieldProperties['topic_id'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['topic_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['topic_id']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_STORY_ID);
		*/

		$this->mFieldProperties['topic_title'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['topic_title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['topic_title']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_TITLE, '255');
		$this->mFieldProperties['topic_title']->addMessage('maxlength', _MD_NEWS_ERROR_MAXLENGTH, _MD_NEWS_TITLE, '255');
		$this->mFieldProperties['topic_title']->addVar('maxlength', '255');
	}

	function load(&$obj)
	{
		$topic_id = xoops_getrequest('topic_id') ? xoops_getrequest('topic_id') : $obj->get('topic_id');
		$this->set('topic_id', $obj->get('topic_id'));
		$this->set('topic_title', $obj->get('topic_title'));
		$this->set('topic_pid', $obj->get('topic_pid'));
	}

	function update(&$obj)
	{
		$obj->set('topic_id', $this->get('topic_id'));
		$obj->set('topic_title', $this->get('topic_title'));
		$obj->set('topic_pid', $this->get('topic_pid'));
	}
}
