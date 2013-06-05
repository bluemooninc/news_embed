<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/04
 * Time: 22:39
 * To change this template use File | Settings | File Templates.
 */
require_once _MY_MODULE_PATH . 'app/Model/article.php';
require_once _MY_MODULE_PATH . 'app/View/view.php';

class Controller_Submit extends AbstractAction {
	protected $storyid;
	protected $action;
	protected $filesObjects;
	function __construct(){
		parent::__construct();
		$this->mModel = Model_Article::forge();
		$this->storyid = $this->root->mContext->mRequest->getRequest('storyid');
		$this->action = $this->root->mContext->mRequest->getRequest('action');
	}
	private function &_setupActionForm($object)
	{
		require_once XOOPS_ROOT_PATH . '/modules/news/admin/forms/StoryAdminEditForm.class.php';
		$mActionForm = new news_StoryAdminEditForm();
		$mActionForm->prepare();
		$mActionForm->load($object);
		return $mActionForm;
	}
	private function &_setupAttachActionForm(&$storyObject)
	{
		// loding ActionForm
		require_once XOOPS_ROOT_PATH . '/modules/news/admin/forms/AttachAdminEditForm.class.php';
		// Create blank Object and set initial parameter
		$attachHandler = xoops_getmodulehandler('stories_files');
		$attachObject = $attachHandler->create();
		$attachObject->set('storyid',$storyObject->getVar('storyid'));
		$mActionForm = new news_AttachAdminEditForm();
		$mActionForm->prepare();
		// set parameter
		$mActionForm->load($attachObject);
		// get From POST
		$mActionForm->update($attachObject);
		// save to DB
		$attachHandler->insert($attachObject);
		return $mActionForm;
	}
	public function action_index(){
		$this->template = 'news_submit.html';
		$object = $this->mModel->get_story($this->storyid);
		$this->mActionForm = $this->_setupActionForm($object);
		if ($this->action=="StoryEdit"){
			$this->mActionForm->fetch();
			$this->mActionForm->validate();
			if($this->mActionForm->hasError()) {
				return NEWS_FRAME_VIEW_INPUT;
			}
			$this->mActionForm->update($object);
			// for Attach file
			$this->_setupAttachActionForm($object);
		}
		$this->filesObjects = $this->mModel->get_files($this->storyid);
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('actionForm', $this->mActionForm);
		$view->set('filesObjects', $this->filesObjects);
		$topicsHandler = xoops_getmodulehandler('topics');
		$view->set("topicOptions", $topicsHandler->getTopicsOptions());
		$this->setDatepicker();
	}
}