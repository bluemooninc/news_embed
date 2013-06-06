<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";

class news_TopicAdminDeleteForm extends XCube_ActionForm
{
	function getTokenName()
	{
		return "module.user.TopicAdminDeleteForm.TOKEN" . $this->get('topic_id');
	}

	function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['topic_id'] =new XCube_IntProperty('topic_id');

		//
		// Set field properties
		//
		$this->mFieldProperties['topic_id'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['topic_id']->setDependsByArray(array('required'));
		$this->mFieldProperties['topic_id']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _AD_STORYID);
	}

	function load(&$obj)
	{
		$this->set('topic_id', $obj->get('topic_id'));
	}

	function update(&$obj)
	{
		$obj->setVar('topic_id', $this->get('topic_id'));
	}
}

?>
