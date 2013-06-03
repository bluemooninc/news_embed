<?php
// $Id: storyform.inc.php,v 1.14 2004/09/03 17:30:43 hthouzard Exp $
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

if (file_exists(XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/calendar.php')) {
	include_once XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/calendar.php';
} else {
	include_once XOOPS_ROOT_PATH.'/language/english/calendar.php';
}
include_once XOOPS_ROOT_PATH."/class/xoopsformloader.php";
include_once XOOPS_ROOT_PATH.'/modules/news/include/functions.php';



$temp = new XoopsFormText(_MD_TITLE, 'title', 50, 255, $title);

$sform = new XoopsThemeForm(_MD_SUBMITNEWS, "storyform", XOOPS_URL.'/modules/'.$xoopsModule->getVar('dirname').'/submit.php');
$sform->setExtra('enctype="multipart/form-data"');
$sform->addElement(new XoopsFormText(_MD_TITLE, 'title', 50, 255, $title), true);

// Topic's selection box
if (!isset($xt)) {
	$xt = new NewsTopic();
}
if($xt->getAllTopicsCount()==0) {
   	redirect_header("index.php",4,_MD_POST_SORRY);
   	exit();
}

include_once XOOPS_ROOT_PATH."/class/tree.php";
$allTopics = $xt->getAllTopics($xoopsModuleConfig['restrictindex'],'news_submit');
$topic_tree = new XoopsObjectTree($allTopics, 'topic_id', 'topic_pid');
$topic_select = $topic_tree->makeSelBox('topic_id', 'topic_title', '-- ', $topicid, false);
$sform->addElement(new XoopsFormLabel(_MD_TOPIC, $topic_select));


//If admin - show admin form
//TODO: Change to "If submit privilege"
if ($approveprivilege) {
    //Show topic image?
    $sform->addElement(new XoopsFormRadioYN(_AD_TOPICDISPLAY, 'topicdisplay', $topicdisplay));

    //Select image position
    $posselect = new XoopsFormSelect(_AD_TOPICALIGN, 'topicalign', $topicalign);
    $posselect->addOption('R', _AD_RIGHT);
    $posselect->addOption('L', _AD_LEFT);
    $sform->addElement($posselect);

    //Publish in home?
    //TODO: Check that pubinhome is 0 = no and 1 = yes (currently vice versa)
    $sform->addElement(new XoopsFormRadioYN(_AD_PUBINHOME, 'ihome', $ihome, _NO, _YES));

}

// News author
if ($approveprivilege && is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
	if(!isset($newsauthor)) {
		$newsauthor=$xoopsUser->getVar('uid');
	}
	$member_handler = &xoops_gethandler( 'member' );
	$usercount = $member_handler->getUserCount();
	if ( $usercount < 300) {
		$sform->addElement(new XoopsFormSelectUser(_MD_AUTHOR,'author',true, $newsauthor),false);

	} else {
		$sform->addElement(new XoopsFormText(_MD_AUTHOR_ID, 'author', 10, 10, $newsauthor), false);

	}
}

$editor=news_getWysiwygForm(_MD_THESCOOP, 'hometext', $hometext, 15, 60, 'hometext_hidden');
if($op != 'edit' && $op != 'preview' && $op != 'form'){// by makinosuke @ 2009.1.10
	$sform->addElement($editor,true);
}else{// by makinosuke @ 2009.1.10
	$sform->addElement(new XoopsFormTextArea(_MD_THESCOOP, 'hometext', $hometext));// by makinosuke @ 2009.1.10
}// by makinosuke @ 2009.1.10

//Extra info
//If admin -> if submit privilege
if ($approveprivilege) {
    $editor2=news_getWysiwygForm(_AD_EXTEXT, 'bodytext', $bodytext, 15, 60, 'bodytext_hidden');
if($op != 'edit' && $op != 'preview' && $op != 'form'){// by makinosuke @ 2009.1.10
	$sform->addElement($editor2,false);
}else{// by makinosuke @ 2009.1.10
	$sform->addElement(new XoopsFormTextArea(_AD_EXTEXT, 'bodytext', $bodytext));// by makinosuke @ 2009.1.10
}// by makinosuke @ 2009.1.10

    if(getmoduleoption('metadata')) {
		$sform->addElement(new xoopsFormText(_MD_META_DESCRIPTION, 'description', 50, 255, $description), false);

		$sform->addElement(new xoopsFormText(_MD_META_KEYWORDS, 'keywords', 50, 255, $keywords), false);

    }
}

// Manage upload(s)
$allowupload = false;
switch ($xoopsModuleConfig['uploadgroups'])
{
	case 1: //Submitters and Approvers
		$allowupload = true;
		break;
	case 2: //Approvers only
		$allowupload = $approveprivilege ? true : false;
		break;
	case 3: //Upload Disabled
		$allowupload = false;
		break;
}

if($allowupload)
{
	if($op=='edit') {
		$sfiles = new sFiles();
		$filesarr=Array();
		$filesarr=$sfiles->getAllbyStory($storyid);
		if(count($filesarr)>0) {
			$upl_tray = new XoopsFormElementTray(_AD_UPLOAD_ATTACHFILE,'<br />');
			$upl_checkbox=new XoopsFormCheckBox('', 'delupload[]');

			foreach ($filesarr as $onefile)
			{
				$link=sprintf("<a href='%s/%s' target='_blank'>%s</a>\n",XOOPS_UPLOAD_URL,$onefile->getDownloadname('S'),$onefile->getFileRealName('S'));
				$upl_checkbox->addOption($onefile->getFileid(),$link);
			}
			$upl_tray->addElement($upl_checkbox,false);
			$dellabel=new XoopsFormLabel(_AD_DELETE_SELFILES,'');
			$upl_tray->addElement($dellabel,false);
			$sform->addElement($upl_tray);

		}
	}
	$sform->addElement(new XoopsFormFile(_AD_SELFILE, 'attachedfile', $xoopsModuleConfig['maxuploadsize']), false);

}


$option_tray = new XoopsFormElementTray(_OPTIONS,'<br />');
//Set date of publish/expiration
if ($approveprivilege) {
	if(is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->getVar('mid'))) {
		$approve=1;
	}
    $approve_checkbox = new XoopsFormCheckBox('', 'approve', $approve);
    $approve_checkbox->addOption(1, _AD_APPROVE);
    $option_tray->addElement($approve_checkbox);

    $check=$published>0 ? 1 :0;
    $published_checkbox = new XoopsFormCheckBox('', 'autodate',$check);
    $published_checkbox->addOption(1, _AD_SETDATETIME);
    $option_tray->addElement($published_checkbox);

    $option_tray->addElement(new XoopsFormDateTime(_AD_SETDATETIME, 'publish_date', 15, $published));

	$check=$expired>0 ? 1 :0;
    $expired_checkbox = new XoopsFormCheckBox('', 'autoexpdate',$check);
    $expired_checkbox->addOption(1, _AD_SETEXPDATETIME);
    $option_tray->addElement($expired_checkbox);

    $option_tray->addElement(new XoopsFormDateTime(_AD_SETEXPDATETIME, 'expiry_date', 15, $expired));
}

