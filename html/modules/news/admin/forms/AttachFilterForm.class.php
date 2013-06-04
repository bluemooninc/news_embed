<?php
/**
 * @package news
 * @version $Id: AttachFilterForm.class.php,v 1.1 2007/05/15 02:34:39 minahito Exp $
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

require_once XOOPS_MODULE_PATH . "/news/class/AbstractFilterForm.class.php";

define('IMAGE_SORT_KEY_IMAGE_ID'      , 1);
define('IMAGE_SORT_KEY_ITEM_ID'       , 2);
define('IMAGE_SORT_KEY_IMAGE_FILENAME', 3);

define('IMAGE_SORT_KEY_DEFAULT', IMAGE_SORT_KEY_IMAGE_ID);

class news_AttachFilterForm extends news_AbstractFilterForm
{
	var $mSortKeys = array(
		IMAGE_SORT_KEY_DEFAULT        => 'storyid',
		IMAGE_SORT_KEY_IMAGE_ID       => 'storyid',
		IMAGE_SORT_KEY_ITEM_ID        => 'storyid',
		IMAGE_SORT_KEY_IMAGE_FILENAME => 'filerealname'
	);

	function getDefaultSortKey()
	{
		return IMAGE_SORT_KEY_DEFAULT;
	}
	
	function fetch()
	{
		parent::fetch();
	
		if (isset($_REQUEST['storyid'])) {
			$this->mNavi->addExtra('storyid', xoops_getrequest('storyid'));
			$this->_mCriteria->add(new Criteria('storyid', xoops_getrequest('storyid')));
		}

		if (isset($_REQUEST['storyid'])) {
			$this->mNavi->addExtra('storyid', xoops_getrequest('storyid'));
			$this->_mCriteria->add(new Criteria('storyid', xoops_getrequest('storyid')));
		}
	
		if (isset($_REQUEST['filerealname'])) {
			$this->mNavi->addExtra('filerealname', xoops_getrequest('filerealname'));
			$this->_mCriteria->add(new Criteria('filerealname', xoops_getrequest('filerealname')));
		}

		if (isset($_REQUEST['youtube_id'])) {
			$this->mNavi->addExtra('youtube_id', xoops_getrequest('youtube_id'));
			$this->_mCriteria->add(new Criteria('youtube_id', xoops_getrequest('youtube_id')));
		}

		$this->_mCriteria->addSort($this->getSort(), $this->getOrder());
	}
}

?>
