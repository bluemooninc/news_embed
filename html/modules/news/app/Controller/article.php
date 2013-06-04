<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/03
 * Time: 14:32
 * To change this template use File | Settings | File Templates.
 */

//namespace Controller;
require_once _MY_MODULE_PATH . 'app/Model/article.php';
require_once _MY_MODULE_PATH . 'app/View/view.php';

class Controller_Article extends AbstractAction {
	protected $storyObject = null;
	protected $topicObject = null;
	protected $userObject = null;
	protected $filesObjects = null;
	public function action_index(){
		$this->template = 'news_article.html';
		$story_id = $this->root->mContext->mRequest->getRequest( 'storyid' );
		$model = Model_Article::forge();
		$this->storyObject = $model->get_story($story_id);
		if($this->storyObject){
			$this->topicObject = $model->get_topic($this->storyObject->getVar('topicid'));
			$this->filesObjects = $model->get_files($story_id);
			$this->userObject = $model->get_user($this->storyObject->getVar('uid'));
		}
	}
	private function _comment_view()
	{
		// include comment from core
		$xoopsConfig = $this->root->mContext->mXoopsConfig;
		$xoopsUser = $this->root->mContext->mXoopsUser;
		$xoopsModule = $this->root->mContext->mXoopsModule;
		$xoopsModuleConfig = $this->root->mContext->mModuleConfig;
		global $xoopsTpl;
		require_once XOOPS_ROOT_PATH . '/include/comment_view.php';
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('storyObject', $this->storyObject);
		$view->set('topicObject', $this->topicObject);
		$view->set('userObject', $this->userObject);
		$view->set('filesObjects', $this->filesObjects);
		$view->set('actionForm', $this->mActionForm);

		// for comment section
		$this->_comment_view();
		if (is_object($this->mPagenavi)) {
			$view->set('pageNavi', $this->mPagenavi->getNavi());
		}
	}
}