<?php
// $Id: xoops_version.php,v 1.47 2009/02/21 16:12:07 yoshis Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
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

$modversion['name'] = _MI_NEWS_NAME;
$modversion['version'] = 2.00;
$modversion['description'] = _MI_NEWS_DESC;
$modversion['credits'] = "Hacked by Yoshis / Based by The XOOPS Project, Christian, Pilou, Marco, ALL the members of the Newbb Team, GIJOE, Zoullou, Mithrandir, Setec Astronomy, Marcan, 5vision, Anne";
$modversion['author'] = "Yoshis at Bluemoon inc.";
$modversion['help'] = "news.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/news_slogo.png";
$modversion['dirname'] = "news";

$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][] = "{prefix}_{dirname}_stories";
$modversion['tables'][] = "{prefix}_{dirname}_topics";
$modversion['tables'][] = "{prefix}_{dirname}_stories_files";
$modversion['tables'][] = "{prefix}_{dirname}_stories_votedata";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Templates
$modversion['templates'][1] = array('file' => 'news_item.html','description' => '');
$modversion['templates'][2] = array('file' => 'news_archive.html','description' => '');
$modversion['templates'][3] = array('file' => 'news_article.html','description' => '');
$modversion['templates'][4] = array('file' => 'news_index.html','description' => '');
$modversion['templates'][5] = array('file' => 'news_by_topic.html','description' => '');
$modversion['templates'][6] = array('file' => 'news_by_this_author.html','description' => 'Shows a page resuming all the articles of the same author (according to the perms)');
$modversion['templates'][7] = array('file' => 'news_ratenews.html','description' => 'Template used to rate a news');
$modversion['templates'][8] = array('file' => 'news_rss.html', 'description' => 'Used for RSS per topics');
$modversion['templates'][9] = array('file' => 'news_submit.html' , 'description' => 'Submit news');
$modversion['templates'][10] = array('file' => 'delete_attached.html','description' => 'Delete attaced file');

// Blocks
$modversion['blocks'][1]['file'] = "news_topics.php";
$modversion['blocks'][1]['name'] = _MI_NEWS_BNAME1;
$modversion['blocks'][1]['description'] = "Shows news topics";
$modversion['blocks'][1]['show_func'] = "b_news_topics_show";
$modversion['blocks'][1]['template'] = 'news_block_topics.html';

$modversion['blocks'][2]['file'] = "news_bigstory.php";
$modversion['blocks'][2]['name'] = _MI_NEWS_BNAME3;
$modversion['blocks'][2]['description'] = "Shows most read story of the day";
$modversion['blocks'][2]['show_func'] = "b_news_bigstory_show";
$modversion['blocks'][2]['template'] = 'news_block_bigstory.html';

$modversion['blocks'][3]['file'] = "news_top.php";
$modversion['blocks'][3]['name'] = _MI_NEWS_BNAME4;
$modversion['blocks'][3]['description'] = "Shows top read news articles";
$modversion['blocks'][3]['show_func'] = "b_news_top_show";
$modversion['blocks'][3]['edit_func'] = "b_news_top_edit";
$modversion['blocks'][3]['options'] = "counter|11|60|0|1|0|0||1||||||";
$modversion['blocks'][3]['template'] = 'news_block_top.html';

$modversion['blocks'][4]['file'] = "news_top.php";
$modversion['blocks'][4]['name'] = _MI_NEWS_BNAME5;
$modversion['blocks'][4]['description'] = "Shows recent articles";
$modversion['blocks'][4]['show_func'] = "b_news_top_show";
$modversion['blocks'][4]['edit_func'] = "b_news_top_edit";
$modversion['blocks'][4]['options'] = "published|11|60|0|1|0|0||1||||||";
$modversion['blocks'][4]['template'] = 'news_block_top.html';

$modversion['blocks'][5]['file'] = "news_moderate.php";
$modversion['blocks'][5]['name'] = _MI_NEWS_BNAME6;
$modversion['blocks'][5]['description'] = "Shows a block to moderate articles";
$modversion['blocks'][5]['show_func'] = "b_news_topics_moderate";
$modversion['blocks'][5]['template'] = 'news_block_moderate.html';

