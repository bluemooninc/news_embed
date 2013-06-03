<?php
// $Id: functions.php,v 1.5 2004/09/02 17:04:08 hthouzard Exp $
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
if (!defined('XOOPS_ROOT_PATH')) {
	die("XOOPS root path not defined");
}

/**
 * Returns a module's option
 *
 * Return's a module's option (for the news module)
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright	(c) The Xoops Project - www.xoops.org
 * @param string $option	module option's name
 */
function getmoduleoption($option, $repmodule='news')
{
	global $xoopsModuleConfig, $xoopsModule;
	static $tbloptions= Array();
	if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) {
		return $tbloptions[$option];
	}

	$retval=false;
	if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
		if(isset($xoopsModuleConfig[$option])) {
			$retval= $xoopsModuleConfig[$option];
		}
	} else {
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname($repmodule);
		$config_handler =& xoops_gethandler('config');
		if ($module) {
		    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	    	if(isset($moduleConfig[$option])) {
	    		$retval= $moduleConfig[$option];
	    	}
		}
	}
	$tbloptions[$option]=$retval;
	return $retval;
}


/**
 * Updates rating data in item table for a given item
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function news_updaterating($storyid)
{
	global $xoopsDB;
	$query = "SELECT rating FROM ".$xoopsDB->prefix("stories_votedata")." WHERE storyid = ".$storyid."";
	$voteresult = $xoopsDB->query($query);
	$votesDB = $xoopsDB->getRowsNum($voteresult);
	$totalrating = 0;
	while(list($rating)=$xoopsDB->fetchRow($voteresult)){
		$totalrating += $rating;
	}
	$finalrating = $totalrating/$votesDB;
	$finalrating = number_format($finalrating, 4);
	$sql = sprintf("UPDATE %s SET rating = %u, votes = %u WHERE storyid = %u", $xoopsDB->prefix("stories"), $finalrating, $votesDB, $storyid);
	$xoopsDB->queryF($sql);
}



/**
 * Internal function for permissions
 *
 * Returns a list of all the permitted topics Ids for the current user
 *
 * @return array $topics	Permitted topics Ids
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function MygetItemIds($permtype='news_view')
{
	global $xoopsUser;
	static $tblperms= Array();
	if(is_array($tblperms) && array_key_exists($permtype,$tblperms)) {
		return $tblperms[$permtype];
	}

   	$module_handler =& xoops_gethandler('module');
   	$newsModule =& $module_handler->getByDirname('news');
   	$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
   	$gperm_handler =& xoops_gethandler('groupperm');
   	$topics = $gperm_handler->getItemIds($permtype, $groups, $newsModule->getVar('mid'));
   	$tblperms[$permtype] = $topics;
    return $topics;
}

function news_html2text($document)
{
	// PHP Manual:: function preg_replace
	// $document should contain an HTML document.
	// This will remove HTML tags, javascript sections
	// and white space. It will also convert some
	// common HTML entities to their text equivalent.

	$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript
	                 "'<[\/\!]*?[^<>]*?>'si",          // Strip out HTML tags
	                 "'([\r\n])[\s]+'",                // Strip out white space
	                 "'&(quot|#34);'i",                // Replace HTML entities
	                 "'&(amp|#38);'i",
	                 "'&(lt|#60);'i",
	                 "'&(gt|#62);'i",
	                 "'&(nbsp|#160);'i",
	                 "'&(iexcl|#161);'i",
	                 "'&(cent|#162);'i",
	                 "'&(pound|#163);'i",
	                 "'&(copy|#169);'i",
	                 "'&#(\d+);'e");                    // evaluate as php

	$replace = array ("",
	                 "",
	                 "\\1",
	                 "\"",
	                 "&",
	                 "<",
	                 ">",
	                 " ",
	                 chr(161),
	                 chr(162),
	                 chr(163),
	                 chr(169),
	                 "chr(\\1)");

	$text = preg_replace($search, $replace, $document);
	return $text;
}


/**
 * Retreive an editor according to the module's option "form_options"
 */
