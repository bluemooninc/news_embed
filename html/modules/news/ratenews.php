<?php
// $Id$
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
/*
 * Enable users to note a news
 *
 * This page is called from the page "article.php" and "index.php", it
 * enables users to vote for a news, according to the module's option named
 * "ratenews". This code is *heavily* based on the file "ratefile.php" from
 * the mydownloads module.
 * Possible hack : Enable only registred users to vote
 * Notes :
 *			Anonymous users can only vote 1 time per day (except if their IP change)
 *			Author's can't vote for their own news
 *			Registred users can only vote one time
 *
 * @package News
 * @author Xoops Modules Dev Team
 * @copyright	(c) The Xoops Project - www.xoops.org
 *
 * Parameters received by this page :
 * @page_param 	int		storyid	Id of the story we are going to vote for
 * @page_param 	string	submit	The submit button of the rating form
 * @page_param 	int		rating	User's rating
 *
 * @page_title			Story's title - "Rate this news" - Module's name
 *
 * @template_name		news_ratenews.html
 *
 * Template's variables :
 * @template_var	string	lang_voteonce	Fixed text "Please do not vote for the same resource more than once."
 * @template_var	string	lang_ratingscale	Fixed text "The scale is 1 - 10, with 1 being poor and 10 being excellent."
 * @template_var	string	lang_beobjective	Fixed text "Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful."
 * @template_var	string	lang_donotvote		Fixed text "Do not vote for your own resource."
 * @template_var	string	lang_rateit			Fixed text "Rate It!"
 * @template_var	string	lang_cancel			Fixed text "Cancel"
 * @template_var	array	news				Contains some information about the story
 *									Structure :
 * @template_var					int		storyid		Story's ID
 * @template_var					string	title		story's title
 */
include_once "header.php";
include_once XOOPS_ROOT_PATH."/class/module.errorhandler.php";
include_once XOOPS_ROOT_PATH.'/modules/news/include/functions.php';
include_once XOOPS_ROOT_PATH."/modules/news/class/class.newsstory.php";
$myts =& MyTextSanitizer::getInstance();

// Verify the perms
// 1) Is the vote activated in the module ?
$ratenews=getmoduleoption('ratenews');
if(!$ratenews) {
	redirect_header(XOOPS_URL.'/modules/news/index.php', 3, _NOPERM);
	exit();
}

// 2) Is the story published ?
$storyid = 0;
if(isset($_GET['storyid'])) {
	$storyid = intval($_GET['storyid']);
} else {
	if(isset($_POST['storyid'])) {
		$storyid = intval($_POST['storyid']);
	}
}

if(!empty($storyid)) {
	$article = new NewsStory($storyid);
	if ( $article->published() == 0 || $article->published() > time() ) {
	    redirect_header(XOOPS_URL.'/modules/news/index.php', 2, _MD_NOSTORY);
	    exit();
	}
} else {
	redirect_header(XOOPS_URL.'/modules/news/index.php', 2, _MD_NOSTORY);
	exit();
}

// 3) Does the user can see this news ? If he can't see it, he can't vote for
$gperm_handler =& xoops_gethandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}
if (!$gperm_handler->checkRight("news_view", $article->topicid(), $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL.'/modules/news/index.php', 3, _NOPERM);
	exit();
}

