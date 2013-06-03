<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/04/14
 * Time: 23:57
 * To change this template use File | Settings | File Templates.
 */

class Controller_Comment_edit extends AbstractAction {
	public function action_index(){
		// using core comment code
		$com_itemid = $this->root->mContext->mRequest->getRequest('com_itemid');
		$xoopsUser = $this->root->mContext->mXoopsUser;
		$xoopsModule = $this->root->mContext->mXoopsModule;
		$xoopsModuleConfig = $this->root->mContext->mModuleConfig;
		global $xoopsTpl;
		$_POST['page'] = 'locationDetail';
		$_POST['com_id'] = $this->root->mContext->mRequest->getRequest('com_id');
		if (isset($_GET['com_order'])) {
			$_POST['com_order'] = $this->root->mContext->mRequest->getRequest('com_order');
		} else {
			$_GET['com_order'] = 1;
		}
		$action = "comment_edit.php";
		//$action = preg_replace("/_php$/i", ".php", $this->mParams[0]);
		require XOOPS_ROOT_PATH . '/include/' . $action;
		exit;
	}
}
