<?php
// $Id: print.php,v 1.11 2004/09/01 17:48:07 hthouzard Exp $
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
/**
 * Print an article
 *
 * This page is used to print an article. The advantage of this script is that you
 * only see the article and nothing else.
 *
 * @package News
 * @author Xoops Modules Dev Team
 * @copyright	(c) The Xoops Project - www.xoops.org
 *
 * Parameters received by this page :
 * @page_param 	int		storyid 					Id of news to print
 *
 * @page_title			Story's title - Printer Friendly Page - Topic's title - Site's name
 *
 * @template_name		This page does not use any template
 *
*/
include_once "../../mainfile.php";
include_once XOOPS_ROOT_PATH."/modules/news/class/class.newsstory.php";
include_once XOOPS_ROOT_PATH.'/modules/news/include/functions.php';
$storyid = isset($_GET['storyid']) ? intval($_GET['storyid']) : 0;
if ( empty($storyid) ) {
	redirect_header(XOOPS_URL."/modules/news/index.php",2,_MD_NOSTORY);
}

// Verify that the article is published
$story = new NewsStory($storyid);
if ( $story->published() == 0 || $story->published() > time() ) {
    redirect_header(XOOPS_URL.'/modules/news/index.php', 2, _MD_NOSTORY);
    exit();
}

// Verify permissions
$gperm_handler =& xoops_gethandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
	$groups = XOOPS_GROUP_ANONYMOUS;
}
if (!$gperm_handler->checkRight("news_view", $story->topicid(), $groups, $xoopsModule->getVar('mid'))) {
	redirect_header(XOOPS_URL.'/modules/news/index.php', 3, _NOPERM);
	exit();
}

// ************************* COMMENTED OUT BY MAKINOSUKE @2008/4/24 *************************
//$xoops_meta_keywords='';
//$xoops_meta_description='';

//if(trim($story->keywords())!='') {
//	$xoops_meta_keywords=$story->keywords();
//} else {
//	$xoops_meta_keywords=news_createmeta_keywords($story->hometext().'<br />'.$story->bodytext());
//}

//if(trim($story->description())!='') {
//	$xoops_meta_description = $story->description();
//} else {
//	$xoops_meta_description=strip_tags($story->title());
//}
// ************************* COMMENTED OUT BY MAKINOSUKE @2008/4/24 *************************