$modversion['blocks'][6]['file'] = "news_topicsnav.php";
$modversion['blocks'][6]['name'] = _MI_NEWS_BNAME7;
$modversion['blocks'][6]['description'] = "Shows a block to navigate topics";
$modversion['blocks'][6]['show_func'] = "b_news_topicsnav_show";
$modversion['blocks'][6]['template'] = 'news_block_topicnav.html';
$modversion['blocks'][6]['options'] = "0";
$modversion['blocks'][6]['edit_func'] = "b_news_topicsnav_edit";

$modversion['blocks'][7]['file'] = "news_randomnews.php";
$modversion['blocks'][7]['name'] = _MI_NEWS_BNAME8;
$modversion['blocks'][7]['description'] = "Shows a block where news appears randomly";
$modversion['blocks'][7]['show_func'] = "b_news_randomnews_show";
$modversion['blocks'][7]['template'] = 'news_block_randomnews.html';
$modversion['blocks'][7]['options'] = "published|10|25|0|0";
$modversion['blocks'][7]['edit_func'] = "b_news_randomnews_edit";

// Menu
$modversion['hasMain'] = 1;

$cansubmit = 0;

/**
* This part inserts the selected topics as sub items in the Xoops main menu
*/
$module_handler =& xoops_gethandler('module');
$module =& $module_handler->getByDirname($modversion['dirname']);
if ($module) {
    global $xoopsUser;
    if (is_object($xoopsUser)) {
        $groups = $xoopsUser->getGroups();
    } else {
        $groups = XOOPS_GROUP_ANONYMOUS;
    }
    $gperm_handler =& xoops_gethandler('groupperm');
    if ($gperm_handler->checkRight("news_submit", 0, $groups, $module->getVar('mid'))) {
          $cansubmit = 1;
    }
}

// ************
$i = 1;
global $xoopsDB, $xoopsUser, $xoopsConfig, $xoopsModule, $xoopsModuleConfig;
// We try to "win" some time
// 1)  Check to see it the module is the current module
if (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $modversion['dirname'] && $xoopsModule->getVar('isactive'))
{
	// 2) If there's no topics to display as sub menus we can go on
	$sql = "SELECT COUNT(*) as cpt FROM ".$xoopsDB->prefix("news_topics")." WHERE menu=1";
	$result = $xoopsDB->query($sql);
	list($count) = $xoopsDB->fetchRow($result);
	if($count>0) {
		include_once XOOPS_ROOT_PATH."/class/tree.php";
		include_once XOOPS_ROOT_PATH."/modules/news/class/class.newstopic.php";
		include_once XOOPS_ROOT_PATH."/modules/news/include/functions.php";
		$xt = new NewsTopic();
		$allTopics = $xt->getAllTopics(getmoduleoption('restrictindex'));
		$topic_tree = new XoopsObjectTree($allTopics, 'topic_id', 'topic_pid');
		$topics_arr = $topic_tree->getAllChild(0);
		if ($module) {
			foreach ($topics_arr as $onetopic) {
				if ($gperm_handler->checkRight('news_view', $onetopic->topic_id(), $groups, $xoopsModule->getVar('mid')) && $onetopic->menu()) {
	            	$modversion['sub'][$i]['name'] = $onetopic->topic_title();
  					$modversion['sub'][$i]['url'] = "app/index.php?topicid=" . $onetopic->topic_id();
   				}
       			$i++;
   			}
		}
		unset($xt);
	}
}

$modversion['sub'][$i]['name'] = _MI_NEWS_SMNAME2;
$modversion['sub'][$i]['url'] = "app/archive.php";
if ($cansubmit) {
	$i++;
    $modversion['sub'][$i]['name'] = _MI_NEWS_SMNAME1;
    $modversion['sub'][$i]['url'] = "app/submit.php";
}
unset($cansubmit);

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "news_search";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['pageName'] = 'article.php';
$modversion['comments']['itemName'] = 'storyid';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'news_com_approve';
$modversion['comments']['callback']['update'] = 'news_com_update';

