<?php
// $Id: news_topicsnav.php,v 1.5 2004/09/01 17:48:07 hthouzard Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

function b_news_topicsnav_show($options) {
    include_once XOOPS_ROOT_PATH.'/modules/news/include/functions.php';
    include_once XOOPS_ROOT_PATH."/modules/news/class/class.newstopic.php";
   	$myts =& MyTextSanitizer::getInstance();
	$block = array();
	$newscountbytopic=array();
	$perms='';
	$xt = new NewsTopic();
	$restricted=getmoduleoption('restrictindex');
    if ($restricted) {
        global $xoopsUser;
        $module_handler =& xoops_gethandler('module');
        $newsModule =& $module_handler->getByDirname('news');
        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gperm_handler =& xoops_gethandler('groupperm');
        $topics = $gperm_handler->getItemIds('news_view', $groups, $newsModule->getVar('mid'));
        if(count($topics)>0) {
        	$topics = implode(',', $topics);
        	$perms = " AND topic_id IN (".$topics.") ";
        } else {
        	return '';
        }
    }
	$topics_arr = $xt->getChildTreeArray(0,"topic_title", $perms);
	if($options[0]==1) {
		$newscountbytopic=$xt->getNewsCountByTopic();
	}
	if(is_array($topics_arr) && count($topics_arr))	{
		foreach ($topics_arr as $onetopic) {
			if($options[0]==1) {
				$count=0;
				if(array_key_exists($onetopic['topic_id'],$newscountbytopic)) {
					$count = $newscountbytopic[$onetopic['topic_id']];
				}
			} else {
				$count='';
			}
		    $block['news_topics'][] = array('id'=>$onetopic['topic_id'], 'news_count'=>$count, 'topic_color'=>'#'.$onetopic['topic_color'], 'title'=>$myts->displayTarea($onetopic['topic_title']));
		}
	}
	return $block;
}

function b_news_topicsnav_edit($options) {
    $form = _MB_NEWS_SHOW_NEWS_COUNT." <input type='radio' name='options[]' value='1'";
    if ($options[0] == 1) {
        $form .= " checked='checked'";
    }
    $form .= " />"._YES;
    $form .= "<input type='radio' name='options[]' value='0'";
    if ($options[0] == 0) {
        $form .= " checked='checked'";
    }
    $form .= " />"._NO;
	return $form;
}