<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/03
 * Time: 14:55
 * To change this template use File | Settings | File Templates.
 */
class Model_Article extends AbstractModel
{
	protected $storyHandler;
	protected $topicHandler;
	protected $filesHandler;
	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->_module_names = $this->getModuleNames();
		$this->storyHandler =& xoops_getModuleHandler('stories');
		$this->topicHandler =& xoops_getModuleHandler('topics');
		$this->filesHandler =& xoops_getModuleHandler('stories_files');
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
			$instance = new Model_Article();
		}
		return $instance;
	}

	public function &get_story($story_id=0){
		if ($story_id){
			return $this->storyHandler->get($story_id);
		}else{
			return $this->storyHandler->create();
		}
	}
	public function &get_topic($topic_id=0){
		if ($topic_id){
			return $this->topicHandler->get($topic_id);
		}else{
			return $this->topicHandler->create();
		}
	}
	public function &get_files($story_id=0){
		$filesHandler = xoops_getmodulehandler('stories_files');
		$criteria = new Criteria('storyid',$story_id);
		$filesObjects = $filesHandler->getObjects($criteria);
		return $filesObjects;
	}
	public function &get_user($uid){
		$userHandler = xoops_getmodulehandler('users','user');
		return $userHandler->get($uid);
	}
}