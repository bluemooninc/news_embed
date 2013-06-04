<?php
/**
 * @package user
 * @version $Id: AttachAdminEditForm.class.php,v 1.1 2007/05/15 02:34:39 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";
require_once XOOPS_MODULE_PATH . "/legacy/class/Legacy_Validator.class.php";

class news_AttachAdminEditForm extends XCube_ActionForm
{
	var $mOldFileName = null;
	var $_mIsNew = false;
	var $mFormFile = null;
	var $mUploadDir;

	function getTokenName()
	{
		return "module.news.AttachAdminEditForm.TOKEN" . $this->get('storyid');
	}

	/**
	 * For displaying the confirm-page, don't show CSRF error.
	 * Always return null.
	 */
	function getTokenErrorMessage()
	{
		return null;
	}

	function prepare()
	{
		$this->mUploadDir = XOOPS_ROOT_PATH . "/uploads/";
		//
		// Set form properties
		//
		$this->mFormProperties['fileid'] = new XCube_IntProperty('fileid');
		$this->mFormProperties['storyid'] = new XCube_IntProperty('storyid');
		$this->mFormProperties['filerealname'] = new XCube_StringProperty('filerealname');
		$this->mFormProperties['downloadname'] = new XCube_FileProperty('downloadname');
		//
		// Set field properties
		//
		$this->mFieldProperties['storyid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['storyid']->setDependsByArray(array('required'));
		$this->mFieldProperties['storyid']->addMessage('required', _MD_NEWS_ERROR_REQUIRED, _MD_NEWS_STORY_ID);
	}

	function load(&$obj)
	{
		if (xoops_getrequest('storyid')){
			$this->set('storyid', xoops_getrequest('storyid'));
		}else{
			$this->set('storyid', $obj->get('storyid'));
		}
		$this->set('fileid', $obj->get('fileid'));
		$this->set('filerealname', $obj->get('filerealname'));
	}

	function update(&$obj)
	{
		$obj->set('fileid', $this->get('fileid'));
		$obj->set('storyid', $this->get('storyid'));
		$fileUploder = $this->_getUploadFile();
		if ($fileUploder) {
			$obj->set('mimetype', $fileUploder->getContentType());
			$obj->set('filerealname', $fileUploder->getFileName());
		} else {
			$obj->set('filerealname', $this->get('filerealname'));
		}
	}

	private function &_getUploadFile()
	{
		$fileUploder = new XCube_FormFile('downloadname');
		$fileUploder->fetch();
		if ($fileUploder->hasUploadFile()) {
			$fname = sprintf("news%d_",$this->get('storyid'));
			$fileUploder->saveAsRandBody($this->mUploadDir, $fname);
		}
		return $fileUploder;
	}

}

?>
