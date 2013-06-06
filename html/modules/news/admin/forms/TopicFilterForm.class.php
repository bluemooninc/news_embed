<?php
/**
 * @package news
 * @version $Id: TopicFilterForm.class.php,v 1.1 2007/05/15 02:34:39 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractFilterForm.class.php";

define('ITEM_SORT_KEY_TOPIC_ID'  , 1);
define('ITEM_SORT_KEY_TOPIC_PID' , 2);
define('ITEM_SORT_KEY_NAME'      , 3);
define('ITEM_SORT_KEY_DEFAULT'   , ITEM_SORT_KEY_TOPIC_ID);

class news_TopicFilterForm extends news_AbstractFilterForm
{
	var $mSortKeys = array(
		ITEM_SORT_KEY_DEFAULT  => 'topic_id',
		ITEM_SORT_KEY_TOPIC_ID => 'topic_id',
		ITEM_SORT_KEY_TOPIC_PID => 'topic_pid',
		ITEM_SORT_KEY_NAME     => 'topic_title',
	);
	var $mKeyword = "";

	function getDefaultSortKey()
	{
		return ITEM_SORT_KEY_DEFAULT;
	}
	
	function fetch()
	{
		parent::fetch();

		$root =& XCube_Root::getSingleton();
		$search = $root->mContext->mRequest->getRequest('search');

		if (isset($_REQUEST['topic_id'])) {
			$this->mNavi->addExtra('topic_id', xoops_getrequest('topic_id'));
			$this->_mCriteria->add(new Criteria('topic_id', xoops_getrequest('topic_id')));
		}

		if (!empty($search)) {
			$this->mKeyword = $search;
			$this->mNavi->addExtra('search', $this->mKeyword);
			$this->_mCriteria->add(new Criteria('title', '%' . $this->mKeyword . '%', 'LIKE'));
		}

		$this->_mCriteria->addSort($this->getSort(), $this->getOrder());
	}
}

?>
