<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/05
 * Time: 7:35
 * To change this template use File | Settings | File Templates.
 */
include_once _MY_MODULE_PATH . 'app/Model/article.php';
include_once _MY_MODULE_PATH . 'app/View/view.php';

class Controller_News extends AbstractController {
	protected $topicObject;
	protected $topicArray;
	protected $storyObjects;
	protected $userObject;
	protected $topic_id;
	protected $start = 0;
	protected $perpage = 10;
	protected $mModel;

	public function action_index(){
		$this->template = 'news_index.html';
		$this->topic_id = $this->root->mContext->mRequest->getRequest( 'topicid' );
		$this->start = $this->root->mContext->mRequest->getRequest( 'start' );
		$uid = $this->root->mContext->mRequest->getRequest( 'uid' );
		$this->mModel = Model_Article::forge();
		$this->topicObject = $this->mModel->get_topic($this->topic_id);
		$topicObjects = $this->mModel->get_topics();
		$this->topicArray = $this->getTopicArray($topicObjects,$this->topic_id);
		$this->storyObjects = $this->mModel->get_stories($this->topic_id,$uid,$this->perpage,$this->start);
		if($uid){
			$this->userObject = $this->mModel->get_user($uid);
		}
	}
	private function &getTopicArray(&$topicObjects,$topic_id=0){
		$topics = array();
		// nav
		foreach($topicObjects as $topicObject){
			if ($topicObject->getVar('topic_pid')==$topic_id){
				$topics[$topicObject->getVar('topic_id')]=array(
					'topic_id'=>$topicObject->getVar('topic_id'),
					'topic_title'=>$topicObject->getVar('topic_title')
				);
			}
		}
		// nav child
		foreach($topicObjects as $topicObject){
			if (isset($topics[$topicObject->getVar('topic_pid')])){
				$topics[$topicObject->getVar('topic_pid')]['child'][]=array(
					'topic_id'=>$topicObject->getVar('topic_id'),
					'topic_title'=>$topicObject->getVar('topic_title')
				);
			}
		}
		return $topics;
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('topicObject', $this->topicObject);
		$view->set('topicArray', $this->topicArray);
		$view->set('storyObjects', $this->storyObjects);
		$view->set('userObject', $this->userObject);
		$view->set('topic_id', $this->topic_id);
		// for comment section
		//$this->_comment_view();
		if (is_object($this->mModel->mPagenavi)) {
			$view->set('pageNavi', $this->mModel->mPagenavi->getNavi());
		}
	}
}