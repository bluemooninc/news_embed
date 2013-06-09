<?php

if (!defined('XOOPS_ROOT_PATH')) exit();

define ("NEWS_FRAME_PERFORM_SUCCESS", 1);
define ("NEWS_FRAME_PERFORM_FAIL", 2);
define ("NEWS_FRAME_INIT_SUCCESS", 3);

define ("NEWS_FRAME_VIEW_NONE", 1);
define ("NEWS_FRAME_VIEW_SUCCESS", 2);
define ("NEWS_FRAME_VIEW_ERROR", 3);
define ("NEWS_FRAME_VIEW_INDEX", 4);
define ("NEWS_FRAME_VIEW_INPUT", 5);
define ("NEWS_FRAME_VIEW_PREVIEW", 6);
define ("NEWS_FRAME_VIEW_CANCEL", 7);

class news_ActionFrame
{
	var $mActionName = null;
	var $mAction = null;
	var $mAdminFlag = null;

	/**
	 * @var XCube_Delegate
	 */
	var $mCreateAction = null;

	function news_ActionFrame($admin)
	{
		$this->mAdminFlag = $admin;
		$this->mCreateAction =new XCube_Delegate();
		$this->mCreateAction->register('news_ActionFrame.CreateAction');
		$this->mCreateAction->add(array(&$this, '_createAction'));
	}

	function setActionName($name)
	{
		$this->mActionName = $name;

		//
		// Temp FIXME!
		//
		$root =& XCube_Root::getSingleton();
		$root->mContext->setAttribute('actionName', $name);
		$root->mContext->mModule->setAttribute('actionName', $name);
	}

	function _createAction(&$actionFrame)
	{
		if (is_object($this->mAction)) {
			return;
		}

		//
		// Create action object by mActionName
		//
		$className = "news_" . ucfirst($actionFrame->mActionName) . "Action";
		$fileName = ucfirst($actionFrame->mActionName) . "Action";
		if ($actionFrame->mAdminFlag) {
			$fileName = XOOPS_MODULE_PATH . "/news/admin/actions/${fileName}.class.php";
		}
		else {
			$fileName = XOOPS_MODULE_PATH . "/news/actions/${fileName}.class.php";
		}

		if (!file_exists($fileName)) {
			die("file_exists on _createAction:".$fileName);
		}

		require_once $fileName;

		if (XC_CLASS_EXISTS($className)) {
			$actionFrame->mAction =new $className($actionFrame->mAdminFlag);
		}
	}

	function execute(&$controller)
	{
		if (!preg_match("/^\w+$/", $this->mActionName)) {
			die();
		}

		//
		// Create action object by mActionName
		//
		$this->mCreateAction->call(new XCube_Ref($this));

		if (!(is_object($this->mAction) && is_a($this->mAction, 'news_Action'))) {
			die("action");	//< TODO
		}

		if ($this->mAction->isSecure() && !is_object($controller->mRoot->mContext->mXoopsUser)) {
			//
			// error
			//

			$controller->executeForward(XOOPS_URL . '/');
		}

		$this->mAction->prepare($controller, $controller->mRoot->mContext->mXoopsUser, $controller->mRoot->mContext->mModuleConfig);

		if (!$this->mAction->hasPermission($controller, $controller->mRoot->mContext->mXoopsUser, $controller->mRoot->mContext->mModuleConfig)) {
			//
			// error
			//
			$controller->executeForward(XOOPS_URL . '/');
		}

		if (xoops_getenv("REQUEST_METHOD") == "POST") {
			$viewStatus = $this->mAction->execute($controller, $controller->mRoot->mContext->mXoopsUser);
		}
		else {
			$viewStatus = $this->mAction->getDefaultView($controller, $controller->mRoot->mContext->mXoopsUser);
		}
		$render = $controller->mRoot->mContext->mModule->getRenderTarget();
		$render->setAttribute('xoops_pagetitle', $this->mAction->getPagetitle());
		switch($viewStatus) {
			case NEWS_FRAME_VIEW_SUCCESS:
				$this->mAction->executeViewSuccess($controller,$render);
				break;

			case NEWS_FRAME_VIEW_ERROR:
				$this->mAction->executeViewError($controller, $render);
				break;

			case NEWS_FRAME_VIEW_INDEX:
				$this->mAction->executeViewIndex($controller, $render);
				break;

			case NEWS_FRAME_VIEW_INPUT:
				$this->mAction->executeViewInput($controller, $render);
				break;

			case NEWS_FRAME_VIEW_PREVIEW:
				$this->mAction->executeViewPreview($controller, $render);
				break;

			case NEWS_FRAME_VIEW_CANCEL:
				$this->mAction->executeViewCancel($controller, $render);
				break;
		}
	}
}

class news_Action
{
	protected $root;
	function __construct(){
		$this->root = XCube_Root::getSingleton();
	}
	function news_Action()
	{
	}

	function isSecure()
	{
		return false;
	}

	/**
	 * _getPageAction
	 *
	 * @param	void
	 *
	 * @return	string
	 **/
	protected function _getPageAction()
	{
		return null;
	}

	/**
	 * _getPageTitle
	 *
	 * @param	void
	 *
	 * @return	string
	 **/
	protected function _getPagetitle()
	{
		return null;
	}

	public function getPageTitle()
	{
		return Legacy_Utils::formatPagetitle(XCube_Root::getSingleton()->mContext->mModule->mXoopsModule->get('name'), $this->_getPagetitle(), $this->_getPageAction());
	}

	function hasPermission(&$controller, &$xoopsUser, $moduleConfig)
	{
		return true;
	}

	function prepare(&$controller, &$xoopsUser, &$moduleConfig)
	{
	}

	function getDefaultView(&$controller, &$xoopsUser)
	{
		return NEWS_FRAME_VIEW_NONE;
	}

	function execute(&$controller, &$xoopsUser)
	{
		return NEWS_FRAME_VIEW_NONE;
	}

	function executeViewSuccess(&$controller,&$render)
	{
	}

	function executeViewError(&$render)
	{
	}

	function executeViewInde(&$render)
	{
	}

	function executeViewInput(&$render)
	{
	}

	function executeViewPreview(&$render)
	{
	}

	function executeViewCancel(&$render)
	{
	}
}

?>
