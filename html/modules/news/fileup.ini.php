<?php
/***************************************************************************
                           fileup.ini.php  -  description
                           ------------------------------
    begin                : Sat Mar 20 2004
    copyleft             : (C) 2004 Bluemoon inc.
    home page            : http://www.bluemooninc.biz/xoops/
    auther               : Y.Sakai
    email                : webmaster@bluemooninc.biz

    // $Id: fileup.ini.php,v 1.0.2 2004/05/17 21:15:30 Y.Sakai Exp $

 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
	//
	// for English
	//
	define("SAVE_AS_MBSTR" , "UTF-8" );		// Multi-byte filename ( UTF-8,SJIS etc... )
	define("_FILEUP_TITLE", "Upload File :");		//	File up title for your language
	define("_FILEUP_USAGE","<br />The upload file name is clear when you pushed preview.");	// Add Message about post
	define("_FILEUP_ERROR","You must signup before download.");		// Error message when reject guest download 	/*
	//
	// for Japanese
	//
	/*
	define("SAVE_AS_MBSTR" , "UTF-8" );		// Multi-byte filename ( UTF-8,SJIS etc... )
	define("_FILEUP_TITLE", "添付ファイル：");	//	File up title for your language
	define("_FILEUP_USAGE","<br />プレビューを実行すると添付ファイル欄はクリアされます。");	// Add Message for About Post
	define("_FILEUP_ERROR","ダウンロードを行うにはユーザ登録をする必要があります。");		// Error message when reject guest download 	/*
	*/
	//
	// Form style section
	//
	$def_form = 0;			// Default post form style. 0=Simple 1=Normal
	$simple_smilies = 1;	// Use Smilies Option for Simple Form
	//
	// Upload File section
	//
	define( 'UPLOADS' , XOOPS_ROOT_PATH.'/uploads/' );	// Upload folder. You can set more secure folder (ex.'c:/upload/').
	define( 'UPLOAD_ACCLEVEL' , 1 );			// 0 = Guest upload ok, 1 = xoopsUser, 2 = Auther(Admin), Default = 1
	define( 'GUEST_DOWNLOAD' , 0 ); 			// Guest Download Acceptable 0 = No , 1 = YES
	$denyUID = array(0,99999);					// Set deny naughty user's UID. It's work with UPLOAD_ACCLEVEL 1
	//
	// Image and Thumbnail Setting
	//
	$gd_ver = 2;								// PHP GD Library Version (0:Not support, 1:Ver 1, 2:Ver 2)
	$img_dir  = "/uploads/";			// Attach and direct image file folder. Work with XOOPS_ROOT_PATH,XOOPS_URL
	$thumb_dir = "/uploads/thumbs/";	// Thumbnail folder. Work with XOOPS_ROOT_PATH,XOOPS_URL
	$thumb_ext = ".+\.jpe?g$|.+\.png$|.+\.gif$";	// Thumb image target file extentions
	$w = 140;									// Thumb target width
	$h = 160;									// Thumb target height
	// Max upload file size
	// If you want set upper 2M, You must change php.ini
	//   memory_limit = 8M (default)
	//   post_max_size = 8M (default)
	//   upload_max_filesize =2M (default)
	//$maxfilesize = 2000000;			// 2MB for News

	// Acceptable MIME Content-Type
	// 'application/octet-stream' ( ex. LZH ) is $allowUnknownTypes in xoops/class/uploader.php
	// You may not allow this mime type. It's depend on XOOPS version.
	$permittedtypes=array(
		'image/gif',
		'image/jpeg', 
		'image/pjpeg', 
		'image/x-png', 
		'image/png' ,
		'application/x-zip-compressed',
		'application/zip', 
		'application/x-gtar', 
		'application/x-tar',
		'application/x-shockwave-flash',
		'video/quicktime',
		'video/x-msvideo',
		'application/pdf',
		'application/msword',
		'application/msexcel',
		'application/vnd.ms-excel',
		'application/vnd.ms-powerpoint',
		'application/x-ilf'
	);

	// embedding image MIME Content-Type
	$imgtype = "gif|jpe?g|png|bmp|x-pmd|x-mld|x-mid|x-smd|x-smaf|x-mpeg";

	// embedding EMBED MIME Content-Type
	$embedtype = "video|audio|x-shockwave";
	$embed_w = 240;		// Embed Default width
	$embed_h = 256;		// Embed Default height

	// Reject Ext. name
	$viri = "cgi|php|jsp|pl|htm";

////////////////// end ///////////////////
?>