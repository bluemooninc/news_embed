<?php
/**
 * @package news
 * @version $Id: StoryEditAction.class.php,v 1.1 2007/05/15 02:34:41 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractEditAction.class.php";
require_once XOOPS_MODULE_PATH . "/news/admin/forms/StoryAdminEditForm.class.php";

class news_StoryEditAction extends news_AbstractEditAction
{
	function _getId()
	{
		return xoops_getrequest('storyid');
	}
	
	function &_getHandler()
	{
		$this->mObjectHandler =& xoops_getmodulehandler('stories');
		return $this->mObjectHandler;
	}

	function _setupActionForm()
	{
		$this->_getHandler();
		$this->mActionForm =new news_StoryAdminEditForm();
		$this->mActionForm->prepare();
	}

	function executeViewInput(&$controller, &$render)
	{
		$render->setTemplateName("story_edit.html");
		$render->setAttribute("actionForm", $this->mActionForm);
		$topicsHandler = xoops_getmodulehandler('topics');
		$render->setAttribute("topicOptions", $topicsHandler->getTopicsOptions());
		$this->_setDatepicker();
	}

	function executeViewSuccess(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=StoryList");
	}

	function executeViewError(&$controller, &$render)
	{
		$controller->executeRedirect("index.php?action=StoryList", 5, _MD_NEWS_ERROR_DBUPDATE_FAILED);
	}

	function executeViewCancel(&$controller, &$render)
	{
		$controller->executeForward("index.php?action=StoryList");
	}
	protected function _setDatepicker()
	{
		$headerScript = XCube_Root::getSingleton()->mContext->getAttribute('headerScript');
		$headerScript->addScript(
			'$(".datepicker").each(function(){
			$(this).datepicker({
				dateFormat:"yy-mm-dd",
			});
		});'
		);
		$headerScript->addScript('
        $.datepicker.regional["ja"] = {
            closeText: "閉じる",
	        prevText: "&#x3c;前",
            nextText: "次&#x3e;",
            currentText: "今日",
            monthNames: ["1月","2月","3月","4月","5月","6月",
            "7月","8月","9月","10月","11月","12月"],
            monthNamesShort: ["1月","2月","3月","4月","5月","6月",
            "7月","8月","9月","10月","11月","12月"],
            dayNames: ["日曜日","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日"],
            dayNamesShort: ["日","月","火","水","木","金","土"],
            dayNamesMin: ["日","月","火","水","木","金","土"],
            dateFormat: "yy/mm/dd", firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true
        };
        $.datepicker.setDefaults($.datepicker.regional["ja"]);
		');
	}
}
