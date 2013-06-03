<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/03
 * Time: 15:14
 * To change this template use File | Settings | File Templates.
 */

class news_storiesObject extends XoopsSimpleObject
{
	public function __construct()
	{
		$this->initVar('storyid', XOBJ_DTYPE_INT, 0);
		$this->initVar('uid', XOBJ_DTYPE_INT, 0);
		$this->initVar('title', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('created', XOBJ_DTYPE_INT, 0);
		$this->initVar('published', XOBJ_DTYPE_INT, 0);
		$this->initVar('expired', XOBJ_DTYPE_INT, 0);
		$this->initVar('hostname', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('nohtml', XOBJ_DTYPE_INT, 0);
		$this->initVar('nosmiley', XOBJ_DTYPE_INT, 0);
		$this->initVar('hometext', XOBJ_DTYPE_TEXT, '', true);
		$this->initVar('bodytext', XOBJ_DTYPE_TEXT, '', true);
		$this->initVar('keywords', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('description', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('counter', XOBJ_DTYPE_INT, 0);
		$this->initVar('topicid', XOBJ_DTYPE_INT, 0);
		$this->initVar('ihome', XOBJ_DTYPE_INT, 0);
		$this->initVar('notifypub', XOBJ_DTYPE_INT, 0);
		$this->initVar('story_type', XOBJ_DTYPE_STRING, '', true, 5);
		$this->initVar('topicdisplay', XOBJ_DTYPE_INT, 0);
		$this->initVar('topicalign', XOBJ_DTYPE_STRING, 'R', true, 1);
		$this->initVar('comments', XOBJ_DTYPE_INT, 0);
		$this->initVar('rating', XOBJ_DTYPE_FLOAT, 0.0000);
		$this->initVar('votes', XOBJ_DTYPE_INT, 0);
	}
}

class news_storiesHandler extends XoopsObjectGenericHandler
{
	public $mTable = 'stories';
	public $mPrimary = 'storyid';
	public $mClass = 'news_storiesObject';

	public function __construct(&$db)
	{
		parent::XoopsObjectGenericHandler($db);
	}
}