/**
* Select the number of news items to display on top page
*/
$modversion['config'][1]['name'] = 'storyhome';
$modversion['config'][1]['title'] = '_MI_STORYHOME';
$modversion['config'][1]['description'] = '_MI_STORYHOMEDSC';
$modversion['config'][1]['formtype'] = 'select';
$modversion['config'][1]['valuetype'] = 'int';
$modversion['config'][1]['default'] = 5;
$modversion['config'][1]['options'] = array('5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30);

/**
* Format of the date to use in the module, if you don't specify anything then the default date's format will be used
*/
$modversion['config'][2]['name'] = 'dateformat';
$modversion['config'][2]['title'] = '_MI_NEWS_DATEFORMAT';
$modversion['config'][2]['description'] = '_MI_NEWS_DATEFORMAT_DESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = "";

/**
* Display a navigation's box on the pages ?
* This navigation's box enable you to jump from one topic to another
*/
$modversion['config'][3]['name'] = 'displaynav';
$modversion['config'][3]['title'] = '_MI_DISPLAYNAV';
$modversion['config'][3]['description'] = '_MI_DISPLAYNAVDSC';
$modversion['config'][3]['formtype'] = 'yesno';
$modversion['config'][3]['valuetype'] = 'int';
$modversion['config'][3]['default'] = 1;

/*
$modversion['config'][4]['name'] = 'anonpost';
$modversion['config'][4]['title'] = '_MI_ANONPOST';
$modversion['config'][4]['description'] = '';
$modversion['config'][4]['formtype'] = 'yesno';
$modversion['config'][4]['valuetype'] = 'int';
$modversion['config'][4]['default'] = 0;
*/

/**
* Auto approuve submited stories
*/
$modversion['config'][5]['name'] = 'autoapprove';
$modversion['config'][5]['title'] = '_MI_AUTOAPPROVE';
$modversion['config'][5]['description'] = '_MI_AUTOAPPROVEDSC';
$modversion['config'][5]['formtype'] = 'yesno';
$modversion['config'][5]['valuetype'] = 'int';
$modversion['config'][5]['default'] = 0;

/**
* Dispay layout, classic or by topics
*/
$modversion['config'][6]['name'] = 'newsdisplay';
$modversion['config'][6]['title'] = '_MI_NEWSDISPLAY';
$modversion['config'][6]['description'] = '_MI_NEWSDISPLAYDESC';
$modversion['config'][6]['formtype'] = 'select';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = "Classic";
$modversion['config'][6]['options'] = array('_MI_NEWSCLASSIC' => 'Classic','_MI_NEWSBYTOPIC' => 'Bytopic');

/**
* How to display Author's name, username, full name or nothing ?
*/
$modversion['config'][7]['name'] = 'displayname';
$modversion['config'][7]['title'] = '_MI_NAMEDISPLAY';
$modversion['config'][7]['description'] = '_MI_ADISPLAYNAMEDSC';
$modversion['config'][7]['formtype'] = 'select';
$modversion['config'][7]['valuetype'] = 'int';
$modversion['config'][7]['default'] = 1;
$modversion['config'][7]['options']	= array('_MI_DISPLAYNAME1' => 1, '_MI_DISPLAYNAME2' => 2, '_MI_DISPLAYNAME3' => 3);

/**
* Number of columns to use to display news
*/
$modversion['config'][8]['name'] = 'columnmode';
$modversion['config'][8]['title'] = '_MI_COLUMNMODE';
$modversion['config'][8]['description'] = '_MI_COLUMNMODE_DESC';
$modversion['config'][8]['formtype'] = 'select';
$modversion['config'][8]['valuetype'] = 'int';
$modversion['config'][8]['default'] = 1;
$modversion['config'][8]['options'] = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);

/**
* Number of news and topics to display in the module's admin part
*/
$modversion['config'][9]['name'] = 'storycountadmin';
$modversion['config'][9]['title'] = '_MI_STORYCOUNTADMIN';
$modversion['config'][9]['description'] = '_MI_STORYCOUNTADMIN_DESC';
$modversion['config'][9]['formtype'] = 'select';
$modversion['config'][9]['valuetype'] = 'int';
$modversion['config'][9]['default'] = 10;
$modversion['config'][9]['options'] = array('5' => 5, '10' => 10, '15' => 15, '20' => 20, '25' => 25, '30' => 30, '35' => 35, '40' => 40);



