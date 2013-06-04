<?php
/**
 * @package user
 * @version $Id: UserAdminDeleteForm.class.php,v 1.2 2007/06/07 05:27:37 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";

class news_AttachAdminDeleteForm extends XCube_ActionForm
{
	function getTokenName()
	{
		return "module.user.AttachAdminDeleteForm.TOKEN" . $this->get('fileid');
	}

	function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['fileid'] =new XCube_IntProperty('fileid');
		$this->mFormProperties['storyid'] =new XCube_IntProperty('storyid');
		$this->mFormProperties['filerealname'] = new XCube_StringProperty('filerealname');
		//
		// Set field properties
		//
		$this->mFieldProperties['fileid'] =new XCube_FieldProperty($this);
		$this->mFieldProperties['fileid']->setDependsByArray(array('required'));
		$this->mFieldProperties['fileid']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_ATTACH_ID);
	}

	function load(&$obj)
	{
		$this->set('fileid', $obj->get('fileid'));
		$this->set('storyid', $obj->get('storyid'));
		$this->set('filerealname', $obj->get('filerealname'));
	}

	function update(&$obj)
	{
		$obj->setVar('fileid', $this->get('fileid'));
	}
}

?>
