<?php
/***************************************************************************
                           download.php  -  description
                           ----------------------------
    begin                : Wed Apr 21 2004
    copyleft             : (C) 2004,2005 Bluemoon inc.
    home page            : http://www.bluemooninc.biz/
    auther               : Y.Sakai
    email                : webmaster@bluemooninc.biz
    Special Thanks to    : Nat Sakimura,funran7

    $Id: download.php,v 1.45 2008/04/10 11:53:36 yoshis Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
ini_set("memory_limit","40M");
include_once 'header.php';
//include("../../mainfile.php");
include 'fileup.ini.php';
include_once 'include/browser.php';
include_once "./class/mbfunction.class.php";
include_once "./class/download.class.php";
include_once "./class/class.sfiles.php";

if (!is_object($xoopsUser) && GUEST_DOWNLOAD==0){
	redirect_header(XOOPS_URL."/user.php",2,_FILEUP_ERROR);
	exit();
}
$urlfname = htmlspecialchars ( rawurldecode($_GET['url']) , ENT_QUOTES );
$fpathname = UPLOADS.$urlfname;
if(!file_exists($fpathname)){
	print("Error - $urlfname does not exist.");
	return ;
}
$down = new download($urlfname);
$ctype = $down->contentType() ;
// Get real name for client browser
$sfiles = new sFiles();
$dl_filename = $sfiles->getRealNameByDownloadName( $urlfname );

$mb = new mb_func();
ob_clean();
$browser = $version =0;
UsrBrowserAgent($browser,$version);
@ignore_user_abort();
@set_time_limit(0);
if ($browser == 'IE' && (ini_get('zlib.output_compression')) ) {
    ini_set('zlib.output_compression', 'Off');
}
/*if (!empty($content_encoding)) {
    header('Content-Encoding: ' . $content_encoding);
}*/
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($fpathname) );
header("Content-type: " . $ctype);
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Last-Modified: ' . date("D M j G:i:s T Y"));
header("Content-Disposition: attachment; " . $mb->cnv_mbstr4browser($dl_filename,$browser));
//header('Content-Disposition: attachment; filename="' . $dl_filename . '"');
//header("Content-Disposition: inline; " . $mb->cnv_mbstr4browser($dl_filename,$browser));
if ($browser == 'IE') {
    header('Pragma: public');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
} else {
    header('Pragma: no-cache');
}
$fp=fopen($fpathname,'r');
while(!feof($fp)) {
	$buffer = fread($fp, 1024*6); //speed-limit 64kb/s
	print $buffer;
	flush();
	ob_flush();
	usleep(10000); 
}
fclose($fp);

//
// Save download log
//
if ($xoopsUser) $uname = $xoopsUser->getVar('uname'); else $uname = "Anonymous";
$str = $uname.",".date("Y-m-d H:i:s", time());
$postlog = $urlfname.'.log';
$fp = fopen($postlog, 'a');
fwrite($fp, $str."\n");
fclose($fp);
?>
