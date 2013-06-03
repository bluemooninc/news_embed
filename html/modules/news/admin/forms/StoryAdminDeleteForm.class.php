<?php
/**
 * @package user
 * @version $Id: UserAdminDeleteForm.class.php,v 1.2 2007/06/07 05:27:37 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";

class news_StoryAdminDeleteForm extends XCube_ActionForm
{
	function getTokenName()
	{
		return "module.user.StoryAdminDeleteForm.TOKEN" . $this->get('storyid');
	}

	function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['storyid'] =new XCube_IntProperty('storyid');

		//
		// Set field properties
		//
		$this->mFieldProperties['storyid'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['storyid']->setDependsByArray(array('required'));
		$this->mFieldProperties['storyid']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _AD_STORYID);
	}

	function load(&$obj)
	{
		$this->set('storyid', $obj->get('storyid'));
	}

	function update(&$obj)
	{
		$obj->setVar('storyid', $this->get('storyid'));
	}
}

?>
