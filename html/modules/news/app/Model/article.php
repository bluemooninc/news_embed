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
	//
	// stories
	public function &get_story($story_id=0){
		if ($story_id){
			return $this->storyHandler->get($story_id);
		}else{
			return $this->storyHandler->create();
		}
	}
	public function &get_stories($topic_id=0,$uid=0){
		$criteria = new CriteriaCompo();
		if ($topic_id>0){
			$criteria->add(new Criteria("topicid",$topic_id));
		}
		if ($uid>0){
			$criteria->add(new Criteria("uid",$uid));
		}
		$criteria->addSort('published');
		$criteria->addSort('created');
		return $this->storyHandler->getObjects($criteria);
	}
	public function set_story(&$object){
		$this->storyHandler->insert($object);
	}

		// topics
	public function &get_topic($topic_id=0){
		if ($topic_id){
			return $this->topicHandler->get($topic_id);
		}else{
			return $this->topicHandler->create();
		}
	}
	public function &get_topics(){
		return $this->topicHandler->getObjects();
	}

	public function &get_file($file_id=0){
		$fileObject = $this->filesHandler->get($file_id);
		return $fileObject;
	}
	public function &get_files($story_id=0){
		$criteria = new Criteria('storyid',$story_id);
		$filesObjects = $this->filesHandler->getObjects($criteria);
		return $filesObjects;
	}
	public function delete_file(&$attachObject)
	{
		if(!$attachObject) return;
		$original_filename = XOOPS_ROOT_PATH."/uploads/".$attachObject->getVar('realfilename');
		if (file_exists($original_filename)){
			unlink($original_filename);
		}
		$this->filesHandler->delete($attachObject);
	}

	public function &get_user($uid){
		$userHandler = xoops_getmodulehandler('users','user');
		return $userHandler->get($uid);
	}
}