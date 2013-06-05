<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/05
 * Time: 16:32
 * To change this template use File | Settings | File Templates.
 */
require_once _MY_MODULE_PATH . 'app/Model/article.php';
require_once _MY_MODULE_PATH . 'app/View/view.php';

class Controller_DeleteAttached extends AbstractAction {
	public function action_index(){
		$this->template = 'delete_attached.html';
	}
	public function action_view(){
		$view = new View($this->root);
		$view->setTemplate($this->template);
		$view->set('filesObjects', $this->filesObjects);
		if ($this->mActionForm){
			$view->set('actionForm', $this->mActionForm);
		}
		if (is_object($this->mPagenavi)) {
			$view->set('pageNavi', $this->mPagenavi->getNavi());
		}
	}
}