function &news_getWysiwygForm($caption, $name, $value = "", $width = '100%', $height = '400px', $supplemental='')
{
	$editor = false;
	$x22=false;
	$xv=str_replace('XOOPS ','',XOOPS_VERSION);
	if(substr($xv,2,1)=='2') {
		$x22=true;
	}
	$editor_configs=array();
	$editor_configs["name"] =$name;
	$editor_configs["value"] = $value;
	$editor_configs["rows"] = 35;
	$editor_configs["cols"] = 60;
	$editor_configs["width"] = "100%";
	$editor_configs["height"] = "400px";


	switch(strtolower(getmoduleoption('form_options'))){
	case "spaw":
		if(!$x22) {
			if (is_readable(XOOPS_ROOT_PATH . "/class/spaw/formspaw.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/spaw/formspaw.php");
				$editor = new XoopsFormSpaw($caption, $name, $value);
			}
		} else {
			$editor = new XoopsFormEditor($caption, "spaw", $editor_configs);
		}
		break;

	case "fck":
		if(!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/fckeditor/formfckeditor.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/fckeditor/formfckeditor.php");
				$editor = new XoopsFormFckeditor($caption, $name, $value);
			}
		} else {
			$editor = new XoopsFormEditor($caption, "fckeditor", $editor_configs);
		}
		break;

	case "htmlarea":
		if(!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/htmlarea/formhtmlarea.php");
				$editor = new XoopsFormHtmlarea($caption, $name, $value);
			}
		} else {
			$editor = new XoopsFormEditor($caption, "htmlarea", $editor_configs);
		}
		break;

	case "dhtml":
		if(!$x22) {
			$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 50, $supplemental);
		} else {
			$editor = new XoopsFormEditor($caption, "dhtmltextarea", $editor_configs);
		}
		break;

	case "textarea":
		$editor = new XoopsFormTextArea($caption, $name, $value);
		break;

	case "koivi":
		if(!$x22) {
			if ( is_readable(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php"))	{
				include_once(XOOPS_ROOT_PATH . "/class/wysiwyg/formwysiwygtextarea.php");
				$editor = new XoopsFormWysiwygTextArea($caption, $name, $value, '100%', '400px', '');
			}
		} else {
			$editor = new XoopsFormEditor($caption, "koivi", $editor_configs);
		}
		break;
	}
	return $editor;
}

/**
 * Creates, for Mozilla/Netscape and Opera the site navigation's bar
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function CreateSiteNavBar()
{
	global $xoopsConfig;
	$content='';
	$myts =& MyTextSanitizer::getInstance();
	include_once XOOPS_ROOT_PATH."/modules/news/class/class.newstopic.php";
	$content=sprintf("<link rel=\"Home\" title=\"%s\" href=\"%s/\" />\n",$xoopsConfig['sitename'],XOOPS_URL);
	$content.=sprintf("<link rel=\"Contents\" href=\"%s\" />\n",XOOPS_URL.'/modules/news/index.php');
	$content.=sprintf("<link rel=\"Search\" href=\"%s\" />\n",XOOPS_URL.'/search.php');
	$content.=sprintf("<link rel=\"Glossary\" href=\"%s\" />\n",XOOPS_URL.'/modules/news/archive.php');
	$content.=sprintf("<link rel=\"%s\" href=\"%s\" />\n",$myts->htmlSpecialChars(_MD_SUBMITNEWS),XOOPS_URL.'/modules/news/submit.php');
	$content.=sprintf("<link rel=\"alternate\" type=\"application/rss+xml\" title=\"%s\" href=\"%s/\" />\n",$xoopsConfig['sitename'],XOOPS_URL.'/backend.php');

	// create chapters
	include_once XOOPS_ROOT_PATH."/class/tree.php";
	include_once XOOPS_ROOT_PATH."/modules/news/class/class.newstopic.php";
	$xt = new NewsTopic();
	$allTopics = $xt->getAllTopics(getmoduleoption('restrictindex'));
	$topic_tree = new XoopsObjectTree($allTopics, 'topic_id', 'topic_pid');
	$topics_arr = $topic_tree->getAllChild(0);
	foreach ($topics_arr as $onetopic) {
		$content.=sprintf("<link rel=\"Chapter\" title=\"%s\" href=\"%s\" />\n",$onetopic->topic_title(),XOOPS_URL.'/modules/news/index.php?storytopic='.$onetopic->topic_id());
	}
	return($content);
}


/**
 * Create the meta keywords based on the content
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function news_createmeta_keywords($content)
{
	$tmp=array();
	// Search for the "Minimum keyword length"
	if(isset($_SESSION['news_keywords_limit'])) {
		$limit = $_SESSION['news_keywords_limit'];
	} else {
		$config_handler =& xoops_gethandler('config');
		$xoopsConfigSearch =& $config_handler->getConfigsByCat(XOOPS_CONF_SEARCH);
		$limit=$xoopsConfigSearch['keyword_min'];
		$_SESSION['news_keywords_limit']=$limit;
	}
	$myts =& MyTextSanitizer::getInstance();
	$content = str_replace ("<br />", " ", $content);
	$content= $myts->undoHtmlSpecialChars($content);
	$content= strip_tags($content);
	$content=strtolower($content);
	$search_pattern=array("&nbsp;","\t","\r\n","\r","\n",",",".","'",";",":",")","(",'"','?','!','{','}','[',']','<','>','/','+','-','_','\\','*');
	$replace_pattern=array(' ',' ',' ',' ',' ',' ',' ',' ','','','','','','','','','','','','','','','','','','','');
	$content = str_replace($search_pattern, $replace_pattern, $content);
	$keywords=explode(' ',$content);
	$keywords=array_unique($keywords);

// Here is another method (if you use this method, remove the previous line $keywords=array_unique($keywords); ) :
//		the keywords order is made according to the reverse keywords frequency (so the less frequent words appear in first in the list)
/*
	$keywords=array_count_values($keywords);
	//arsort($keywords);	// If you want to see the most frequent words to appear in first in the list, replace the following line with this one
	asort($keywords);
	$keywords=array_keys($keywords);
*/
	foreach($keywords as $keyword) {
		if(strlen($keyword)>=$limit && !is_numeric($keyword)) {
			$tmp[]=$keyword;
		}
	}
	$tmp=array_slice($tmp,0,20);	// If you want to change the limit of keywords, change this number from 20 to what you want
	if(count($tmp)>0) {
		return implode(',',$tmp);
	} else {
		if(!isset($config_handler) || !is_object($config_handler)) {
			$config_handler =& xoops_gethandler('config');
		}
		$xoopsConfigMetaFooter =& $config_handler->getConfigsByCat(XOOPS_CONF_METAFOOTER);
		return $xoopsConfigMetaFooter['meta_keywords'];
	}
}