/**
* Restrict Topics on Index Page
*
* This is one of the mot important option in the module.
* If you set it to No, then the users can see the introduction's text of each
* story even if they don't have the right to see the topic attached to the news.
* If you set it to Yes then you can only see what you have the right to see.
* Many of the permissions are based on this option.
*/
$modversion['config'][12]['name'] = 'restrictindex';
$modversion['config'][12]['title'] = '_MI_RESTRICTINDEX';
$modversion['config'][12]['description'] = '_MI_RESTRICTINDEXDSC';
$modversion['config'][12]['formtype'] = 'yesno';
$modversion['config'][12]['valuetype'] = 'int';
$modversion['config'][12]['default'] = 0;

/**
* Do you want to enable your visitors to see all the other articles
* created by the author they are currently reading ?
*/
$modversion['config'][13]['name'] = 'newsbythisauthor';
$modversion['config'][13]['title'] = '_MI_NEWSBYTHISAUTHOR';
$modversion['config'][13]['description'] = '_MI_NEWSBYTHISAUTHORDSC';
$modversion['config'][13]['formtype'] = 'yesno';
$modversion['config'][13]['valuetype'] = 'int';
$modversion['config'][13]['default'] = 0;

/**
* If you set this option to yes then you will see two links at the bottom
* of each article. The first link will enable you to go to the previous
* article and the other link will bring you to the next article
*/
$modversion['config'][14]['name'] = 'showprevnextlink';
$modversion['config'][14]['title'] = '_MI_NEWS_PREVNEX_LINK';
$modversion['config'][14]['description'] = '_MI_NEWS_PREVNEX_LINK_DESC';
$modversion['config'][14]['formtype'] = 'yesno';
$modversion['config'][14]['valuetype'] = 'int';
$modversion['config'][14]['default'] = 0;

/**
* Do you want to see a summary table at the bottom of each article ?
*/
$modversion['config'][15]['name'] = 'showsummarytable';
$modversion['config'][15]['title'] = '_MI_NEWS_SUMMARY_SHOW';
$modversion['config'][15]['description'] = '_MI_NEWS_SUMMARY_SHOW_DESC';
$modversion['config'][15]['formtype'] = 'yesno';
$modversion['config'][15]['valuetype'] = 'int';
$modversion['config'][15]['default'] = 0;

/**
* Do you enable author's to edit their posts ?
*/
$modversion['config'][16]['name'] = 'authoredit';
$modversion['config'][16]['title'] = '_MI_NEWS_AUTHOR_EDIT';
$modversion['config'][16]['description'] = '_MI_NEWS_AUTHOR_EDIT_DESC';
$modversion['config'][16]['formtype'] = 'yesno';
$modversion['config'][16]['valuetype'] = 'int';
$modversion['config'][16]['default'] = 1;

/**
* Do you want to enable your visitors to rate news ?
*/
$modversion['config'][17]['name'] = 'ratenews';
$modversion['config'][17]['title'] = "_MI_NEWS_RATE_NEWS";
$modversion['config'][17]['description'] = "";
$modversion['config'][17]['formtype'] = 'yesno';
$modversion['config'][17]['valuetype'] = 'int';
$modversion['config'][17]['default'] = 0;

/**
* You can set RSS feeds per topic
*/
$modversion['config'][18]['name'] = 'topicsrss';
$modversion['config'][18]['title'] = "_MI_NEWS_TOPICS_RSS";
$modversion['config'][18]['description'] = "_MI_NEWS_TOPICS_RSS_DESC";
$modversion['config'][18]['formtype'] = 'yesno';
$modversion['config'][18]['valuetype'] = 'int';
$modversion['config'][18]['default'] = 0;

