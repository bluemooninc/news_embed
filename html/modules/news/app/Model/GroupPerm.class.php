<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/08
 * Time: 11:07
 * To change this template use File | Settings | File Templates.
 */
include_once XOOPS_ROOT_PATH . '/modules/news/app/Model/AbstractNewsModel.class.php';

class Model_GroupPerm extends AbstractNewsModel
{
	protected $module_id;
	protected $mHandler;
	protected $perm_name;
	function __construct(){
		parent::__construct();
		$this->module_id = $this->root->mContext->mXoopsModule->get('mid');
		$this->mHandler =& xoops_getmodulehandler('group_permission','legacy');
	}
	/**
	 * get Instance
	 * @param none
	 * @return object Instance
	 */
	public function &forge()
	{
		static $instance;
		if (!isset($instance)) {
			$instance = new Model_GroupPerm();
		}
		return $instance;
	}
	private function _getPermName($permNumber){
		switch($permNumber)
		{
			case 1:
				$this->perm_name = "news_approve";
				break;
			case 2:
				$this->perm_name = "news_submit";
				break;
			case 3:
				$this->perm_name = "news_view";
				break;
		}
		return $this->perm_name;
	}
	private function &_getPermObjects($group_id,$topic_id,$permNumber){
		$this->perm_name = $this->_getPermName($permNumber);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('gperm_groupid',$group_id));
		$criteria->add(new Criteria('gperm_itemid',$topic_id));
		$criteria->add(new Criteria('gperm_modid',$this->module_id));
		$criteria->add(new Criteria('gperm_name',$this->perm_name));
		$this->mHandler =& xoops_getmodulehandler('group_permission','legacy');
		$gPermObjects = $this->mHandler->getObjects($criteria);
		return $gPermObjects;
	}
	public function checkPerm($permNumber,$topic_id=0){
		if ($topic_id==0) return true;
		if($this->root->mContext->mXoopsUser){
			$uid = $this->root->mContext->mXoopsUser->get('uid');
			$gHandler =& xoops_gethandler('member');
			$groupIds =& $gHandler->getGroupsByUser($uid);
		}else{
			$groupIds = array(3);
		}
		$criteria = new CriteriaCompo();
		$this->perm_name  = $this->_getPermName($permNumber);
		$criteria->add(new Criteria('gperm_groupid',implode(",",$groupIds),"IN"));
		$criteria->add(new Criteria('gperm_itemid',$topic_id));
		$criteria->add(new Criteria('gperm_modid',$this->module_id));
		$criteria->add(new Criteria('gperm_name',$this->perm_name));
		$this->mHandler =& xoops_getmodulehandler('group_permission','legacy');
		$gPermObjects = $this->mHandler->getObjects($criteria);
		if ($gPermObjects){
			return true;
		}
		return false;
	}
	/**
	 * @param $permNumber
	 * @return XoopsGroupPermForm
	 */
	public function &getGPermObjects($permNumber){
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('gperm_modid',$this->module_id));
		$criteria->add(new Criteria('gperm_name',$this->_getPermName($permNumber)));
		$criteria->addSort('gperm_groupid');

		$gPermObjects = $this->mHandler->getObjects($criteria);
		return $gPermObjects;
	}
	public function &setGPermObject($permNumber,$group_id,$topic_id,$delete=false){
		$gPermObjects = $this->_getPermObjects($group_id,$topic_id,$permNumber);
		if($gPermObjects && $delete==true){
			$this->mHandler->delete($gPermObjects[0]);
		}elseif ($delete==false){
			$gPermObject = $this->mHandler->create();
			$gPermObject->set('gperm_groupid',$group_id);
			$gPermObject->set('gperm_itemid',$topic_id);
			$gPermObject->set('gperm_modid',$this->module_id);
			$gPermObject->set('gperm_name',$this->perm_name);
			$this->mHandler->insert($gPermObject);
		}
		return $gPermObjects;
	}
	public function &getTopicArray(){
		$topicHandler = xoops_getmodulehandler('topics');
		$topicObjects = $topicHandler->getObjects();
		$topicArray = array();
		foreach($topicObjects as $topicObject){
			$topicArray[$topicObject->getVar('topic_id')] = $topicObject->getVar('topic_title');
		}
		return $topicArray;
	}
	public function &getGroupArray(){
		$groupHandler = xoops_getmodulehandler('groups','user');
		$groupObjects = $groupHandler->getObjects();
		$groupArray = array();
		foreach($groupObjects as $groupObject){
			$groupArray[$groupObject->getVar('groupid')] = $groupObject->getVar('name');
		}
		return $groupArray;
	}
}