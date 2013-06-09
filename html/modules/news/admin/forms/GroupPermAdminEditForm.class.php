<?php
/**
 * Copyright (c) Bluemoon inc. GPL V3 license.
 * 2013-02-16 : Add barcode by Yoshi Sakai
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_ROOT_PATH . "/core/XCube_ActionForm.class.php";
require_once XOOPS_MODULE_PATH . "/legacy/class/Legacy_Validator.class.php";
require_once XOOPS_MODULE_PATH . "/news/app/Model/GroupPerm.class.php";

class news_GroupPermAdminEditForm extends XCube_ActionForm
{
	var $mOldFileName = null;
	var $_mIsNew = false;
	var $mFormFile = null;
	protected $permNumber;
	protected $topic_ids;
	protected $gPermObjects;

	function getTokenName()
	{
		return "module.news.GroupPermAdminEditForm.TOKEN";
	}

	function prepare()
	{
		$root = XCube_Root::getSingleton();
		$this->permNumber = $root->mContext->mRequest->getRequest('permNumber');
		$this->topic_ids = $root->mContext->mRequest->getRequest('topic_ids');
	}

	function permNumber()
	{
		return $this->permNumber;
	}

	function update()
	{
		$Model_GroupPerm = Model_GroupPerm::forge();
		$groupArray = $Model_GroupPerm->getGroupArray();
		$topicArray = $Model_GroupPerm->getTopicArray();
		foreach($groupArray as $groupId=>$groupName){
			foreach($topicArray as $topicId=>$topicName){
				if (isset($this->topic_ids[$groupId][$topicId])){
					if ($this->topic_ids[$groupId][$topicId]=="on"){
						$Model_GroupPerm->setGPermObject($this->permNumber,$groupId,$topicId);
					}
				}else{
					$Model_GroupPerm->setGPermObject($this->permNumber,$groupId,$topicId,true);
				}
			}
		}
	}

}