/**
* If you set this option to yes then the approvers can type the keyword
* and description's meta datas
*/
$modversion['config'][19]['name'] = 'metadata';
$modversion['config'][19]['title'] = "_MI_NEWS_META_DATA";
$modversion['config'][19]['description'] = "_MI_NEWS_META_DATA_DESC";
$modversion['config'][19]['formtype'] = 'yesno';
$modversion['config'][19]['valuetype'] = 'int';
$modversion['config'][19]['default'] = 0;

/**
* Editor to use
*/
$modversion['config'][20]['name'] = 'form_options';
$modversion['config'][20]['title'] = "_MI_NEWS_FORM_OPTIONS";
$modversion['config'][20]['description'] = '_MI_NEWS_FORM_OPTIONS_DESC';
$modversion['config'][20]['formtype'] = 'select';
$modversion['config'][20]['valuetype'] = 'text';
$modversion['config'][20]['options'] = array(
											_MI_NEWS_FORM_DHTML=>'dhtml',
											_MI_NEWS_FORM_COMPACT=>'textarea',
											_MI_NEWS_FORM_SPAW=>'spaw',
											_MI_NEWS_FORM_HTMLAREA=>'htmlarea',
											_MI_NEWS_FORM_KOIVI=>'koivi',
											_MI_NEWS_FORM_FCK=>'fck'
											);
$modversion['config'][20]['default'] = 'dhtml';

/**
* If you set this option to Yes then the keywords entered in the
* search will be highlighted in the articles.
*/
$modversion['config'][21]['name'] = 'keywordshighlight';
$modversion['config'][21]['title'] = "_MI_NEWS_KEYWORDS_HIGH";
$modversion['config'][21]['description'] = "_MI_NEWS_KEYWORDS_HIGH_DESC";
$modversion['config'][21]['formtype'] = 'yesno';
$modversion['config'][21]['valuetype'] = 'int';
$modversion['config'][21]['default'] = 0;

/**
* If you have enabled the previous option then with this one
* you can select the color to use to highlight words
*/
$modversion['config'][22]['name'] = 'highlightcolor';
$modversion['config'][22]['title'] = '_MI_NEWS_HIGH_COLOR';
$modversion['config'][22]['description'] = '_MI_NEWS_HIGH_COLOR_DES';
$modversion['config'][22]['formtype'] = 'textbox';
$modversion['config'][22]['valuetype'] = 'text';
$modversion['config'][22]['default'] = "#FFFF80";

/**
* Tooltips, or infotips are some small textes you can see when you
* move your mouse over an article's title. This text contains the
* first (x) characters of the story
*/
$modversion['config'][23]['name'] = 'infotips';
$modversion['config'][23]['title'] = '_MI_NEWS_INFOTIPS';
$modversion['config'][23]['description'] = '_MI_NEWS_INFOTIPS_DES';
$modversion['config'][23]['formtype'] = 'textbox';
$modversion['config'][23]['valuetype'] = 'int';
$modversion['config'][23]['default'] = 0;

/**
* This option is specific to Mozilla/Firefox and Opera
* Both of them can display a toolbar wich contains buttons to
* go from article to article. It can show other information too
*/
$modversion['config'][24]['name'] = 'sitenavbar';
$modversion['config'][24]['title'] = "_MI_NEWS_SITE_NAVBAR";
$modversion['config'][24]['description'] = "_MI_NEWS_SITE_NAVBAR_DESC";
$modversion['config'][24]['formtype'] = 'yesno';
$modversion['config'][24]['valuetype'] = 'int';
$modversion['config'][24]['default'] = 0;

