<?php
/**
 * Copyright (c) Bluemoon inc. GPL V3 license.
 * 2013-02-16 : Add barcode by Yoshi Sakai
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";
require_once XOOPS_MODULE_PATH . "/legacy/class/Legacy_Validator.class.php";

class news_StoryAdminEditForm extends XCube_ActionForm
{
	var $mOldFileName = null;
	var $_mIsNew = false;
	var $mFormFile = null;

	function getTokenName()
	{
		return "module.news.StoryAdminEditForm.TOKEN" . $this->get('storyid');
	}

	function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['storyid'] =new XCube_IntProperty('storyid');
		$this->mFormProperties['topicid'] =new XCube_IntProperty('topicid');
		$this->mFormProperties['title'] =new XCube_StringProperty('title');
		$this->mFormProperties['hometext'] =new XCube_TextProperty('hometext');
		$this->mFormProperties['bodytext'] =new XCube_TextProperty('bodytext');
		$this->mFormProperties['keywords'] =new XCube_StringProperty('keywords');
		$this->mFormProperties['created'] =new XCube_IntProperty('created');
		$this->mFormProperties['published'] =new XCube_StringProperty('published');
		$this->mFormProperties['expired'] =new XCube_StringProperty('expired');
		//
		// Set field properties
		//
		$this->mFieldProperties['storyid'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['storyid']->setDependsByArray(array('required'));
		$this->mFieldProperties['storyid']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_STORY_ID);
	
		$this->mFieldProperties['title'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_TITLE, '255');
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_NEWS_ERROR_MAXLENGTH, _MD_NEWS_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');

	}

	function load(&$obj)
	{
		$topicid = xoops_getrequest('topicid') ? xoops_getrequest('topicid') : $obj->get('topicid');
		$this->set('storyid', $obj->get('storyid'));
		$this->set('uid', $obj->get('uid'));
		$this->set('topicid', $topicid);
		$this->set('title', $obj->get('title'));
		$this->set('hometext', $obj->get('hometext'));
		$this->set('bodytext', $obj->get('bodytext'));
		$this->set('created', $obj->get('created'));
		$this->set('published', $obj->get('published') ? date("Y-m-d g:i", $obj->get('published')) : NULL);
		$this->set('expired', $obj->get('expired') ? date("Y-m-d g:i", $obj->get('expired')) : NULL);
	}

	function update(&$obj)
	{
		$uid = $obj->get('uid') ? $obj->get('uid') : Legacy_Utils::getUid();
		$obj->set('storyid', $this->get('storyid'));
		$obj->set('uid', $uid);
		$obj->set('topicid', $this->get('topicid'));
		$obj->set('title', $this->get('title'));
		$obj->set('hometext', $this->get('hometext'));
		$obj->set('bodytext', $this->get('bodytext'));
		$obj->set('published',strtotime($this->get('published')));
		$obj->set('expired', strtotime($this->get('expired')));
		$obj->set('created', time());
	}
}
