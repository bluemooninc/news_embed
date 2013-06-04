<?php
/**
 * @package news
 * @version $Id: StoryFilterForm.class.php,v 1.1 2007/05/15 02:34:39 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractFilterForm.class.php";

define('ITEM_SORT_KEY_STORY'   , 1);
define('ITEM_SORT_KEY_UPDATE'  , 2);
define('ITEM_SORT_KEY_TOPIC'   , 3);
define('ITEM_SORT_KEY_NAME'    , 4);
define('ITEM_SORT_KEY_DEFAULT' , ITEM_SORT_KEY_STORY);

class news_StoryFilterForm extends news_AbstractFilterForm
{
	var $mSortKeys = array(
		ITEM_SORT_KEY_DEFAULT  => 'storyid',
		ITEM_SORT_KEY_STORY    => 'storyid',
		ITEM_SORT_KEY_UPDATE   => 'created',
		ITEM_SORT_KEY_TOPIC    => 'topic_id',
		ITEM_SORT_KEY_NAME     => 'title',
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

		if (isset($_REQUEST['story_id'])) {
			$this->mNavi->addExtra('story_id', xoops_getrequest('story_id'));
			$this->_mCriteria->add(new Criteria('story_id', xoops_getrequest('story_id')));
		}

		if (isset($_REQUEST['topic_id'])) {
			$this->mNavi->addExtra('topic_id', xoops_getrequest('topic_id'));
			$this->_mCriteria->add(new Criteria('topic_id', xoops_getrequest('topic_id')));
		}
	
		if (isset($_REQUEST['story_name'])) {
			$this->mNavi->addExtra('story_name', xoops_getrequest('story_name'));
			$this->_mCriteria->add(new Criteria('story_name', xoops_getrequest('story_name')));
		}
	
		if (isset($_REQUEST['status'])) {
			$this->mNavi->addExtra('status', xoops_getrequest('status'));
			$this->_mCriteria->add(new Criteria('group_type', xoops_getrequest('group_type')));
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