/**
* With this option you can select the skin (apparence) to use for the blocks containing tabs
*/
$modversion['config'][] = array(
	'name' 			=> 'tabskin',
	'title' 		=> "_MI_NEWS_TABS_SKIN",
	'description' 	=> "_MI_NEWS_TABS_SKIN_DESC",
	'formtype' 		=> 'select',
	'valuetype' 	=> 'int',
	'options' 		=> array(_MI_NEWS_SKIN_1=>1,_MI_NEWS_SKIN_2=>2,_MI_NEWS_SKIN_3=>3,_MI_NEWS_SKIN_4=>4,
					_MI_NEWS_SKIN_5=>5,_MI_NEWS_SKIN_6=>6,_MI_NEWS_SKIN_7=>7,_MI_NEWS_SKIN_8=>8),
	'default' 		=> 6
);
/**
* Authorized groups to upload
*/
$modversion['config'][] = array(
	'name' => 'uploadgroups',
	'title' => '_MI_UPLOADGROUPS',
	'description' => '_MI_UPLOADGROUPS_DESC',
	'formtype' => 'select',
	'valuetype' => 'int',
	'default' => 2,
	'options' => array('_MI_UPLOAD_GROUP1' => 1, '_MI_UPLOAD_GROUP2' => 2, '_MI_UPLOAD_GROUP3' => 3)
);
/**
* MAX Filesize Upload in kilo bytes
*/
$modversion['config'][] = array(
	'name' => 'maxuploadsize',
	'title' => '_MI_UPLOADFILESIZE',
	'description' => '_MI_UPLOADFILESIZE_DESC',
	'formtype' => 'textbox',
	'valuetype' => 'int',
	'default' => 2000000
);
// Notification
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'news_notify_iteminfo';

$modversion['notification']['category'][] = array(
	'name'=> 'global',
	'title'=> _MI_NEWS_GLOBAL_NOTIFY,
	'description'=> _MI_NEWS_GLOBAL_NOTIFYDSC,
	'subscribe_from'=> array('index.php', 'article.php')
);
// After Ver1.50: for topic event 
$modversion['notification']['category'][] = array(
	'name'=> 'topic',
	'title'=> _MI_NEWS_TOPIC_NOTIFY,
	'description'=> _MI_NEWS_TOPIC_NOTIFYDSC,
	'subscribe_from'=> array('index.php', 'article.php'),
	'item_name'=> 'storytopic',
);
// For story event
$modversion['notification']['category'][] = array(
	'name' => 'story',
	'title'=> _MI_NEWS_STORY_NOTIFY,
	'description'=> _MI_NEWS_STORY_NOTIFYDSC,
	'subscribe_from'=> array('article.php'),
	'item_name'=> 'storyid',
	'allow_bookmark'=> 1
);

$modversion['notification']['event'][] = array(
	'name' => 'new_category',
	'category' => 'global',
	'title' => _MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFY,
	'caption' => _MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYCAP,
	'description' => _MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYDSC,
	'mail_template' => 'global_newcategory_notify',
	'mail_subject' => _MI_NEWS_GLOBAL_NEWCATEGORY_NOTIFYSBJ
);
$modversion['notification']['event'][] = array(
	'name' => 'story_submit',
	'category' => 'global',
	'admin_only' => 1,
	'title' => _MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFY,
	'caption' => _MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYCAP,
	'description' => _MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYDSC,
	'mail_template' => 'global_storysubmit_notify',
	'mail_subject' => _MI_NEWS_GLOBAL_STORYSUBMIT_NOTIFYSBJ
);
$modversion['notification']['event'][] = array(
	'name' => 'new_story',
	'category' => 'global',
	'title' => _MI_NEWS_GLOBAL_NEWSTORY_NOTIFY,
	'caption' => _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP,
	'description' => _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC,
	'mail_template' => 'global_newstory_notify',
	'mail_subject' => _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ
);
$modversion['notification']['event'][] = array(
	'name'=> 'new_story',
	'category'=> 'topic',
	'title'=> _MI_NEWS_GLOBAL_NEWSTORY_NOTIFY,
	'caption'=> _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYCAP,
	'description'=> _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYDSC,
	'mail_template'=> 'topic_newstory_notify',
	'mail_subject'=> _MI_NEWS_GLOBAL_NEWSTORY_NOTIFYSBJ
);
$modversion['notification']['event'][] = array(
	'name'=> 'approve',
	'category'=> 'story',
	'invisible'=> 1,
	'title'=> _MI_NEWS_STORY_APPROVE_NOTIFY,
	'caption'=> _MI_NEWS_STORY_APPROVE_NOTIFYCAP,
	'description'=> _MI_NEWS_STORY_APPROVE_NOTIFYDSC,
	'mail_template'=> 'story_approve_notify',
	'mail_subject'=> _MI_NEWS_STORY_APPROVE_NOTIFYSBJ
);
?>