/**
 * Remove module's cache
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function updateCache() {
	global $xoopsModule;
	$tpllist=array('news_item.html','news_archive.html','news_article.html','news_index.html','news_by_topic.html','news_by_this_author.html','news_ratenews.html','news_rss.html');
	include_once XOOPS_ROOT_PATH."/class/xoopsblock.php";
	include_once XOOPS_ROOT_PATH.'/class/template.php';
	// Clear blocks cache
	xoops_template_clear_module_cache($xoopsModule->getVar('mid'));
	// Clear pages cache
	$xoopsTpl = new XoopsTpl();
	foreach ($tpllist as $onetemplate) {
		$xoopsTpl->clear_cache('db:'.$onetemplate);
	}
}

/**
 * Verify that a mysql table exists
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function TableExists($tablename)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF("SHOW TABLES LIKE '$tablename'");
	return($xoopsDB->getRowsNum($result) > 0);
}

/**
 * Verify that a field exists inside a mysql table
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function FieldExists($fieldname,$table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF("SHOW COLUMNS FROM	$table LIKE '$fieldname'");
	return($xoopsDB->getRowsNum($result) > 0);
}

/**
 * Add a field to a mysql table
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function AddField($field, $table)
{
	global $xoopsDB;
	$result=$xoopsDB->queryF("ALTER TABLE " . $table . " ADD $field;");
	return $result;
}

/**
 * Verify that the current user is a member of the Admin group
 */
function is_admin_group()
{
	global $xoopsUser, $xoopsModule;
	if(is_object($xoopsUser)) {
		if(in_array("1",$xoopsUser->getGroups())) {
			return true;
		} else {
			if($xoopsUser->isAdmin($xoopsModule->mid())) {
				return true;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}


/**
 * Verify if the current "user" is a bot or not
 *
 * If you have a problem with this function, insert the folowing code just before the line if(isset($_SESSION['news_cache_bot'])) { :
 * return false;
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function news_isbot()
{
	if(isset($_SESSION['news_cache_bot'])) {
		return $_SESSION['news_cache_bot'];
	} else {
		// Add here every bot you know separated by a pipe | (not matter with the upper or lower cases)
		// If you want to see the result for yourself, add your navigator's user agent at the end (mozilla for example)
		$botlist="AbachoBOT|Arachnoidea|ASPSeek|Atomz|cosmos|crawl25-public.alexa.com|CrawlerBoy Pinpoint.com|Crawler|DeepIndex|EchO!|exabot|Excalibur Internet Spider|FAST-WebCrawler|Fluffy the spider|GAIS Robot/1.0B2|GaisLab data gatherer|Google|Googlebot-Image|googlebot|Gulliver|ia_archiver|Infoseek|Links2Go|Lycos_Spider_(modspider)|Lycos_Spider_(T-Rex)|MantraAgent|Mata Hari|Mercator|MicrosoftPrototypeCrawler|Mozilla@somewhere.com|MSNBOT|NEC Research Agent|NetMechanic|Nokia-WAPToolkit|nttdirectory_robot|Openfind|Oracle Ultra Search|PicoSearch|Pompos|Scooter|Slider_Search_v1-de|Slurp|Slurp.so|SlySearch|Spider|Spinne|SurferF3|Surfnomore Spider|suzuran|teomaagent1|TurnitinBot|Ultraseek|VoilaBot|vspider|W3C_Validator|Web Link Validator|WebTrends|WebZIP|whatUseek_winona|WISEbot|Xenu Link Sleuth|ZyBorg";
		$botlist=strtoupper($botlist);
		$currentagent=strtoupper(xoops_getenv('HTTP_USER_AGENT'));
		$retval=false;
		$botarray=explode('|',$botlist);
		foreach($botarray as $onebot) {
			if(strstr($currentagent,$onebot)) {
				$retval=true;
				break;
			}
		}
	}
	$_SESSION['news_cache_bot']=$retval;
	return $retval;
}


/**
 * Create an infotip
 *
 * @package News
 * @author Herv� Thouzard (www.herve-thouzard.com)
 * @copyright (c) The Xoops Project - www.xoops.org
*/
function make_infotips($text)
{
	$infotips = getmoduleoption('infotips');
	if($infotips>0) {
		$myts =& MyTextSanitizer::getInstance();
		return $myts->htmlSpecialChars(xoops_substr(strip_tags($text),0,$infotips));
	}
}
?>