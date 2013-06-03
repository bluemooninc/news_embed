<?php
// $Id: news_topics.php,v 1.4 2004/08/04 16:03:27 hthouzard Exp $
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

function b_news_topics_show() {
	global $storytopic;	// Don't know why this is used and where it's coming from ....
    include_once XOOPS_ROOT_PATH.'/modules/news/include/functions.php';
    include_once XOOPS_ROOT_PATH."/modules/news/class/class.newstopic.php";
	$xt = new NewsTopic();
	$jump = XOOPS_URL."/modules/news/index.php?storytopic=";
	$storytopic = !empty($storytopic) ? intval($storytopic) : 0;
	$restricted=getmoduleoption('restrictindex');
	$block['selectbox'] = $xt->MakeMyTopicSelBox(1, $storytopic,"storytopic","location=\"".$jump."\"+this.options[this.selectedIndex].value",$restricted,'news_view');
	return $block;
}
?>