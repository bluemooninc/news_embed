<?php
// $Id: class.fileup.php,v 1.0.2 2004/06/06 10:50:00 Yoshi.S Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Fileup Management Program                      //
//                    Copyright (c) 2004 Bluemoon inc.                       //
//                       <http://www.bluemooninc.biz/>                       //
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
// ------------------------------------------------------------------------- //
include_once XOOPS_ROOT_PATH.'/modules/news/fileup.ini.php';
include_once XOOPS_ROOT_PATH.'/modules/news/thumb.php';
//
// file upload by Y.Sakai 2004/3/14
//
function news_fileup( $addmsg, $upfile_name , $realname, $upfile_type, $upfile_size ) {
	global $xoopsUser;
	global $viri,$imgtype,$embedtype,$embed_w,$embed_h,$thumb_ext,$img_dir,$thumb_dir,$w,$h;
	if ($upfile_name && is_object($xoopsUser)){
		//echo "$addmsg, $upfile_name ,$upfile_type, $upfile_size";
		// Disp File Infomation for debug
		//print("File Infomation:<BR>\n");
		//print("$upfile_name ,$upfile_type, $upfile_size<BR>\n");
		$deny=0;
		$ext = strtolower(end(explode(".",$upfile_name))); 
		if (eregi($viri, $ext)) $deny = 2;
		if (eregi($imgtype, $upfile_type)){
			$upfile_localname = $upfile_name;
			$upfile_url = XOOPS_URL.$img_dir.rawurlencode($upfile_localname);
			// Thumbs Support ( PHP GD Libraly Required )
			if (eregi($thumb_ext,$upfile_localname)) {
				$size = getimagesize(XOOPS_ROOT_PATH.$img_dir.$upfile_localname);
				if ($size[0] > $w || $size[1] > $h) {
					$thumbfilename = thumb_create(XOOPS_ROOT_PATH.$img_dir.$upfile_localname,$w,$h,XOOPS_ROOT_PATH.$thumb_dir);
					$addimg = "\n<a href=".$upfile_url." target=\"_blank\">[img align=left]".XOOPS_URL.$thumb_dir.rawurlencode($thumbfilename)."[/img]</a>\n";
				} else {
					$addimg = "\n[img align=left]".$upfile_url."[/img]\n";
				}
			} else {
				$addimg = "\n[img align=left]".$upfile_url."[/img]\n";
			}
			$addmsg = $addimg.$addmsg;
		} elseif (eregi($embedtype, $upfile_type)){
			$upfile_localname = $upfile_name;		// convert for mbstrings
			$upfile_url = XOOPS_URL.$img_dir.rawurlencode($upfile_localname);
			$addmsg = "\n<EMBED src=\"".$upfile_url."\" WIDTH=\"".$embed_w."\" HEIGHT=\"".$embed_h.
				"\" autostart=\"false\" controller=\"true\" hspace=\"5\" align=\"left\" alt=\"\">".
				$addmsg."</EMBED>\n";
		} elseif ($deny==0) {
			$upfile_localname = $upfile_name;
			$upfile_url='/'.rawurlencode($upfile_localname);	// XOOPS_UPLOAD_URL.
			$upfile_localname = cnv_mbstr($upfile_localname);		// convert for mbstrings
			$addmsg .= "&nbsp;:download:";
			$addmsg .= "[url=".XOOPS_URL."/modules/news/download.php?url=".$upfile_url."&filename=".$realname."]".$realname."[/url]\n";
		} else {
			$addmsg .= "\nUpload Denied(".$deny.")MIME[".$upfile_type."]ext[".$ext."]";
		}
	}
	return $addmsg;
}
//
// Support for Multi-byte filename. By Y.Sakai 2004/4/11
//
function cnv_mbstr($str) {
	if (extension_loaded('mbstring')){
		return  mb_convert_encoding($str,SAVE_AS_MBSTR,"auto");
	} else {
		return $str;
	}
}
?>