if (is_object($xoopsUser)) {
	$notify_checkbox = new XoopsFormCheckBox('', 'notifypub', $notifypub);
	$notify_checkbox->addOption(1, _MD_NOTIFYPUBLISH);
	$option_tray->addElement($notify_checkbox);
	if ($xoopsUser->isAdmin($xoopsModule->getVar('mid'))) {
		$nohtml_checkbox = new XoopsFormCheckBox('', 'nohtml', $nohtml);
		$nohtml_checkbox->addOption(1, _DISABLEHTML);
		$option_tray->addElement($nohtml_checkbox);
	}
}
$smiley_checkbox = new XoopsFormCheckBox('', 'nosmiley', $nosmiley);
$smiley_checkbox->addOption(1, _DISABLESMILEY);
$option_tray->addElement($smiley_checkbox);


$sform->addElement($option_tray);


//TODO: Approve checkbox + "Move to top" if editing + Edit indicator

//Submit buttons
$button_tray = new XoopsFormElementTray('' ,'');
$preview_btn = new XoopsFormButton('', 'preview', _PREVIEW, 'submit');
$preview_btn->setExtra('accesskey="p"');
$button_tray->addElement($preview_btn);
$submit_btn = new XoopsFormButton('', 'post', _MD_POST, 'submit');
$submit_btn->setExtra('accesskey="s"');
$button_tray->addElement($submit_btn);
$sform->addElement($button_tray);


//Hidden variables
if(isset($storyid)){
    $sform->addElement(new XoopsFormHidden('storyid', $storyid));

}

if (!isset($returnside)) {
	$returnside=isset($_POST['returnside']) ? intval($_POST['returnside']) : 0;
	if(empty($returnside))	{
		$returnside=isset($_GET['returnside']) ? intval($_GET['returnside']) : 0;
	}
}

if(!isset($returnside)) {
	$returnside=0;
}
$sform->addElement(new XoopsFormHidden('returnside', $returnside),false);


if (!isset($type)) {
    if ($approveprivilege) {
        $type = "admin";
    }
    else {
        $type = "user";
    }
}
$type_hidden = new XoopsFormHidden('type', $type);
$sform->addElement($type_hidden);
if($op != 'edit' && $op != 'preview' && $op != 'form'){// by makinosuke @ 2009.1.10
	$sform->display();
}else{// by makinosuke @ 2009.1.10
	$xoopsTpl->assign('formset', $sform->render());// by makinosuke @ 2009.1.10
}// by makinosuke @ 2009.1.10
?>