<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluemooninc
 * Date: 2013/06/03
 * Time: 15:14
 * To change this template use File | Settings | File Templates.
 */

class news_topicsObject extends XoopsSimpleObject
{
	public function __construct()
	{
		$this->initVar('topic_id', XOBJ_DTYPE_INT, 0);
		$this->initVar('topic_pid', XOBJ_DTYPE_INT, 0);
		$this->initVar('topic_imgurl', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('topic_title', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('menu', XOBJ_DTYPE_INT, 0);
		$this->initVar('topic_frontpage', XOBJ_DTYPE_INT, 0);
		$this->initVar('topic_rssurl', XOBJ_DTYPE_STRING, '', true, 255);
		$this->initVar('topic_description', XOBJ_DTYPE_TEXT, '', true);
		$this->initVar('topic_color', XOBJ_DTYPE_STRING, '000000', true, 6);
	}
}

class news_topicsHandler extends XoopsObjectGenericHandler
{
	public $mTable = 'news_topics';
	public $mPrimary = 'topic_id';
	public $mClass = 'news_topicsObject';

	public function __construct(&$db)
	{
		parent::XoopsObjectGenericHandler($db);
	}
	public function &getTopics(){
		$sql = "select * from " . $this->mTable . " ORDER BY topic_title";
		$result = $this->db->query($sql);
		$ret = array();
		while( $myrow = $this->db->fetchArray($result) ){
			$ret[] = $myrow;
		}
		return $ret;
	}
	public function &getTopicsOptions(){
		$objects = $this->getTopics();
		$ret = array(0=>null);
		foreach($objects as $obj){
			$ret[$obj['topic_id']] = $obj['topic_title'];
		}
		return $ret;
	}

}
