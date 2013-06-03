<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/03
 * Time: 15:14
 * To change this template use File | Settings | File Templates.
 */

class news_stories_filesObject extends XoopsSimpleObject
{
	public function __construct()
	{
		$this->initVar('fileid', XOBJ_DTYPE_INT, 0);
		$this->initVar('filerealname', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('storyid', XOBJ_DTYPE_INT, 0);
		$this->initVar('date', XOBJ_DTYPE_INT, 0);
		$this->initVar('mimetype', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('downloadname', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('counter', XOBJ_DTYPE_INT, 0);
	}
}

class news_stories_filesHandler extends XoopsObjectGenericHandler
{
	public $mTable = 'stories_files';
	public $mPrimary = 'fileid';
	public $mClass = 'news_stories_filesObject';

	public function __construct(&$db)
	{
		parent::XoopsObjectGenericHandler($db);
	}
}