if(!empty($_POST['submit'])) {			// The form was submited
	$eh = new ErrorHandler; 			//ErrorHandler object
	if(!is_object($xoopsUser)){
		$ratinguser = 0;
	}else{
		$ratinguser = $xoopsUser->getVar('uid');
	}

	//Make sure only 1 anonymous from an IP in a single day.
	$anonwaitdays = 1;
	$ip = getenv("REMOTE_ADDR");
	$storyid = intval($_POST['storyid']);
	$rating = intval($_POST['rating']);

	// Check if Rating is Null
	if ($rating=="--") {
		redirect_header(XOOPS_URL."/modules/news/ratenews.php?storyid=".$storyid."",4,_MD_NORATING);
		exit();
	}

	// Check if News POSTER is voting (UNLESS Anonymous users allowed to post)
	if ($ratinguser != 0) {
		$result=$xoopsDB->query("SELECT uid FROM ".$xoopsDB->prefix("news_stories")." WHERE storyid=$storyid");
		while(list($ratinguserDB)=$xoopsDB->fetchRow($result)) {
			if ($ratinguserDB==$ratinguser) {
				redirect_header(XOOPS_URL."/modules/news/index.php",4,_MD_CANTVOTEOWN);
				exit();
			}
		}

		// Check if REG user is trying to vote twice.
		$result=$xoopsDB->query("SELECT ratinguser FROM ".$xoopsDB->prefix("stories_votedata")." WHERE storyid=$storyid");
		while(list($ratinguserDB)=$xoopsDB->fetchRow($result)) {
			if ($ratinguserDB==$ratinguser) {
				redirect_header(XOOPS_URL."/modules/news/index.php",4,_MD_VOTEONCE);
				exit();
			}
		}

	} else {
		// Check if ANONYMOUS user is trying to vote more than once per day.
		$yesterday = (time()-(86400 * $anonwaitdays));
		$result=$xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("stories_votedata")." WHERE storyid=$storyid AND ratinguser=0 AND ratinghostname = '$ip'  AND ratingtimestamp > $yesterday");
		list($anonvotecount) = $xoopsDB->fetchRow($result);
		if ($anonvotecount >= 1) {
			redirect_header(XOOPS_URL."/modules/news/index.php",4,_MD_VOTEONCE);
			exit();
		}
	}

	//All is well.  Add to Line Item Rate to DB.
	$newid = $xoopsDB->genId($xoopsDB->prefix("stories_votedata")."_ratingid_seq");
	$datetime = time();
	$sql = sprintf("INSERT INTO %s (ratingid, storyid, ratinguser, rating, ratinghostname, ratingtimestamp) VALUES (%u, %u, %u, %u, '%s', %u)", $xoopsDB->prefix("stories_votedata"), $newid, $storyid, $ratinguser, $rating, $ip, $datetime);
	$xoopsDB->query($sql) or $eh("0013");

	//All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB.
	news_updaterating($storyid);
	$ratemessage = _MD_VOTEAPPRE."<br />".sprintf(_MD_THANKYOU,$xoopsConfig['sitename']);
	redirect_header(XOOPS_URL."/modules/news/index.php",4,$ratemessage);
	exit();
} else {		// Display the form to vote
	$xoopsOption['template_main'] = 'news_ratenews.html';
    include_once XOOPS_ROOT_PATH."/header.php";
    $result=$xoopsDB->query("SELECT title FROM ".$xoopsDB->prefix("news_stories")." WHERE storyid=$storyid");
    list($title) = $xoopsDB->fetchRow($result);
    $title = $myts->htmlSpecialChars($title);
    $xoopsTpl->assign('news', array('storyid' => $storyid, 'title' => $title));
    $xoopsTpl->assign('lang_voteonce', _MD_VOTEONCE);
    $xoopsTpl->assign('lang_ratingscale', _MD_RATINGSCALE);
    $xoopsTpl->assign('lang_beobjective', _MD_BEOBJECTIVE);
    $xoopsTpl->assign('lang_donotvote', _MD_DONOTVOTE);
    $xoopsTpl->assign('lang_rateit', _MD_RATEIT);
    $xoopsTpl->assign('lang_cancel', _CANCEL);
    $xoopsTpl->assign('xoops_pagetitle',$title . ' - ' . _MD_RATETHISNEWS . ' - ' .  $myts->htmlSpecialChars($xoopsModule->name()));
    include_once XOOPS_ROOT_PATH.'/footer.php';
}
include_once XOOPS_ROOT_PATH.'/footer.php';
?>