function MakeArray()
{
	global $xoopsConfig, $xoopsModule, $story, $xoops_meta_keywords,$xoops_meta_description;
	$myts =& MyTextSanitizer::getInstance();
    $datetime = formatTimestamp($story->published(),getmoduleoption('dateformat'));

// ************************* COMMENTED OUT BY MAKINOSUKE @2008/4/24 *************************
//    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
//	echo '<html><head>';
//	echo '<title>'.$myts->htmlSpecialChars($story->title()) . ' - ' . _MD_PRINTER . ' - ' . $myts->htmlSpecialChars($story->topic_title()) . ' - ' . $xoopsConfig['sitename'].'</title>';
//	echo '<meta http-equiv="Content-Type" content="text/html; charset='._CHARSET.'" />';
//	echo '<meta name="AUTHOR" content="'.$xoopsConfig['sitename'].'" />';
//	echo '<meta name="keywords" content="'.$xoops_meta_keywords.'" />';
//	echo '<meta name="COPYRIGHT" content="Copyright (c) 2001 by '.$xoopsConfig['sitename'].'" />';
//	echo '<meta name="DESCRIPTION" content="'.$xoops_meta_description.'" />';
//	echo '<meta name="GENERATOR" content="XOOPS" />';
//	echo '<body bgcolor="#ffffff" text="#000000" onload="window.print()">
//    	<table border="0"><tr><td align="center">
//    	<table border="0" width="640" cellpadding="0" cellspacing="1" bgcolor="#000000"><tr><td>
//    	<table border="0" width="640" cellpadding="20" cellspacing="1" bgcolor="#ffffff"><tr><td align="center">
//    	<img src="'.XOOPS_URL.'/images/logo.gif" border="0" alt="" /><br /><br />
//    	<h3>'.$story->title().'</h3>
//    	<small><b>'._MD_DATE.'</b>&nbsp;'.$datetime.' | <b>'._MD_TOPICC.'</b>&nbsp;'.$myts->htmlSpecialChars($story->topic_title()).'</small><br /><br /></td></tr>';
//	echo '<tr valign="top" style="font:12px;"><td>'.$story->hometext().'<br />';
//	$bodytext = $story->bodytext();
//	$bodytext = str_replace("[pagebreak]","<br style=\"page-break-after:always;\">",$bodytext);
//	if ( $bodytext != '' ){
//    		echo $bodytext.'<br /><br />';
//	}
//	echo '</td></tr></table></td></tr></table>
//	<br /><br />';
//	printf(_MD_THISCOMESFROM,htmlspecialchars($xoopsConfig['sitename'],ENT_QUOTES));
//	echo '<br /><a href="'.XOOPS_URL.'/">'.XOOPS_URL.'</a><br /><br />
//    	'._MD_URLFORSTORY.' <!-- Tag below can be used to display Permalink image --><!--img src="'.XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/images/x.gif" /--><br />
//    	<a href="'.XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/article.php?storyid='.$story->storyid().'">'.XOOPS_URL.'/modules/news/article.php?storyid='.$story->storyid().'</a>
//    	</td></tr></table>
//    	</body>
//    	</html>
//    	';
// ************************* COMMENTED OUT BY MAKINOSUKE @2008/4/24 *************************

	// ************************* MAKINOSUKE @2008/4/24 *************************
	$bodytext = $story->bodytext();
	$bodytext = str_replace("[pagebreak]","<br style='page-break-after: always;'>",$bodytext);
	$bodytext = str_replace("<br /><br />","</p><p>",$bodytext);
	$return_arr = array(
		'lang_printable'      => _MD_PRINTER,
		'lang_sitename'       => $xoopsConfig['sitename'],
		'lang_date'           => _MD_DATE,
		'lang_topic'          => _MD_TOPICC,
		'lang_original'       => _MD_URLFORSTORY,

		'xhstr_langcode'      => _LANGCODE,
		'xhstr_charset'       => _CHARSET,
		'xhstr_meta_author'   => $xoopsConfig['sitename'],
		'xhstr_meta_copyright'=> 'Copyright (C) '.date('Y'),
		'xhstr_home'          => XOOPS_URL,

		'var_title'           => $story->title(),
		'var_topic'           => $myts->htmlSpecialChars($story->topic_title()),
		'var_date'            => $datetime,
		'var_hometext'        => $story->hometext(),
		'var_bodytext'        => $bodytext,
		'var_original'        => '/modules/'.$xoopsModule->dirname().'/article.php?storyid='.$story->storyid()
	);
	
	return $return_arr;
	
	// ************************* MAKINOSUKE @2008/4/24 *************************

}

$news_print = MakeArray(); //BY MAKINOSUKE

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $news_print['xhstr_langcode']?>" lang="<?php echo $news_print['xhstr_langcode']?>">
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php echo $news_print['xhstr_charset']?>" />
	<meta name="author" content="<?php echo $news_print['xhstr_meta_author']?>" />
	<meta name="copyright" content="<?php echo $news_print['xhstr_meta_copyright']?> <?php echo $news_print['xhstr_meta_author']?>" />
	<title>[ <?php echo $news_print['lang_printable']?> ] <?php echo $news_print['var_topic']?> : <?php echo $news_print['var_title']?> | <?php echo $news_print['lang_sitename']?></title>
	<link rel="stylesheet" type="text/css" href="/themes/aij200804/style_news.css" />
</head>
<body onload="window.print()">
<div id="news-print">
	<img id="news-print-logo" src="/themes/aij200804/gen-logo-monochro.png" alt="<?php echo $news_print['lang_sitename']?>" />
	<h1><!--<?php echo $news_print['var_date']?> - --><?php echo $news_print['var_topic']?> : <?php echo $news_print['var_title']?></h1>
	<div id="news-print-body">
		<p id="news-print-hometext"><?php echo $news_print['var_hometext']?></p>
		<p id="news-print-bodytext"><?php echo $news_print['var_bodytext']?></p>
	</div>
	<div id="news-print-info">
		<p><?php echo $news_print['xhstr_meta_copyright']?> <?php echo $news_print['xhstr_meta_author']?></p>
		<p><?php echo $news_print['lang_original']?> <a href="<?php echo $news_print['var_original']?>"><?php echo $news_print['var_original']?></a></p>
	</div>
</div>
</body>
</html>
