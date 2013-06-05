<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/05
 * Time: 7:35
 * To change this template use File | Settings | File Templates.
 */
require_once _MY_MODULE_PATH . 'app/Model/article.php';
require_once _MY_MODULE_PATH . 'app/View/view.php';

class Controller_News extends AbstractAction {
	protected $topicsObjects;
	protected $storyObjects;
	protected $userObject;
	public function action_index(){
		$this->template = 'news_index.html';
		$topic_id = $this->root->mContext->mRequest->getRequest( 'topic_id' );
		$uid = $this->root->mContext->mRequest->getRequest( 'uid' );
		$model = Model_Article::forge();
		$this->topicObjects = $model->get_topics();
		$this->storyObjects = $model->get_stories($topic_id,$uid);
		if($uid){
			$this->userObject = $model->get_user($uid);
		}
/*
		if($this->storyObjects){
			$this->topicObject = $model->get_topic($this->storyObject->getVar('topicid'));
			$this->filesObjects = $model->get_files($story_id);
			$this->userObject = $model->get_user($this->storyObject->getVar('uid'));
		}*/
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('storyObjects', $this->storyObjects);
		$view->set('topicObjects', $this->topicObjects);
		$view->set('userObject', $this->userObject);
//		$view->set('filesObjects', $this->filesObjects);

		// for comment section
		//$this->_comment_view();
		if (is_object($this->mPagenavi)) {
			$view->set('pageNavi', $this->mPagenavi->getNavi());
		}
	}
}