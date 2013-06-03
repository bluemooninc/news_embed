<?php
// $Id: main.php,v 1.9 2004/07/26 17:51:25 hthouzard Exp $

//%%%%%%		File Name index.php 		%%%%%
define("_MD_NEWSRELEASE","News Release");
define("_MD_ALLTOPIC","All Topics");
define("_MD_NEWARRIVAL","New Arrival with Topic");
define("_MD_ARCHIVE","Archive (Each issue date)");
define("_MD_SELECTTOPIC","Select topic");
define("_MD_SELECT","Select");
define("_MD_PRINTER","Printer Friendly Page");
define("_MD_SENDSTORY","Send this Story to a Friend");
define("_MD_READMORE","Read More...");
define("_MD_COMMENTS","Comments?");
define("_MD_ONECOMMENT","1 comment");
define("_MD_BYTESMORE","%s bytes more");
define("_MD_NUMCOMMENTS","%s comments");
define("_MD_MORERELEASES", "More releases in ");
define('_MD_GOTOMODULEADMIN','Go to module admin');

//%%%%%%		File Name submit.php		%%%%%
define("_MD_SUBMITNEWS","Submit News");
define("_MD_TITLE","Title");
define("_MD_TOPIC","Topic");
define("_MD_THESCOOP","The Scoop");
define("_MD_NOTIFYPUBLISH","Notify by mail when published");
define("_MD_POST","Post");
define("_MD_GO","Go!");
define("_MD_THANKS","Thanks for your submission."); //submission of news article

define("_MD_NOTIFYSBJCT","NEWS for my site"); // Notification mail subject
define("_MD_NOTIFYMSG","Hey! You got a new submission for your site."); // Notification mail message

//%%%%%%		File Name archive.php		%%%%%
define("_MD_NEWSARCHIVES","News Archives");
define("_MD_YEARC","");
define("_MD_NEWS_OF"," news");
define("_MD_NEWSLIST_OF"," News List");
define("_MD_ARTICLES","Articles");
define("_MD_VIEWS","Views");
define("_MD_DATE","Date");
define("_MD_ACTIONS","Actions");
define("_MD_PRINTERFRIENDLY","Printer Friendly Page");

define("_MD_THEREAREINTOTAL","There are %s article(s) in total");

// %s is your site name
define("_MD_INTARTICLE","Interesting Article at %s");
define("_MD_INTARTFOUND","Here is an interesting article I have found at %s");

define("_MD_TOPICC","Topic:");
define("_MD_URL","URL:");
define("_MD_NOSTORY","Sorry, the selected story does not exist.");

//%%%%%%	File Name print.php 	%%%%%

define("_MD_URLFORSTORY","The URL for this story is:");

// %s represents your site name
define("_MD_THISCOMESFROM","This article comes from %s");

// Added by Herv�
define("_MD_ATTACHEDFILES","Attached Files:");
define("_MD_ATTACHEDLIB","This article have some attached files");
define("_MD_NEWSSAMEAUTHORLINK","News by the same author");
define("_MD_NEWS_NO_TOPICS","Sorry but actually there's no topics, please create one before to submit a news");
define("_MD_PREVIOUS_ARTICLE","Previous article");
define("_MD_NEXT_ARTICLE","Next article");
define("_MD_OTHER_ARTICLES","Other articles");

// Added by Herv� in version 1.3 for rating
define("_MD_RATETHISNEWS","Rate this News");
define("_MD_RATEIT","Rate It!");
define("_MD_TOTALRATE","Total Ratings");
define("_MD_RATINGLTOH","Rating (Lowest Score to Highest Score)");
define("_MD_RATINGHTOL","Rating (Highest Score to Lowest Score)");
define("_MD_RATINGC","Rating: ");
define("_MD_RATINGSCALE","The scale is 1 - 10, with 1 being poor and 10 being excellent.");
define("_MD_BEOBJECTIVE","Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful.");
define("_MD_DONOTVOTE","Do not vote for your own resource.");
define("_MD_RATING","Rating");
define("_MD_VOTE","Vote");
define("_MD_NORATING","No rating selected.");
define("_MD_USERAVG","Average User Rating");
define("_MD_DLRATINGS","News Rating (total votes: %s)");
define("_MD_ONEVOTE","1 vote");
define("_MD_NUMVOTES","%u votes");		// Warning
define("_MD_CANTVOTEOWN","You cannot vote on the resource you submitted.<br />All votes are logged and reviewed.");
define("_MD_VOTEDELETED","Vote data deleted.");
define("_MD_VOTEONCE","Please do not vote for the same resource more than once.");
define("_MD_VOTEAPPRE","Your vote is appreciated.");
define("_MD_THANKYOU","Thank you for taking the time to vote here at %s"); // %s is your site name
define("_MD_RSSFEED","RSS Feed");	// Warning, this text is included insided an Alt attribut (for a picture), so take care to the quotes
define("_MD_AUTHOR","Author");
define("_MD_META_DESCRIPTION","Meta description");
define("_MD_META_KEYWORDS","Meta keywords");
define("_MD_MAKEPDF","Create a PDF from the article");
define('_MD_POSTEDON',"Posted on : ");
define("_MD_AUTHOR_ID","Author's ID");
define("_MD_POST_SORRY","Sorry but either there are no topics or you don't have the rights to post in any topic. If you ar the webmaster, go in the permissions and set the 'Submit' permissions.");
?>