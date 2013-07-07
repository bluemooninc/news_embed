<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/05
 * Time: 16:32
 * To change this template use File | Settings | File Templates.
 */
include_once _MY_MODULE_PATH . 'app/Model/article.php';
include_once _MY_MODULE_PATH . 'app/View/view.php';
include_once _MY_MODULE_PATH . 'admin/forms/AttachAdminEditForm.class.php';   // loding ActionForm

class Controller_DeleteAttached extends AbstractController {
	protected $fileObject;
	protected $mActionForm;
	protected $action;
	protected $file_id;
	function __construct(){
		parent::__construct();
		$this->action = $this->root->mContext->mRequest->getRequest('action');
		$this->file_id = $this->root->mContext->mRequest->getRequest('fileid');
	}
	public function action_index(){
		$this->template = 'delete_attached.html';
		$model = Model_Article::forge();
		$this->fileObject = $model->get_file($this->file_id);
		if ($this->action=="AttachDelete"){
			$model->delete_file($this->fileObject);
			redirect_header(XOOPS_URL . "/modules/news/app/submit.php?op=edit&amp;storyid=".$this->fileObject->getVar('storyid'),3,"Delete Attached");
		}
	}
	private function &_setAttachActionForm(&$attachObject)
	{
		$mActionForm = new news_AttachAdminEditForm();
		$mActionForm->prepare();
		$mActionForm->load($attachObject);
		return $mActionForm;
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('fileObject', $this->fileObject);
		$this->_setAttachActionForm($this->fileObject);
		if ($this->mActionForm){
			$view->set('actionForm', $this->mActionForm);
		}
		if (is_object($this->mPagenavi)) {
			$view->set('pageNavi', $this->mPagenavi->getNavi());
		}
	}
}