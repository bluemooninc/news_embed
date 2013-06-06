<?php
// $Id: admin.php,v 1.18 2004/07/26 17:51:25 hthouzard Exp $
//%%%%%%	Admin Module Name  Articles 	%%%%%
define("_AD_DBUPDATED","Database Updated Successfully!");
define("_AD_CONFIG","News Configuration");
define("_AD_AUTOARTICLES","Automated Articles");
define("_AD_STORYID","Story ID");
define("_AD_TITLE","Title");
define("_AD_TOPIC","Topic");
define("_AD_POSTER","Poster");
define("_AD_PROGRAMMED","Programmed Date/Time");
define("_AD_ACTION","Action");
define("_AD_EDIT","Edit");
define("_AD_DELETE","Delete");
define("_AD_LAST10ARTS","Last %d Articles");
define("_AD_PUBLISHED","Published"); // Published Date
define("_AD_GO","Go!");
define("_AD_EDITARTICLE","Edit Article");
define("_AD_POSTNEWARTICLE","Post New Article");
define("_AD_ARTPUBLISHED","Your article has been published!");
define("_AD_HELLO","Hello %s,");
define("_AD_YOURARTPUB","Your article submitted to our site has been published.");
define("_AD_TITLEC","Title: ");
define("_AD_URLC","URL: ");
define("_AD_PUBLISHEDC","Published: ");
define("_AD_RUSUREDEL","Are you sure you want to delete this article and all its comments?");
define("_AD_YES","Yes");
define("_AD_NO","No");
define("_AD_INTROTEXT","Intro Text");
define("_AD_EXTEXT","Extended Text");
define("_AD_ALLOWEDHTML","Allowed HTML:");
define("_AD_DISAMILEY","Disable Smiley");
define("_AD_DISHTML","Disable HTML");
define("_AD_APPROVE","Approve");
define("_AD_MOVETOTOP","Move this story to top");
define("_AD_CHANGEDATETIME","Change the date/time of publication");
define("_AD_NOWSETTIME","It is now set at: %s"); // %s is datetime of publish
define("_AD_CURRENTTIME","Current time is: %s");  // %s is the current datetime
define("_AD_SETDATETIME","Set the date/time of publish");
define("_AD_MONTHC","Month:");
define("_AD_DAYC","Day:");
define("_AD_YEARC","Year:");
define("_AD_TIMEC","Time:");
define("_AD_PREVIEW","Preview");
define("_AD_SAVE","Save");
define("_AD_PUBINHOME","Publish in Home?");
define("_AD_ADD","Add");

//%%%%%%	Admin Module Name  Topics 	%%%%%

define("_AD_ADDMTOPIC","Add a MAIN Topic");
define("_AD_TOPIC_TITLE","Topic Name");
// Warning, changed from 40 to 255 characters.
define("_AD_MAX40CHAR","(max: 255 characters)");
define("_AD_TOPICIMG","Topic Image");
define("_AD_IMGNAEXLOC","image name + extension located in %s");
define("_AD_FEXAMPLE","for example: games.gif");
define("_AD_ADDSUBTOPIC","Add a SUB-Topic");
define("_AD_IN","in");
define("_AD_MODIFYTOPIC","Modify Topic");
define("_AD_MODIFY","Modify");
define("_AD_PARENTTOPIC","Parent Topic");
define("_AD_SAVECHANGE","Save Changes");
define("_AD_DEL","Delete");
define("_AD_CANCEL","Cancel");
define("_AD_WAYSYWTDTTAL","WARNING: Are you sure you want to delete this Topic and ALL its Stories and Comments?");


// Added in Beta6
define("_AD_TOPICSMNGR","Topics Manager");
define("_AD_PEARTICLES","Post/Edit Articles");
define("_AD_NEWSUB","New Submissions");
define("_AD_POSTED","Posted");
define("_AD_GENERALCONF","General Configuration");

// Added in RC2
define("_AD_TOPICDISPLAY","Display Topic Image?");
define("_AD_TOPICALIGN","Position");
define("_AD_RIGHT","Right");
define("_AD_LEFT","Left");

define("_AD_EXPARTS","Expired Articles");
define("_AD_EXPIRED","Expired");
define("_AD_CHANGEEXPDATETIME","Change the date/time of expiration");
define("_AD_SETEXPDATETIME","Set the date/time of expiration");
define("_AD_NOWSETEXPTIME","It is now set at: %s");

// Added in RC3
define("_AD_ERRORTOPICNAME", "You must enter a topic name!");
define("_AD_EMPTYNODELETE", "Nothing to delete!");

// Added 240304 (Mithrandir)
define('_AD_GROUPPERM', 'Submit/Approve/View Permissions');
define('_AD_SELFILE','Select file to upload');

// Added by Herv�
define('_AD_UPLOAD_DBERROR_SAVE','Error while attaching file to the story');
define('_AD_UPLOAD_ERROR','Error while uploading the file');
define('_AD_UPLOAD_ATTACHFILE','Attached file(s)');
define('_AD_APPROVEFORM', 'Approve Permissions');
define('_AD_SUBMITFORM', 'Submit Permissions');
define('_AD_VIEWFORM', 'View Permissions');
define('_AD_APPROVEFORM_DESC', 'Select, who can approve news');
define('_AD_SUBMITFORM_DESC', 'Select, who can submit news');
define('_AD_VIEWFORM_DESC', 'Select, who can view which topics');
define('_AD_DELETE_SELFILES', 'Delete selected files');
define('_AD_TOPIC_PICTURE', 'Upload picture');
define('_AD_UPLOAD_WARNING', '<B>Warning, do not forget to apply write permissions to the following folder : %s</B>');

define('_AD_NEWS_UPGRADECOMPLETE', 'Upgrade Complete');
define('_AD_NEWS_UPDATEMODULE', 'Update module templates and blocks');
define('_AD_NEWS_UPGRADEFAILED', 'Upgrade Failed');
define('_AD_NEWS_UPGRADE', 'Upgrade');
define('_AD_ADD_TOPIC','Add a topic');
define('_AD_ADD_TOPIC_ERROR','Error, topic already exists!');
define('_AD_ADD_TOPIC_ERROR1','ERROR: Cannot select this topic for parent topic!');
define('_AD_SUB_MENU','Publish this topic as a sub menu');
define('_AD_SUB_MENU_YESNO','Sub-menu?');
define('_AD_HITS', 'Hits');
define('_AD_CREATED', 'Created');

define('_AD_TOPIC_DESCR', "Topic's description");
define('_AD_USERS_LIST', "Users List");
define('_AD_PUBLISH_FRONTPAGE', "Publish in front page ?");
define('_AD_NEWS_UPGRADEFAILED1', 'Impossible to create the table stories_files');
define('_AD_NEWS_UPGRADEFAILED2', "Impossible to change the topic title's length");
define('_AD_NEWS_UPGRADEFAILED21', "Impossible to add the new fields to the topics table");
define('_AD_NEWS_UPGRADEFAILED3', 'Impossible to create the table stories_votedata');
define('_AD_NEWS_UPGRADEFAILED4', "Impossible to create the two fields 'rating' and 'votes' for the 'story' table");
define('_AD_NEWS_UPGRADEFAILED0', "Please note the messages and try to correct the problems with phpMyadmin and the sql definition's file available in the 'sql' folder of the news module");
define('_AD_NEWS_UPGR_ACCESS_ERROR',"Error, to use the upgrade script, you must be an admin on this module");
define('_AD_NEWS_PRUNE_BEFORE',"Prune stories that were published before");
define('_AD_NEWS_PRUNE_EXPIREDONLY',"Only remove stories who have expired");
define('_AD_NEWS_PRUNE_CONFIRM',"Warning, you are going to permanently remove stories that were published before %s (this action can't be undone). It represents %s stories.<br />Are you sure ?");
define('_AD_NEWS_PRUNE_TOPICS',"Limit to the following topics");
define('_AD_NEWS_PRUNENEWS', 'Prune news');
define('_AD_NEWS_EXPORT_NEWS', 'News Export');
define('_AD_NEWS_EXPORT_NOTHING', "Sorry but there's nothing to export, please verify your criterias");
define('_AD_NEWS_PRUNE_DELETED', '%d news was deleted');
define('_AD_NEWS_PERM_WARNING', '<h2>Warning, you have 3 forms so you have 3 submit buttons</h2>');
define('_AD_NEWS_EXPORT_BETWEEN', 'Export news published between');
define('_AD_NEWS_EXPORT_AND', ' and ');
define('_AD_NEWS_EXPORT_PRUNE_DSC', "If you don't check anything then all the topics will be used<br/> else only the selected topics will be used");
define('_AD_NEWS_EXPORT_INCTOPICS', 'Include Topics Definitions ?');
define('_AD_NEWS_EXPORT_ERROR', 'Error while trying to create the file %s. Operation stopped.');
define('_AD_NEWS_EXPORT_READY', "Your xml export file is ready for download. <br /><a href='%s'>Click on this link to download it</a>.<br />Don't forget <a href='%s'>to remove it</a> once you have finished.");
define('_AD_NEWS_RSS_URL', "URL of RSS feed");
define('_AD_NEWS_NEWSLETTER', "Newsletter");
define('_AD_NEWS_NEWSLETTER_BETWEEN', 'Select News published between');
define('_AD_NEWS_NEWSLETTER_READY', "Your newsletter file is ready for download. <br /><a href='%s'>Click on this link to download it</a>.<br />Don't forget to <a href='%s'>remove it</a> once you have finished.");
define('_AD_NEWS_DELETED_OK',"File deleted successfully");
define('_AD_NEWS_DELETED_PB',"There was a problem while deleting the file");
define('_AD_NEWS_STATS0','Topics statistics');
define('_AD_NEWS_STATS','Statistics');
define('_AD_NEWS_STATS1','Unique Authors');
define('_AD_NEWS_STATS2','Totals');
define('_AD_NEWS_STATS3','Articles statistics');
define('_AD_NEWS_STATS4','Most read articles');
define('_AD_NEWS_STATS5','Less read articles');
define('_AD_NEWS_STATS6','Best rated articles');
define('_AD_NEWS_STATS7','Most read authors');
define('_AD_NEWS_STATS8','Best rated authors');
define('_AD_NEWS_STATS9','Biggest contributors');
define('_AD_NEWS_STATS10','Authors statistics');
define('_AD_NEWS_STATS11',"Articles count");
define('_AD_NEWS_HELP',"Help");
define("_AD_NEWS_MODULEADMIN","Module Admin");
define("_AD_NEWS_GENERALSET", "Module Settings" );
define('_AD_NEWS_GOTOMOD','Go to module');
define('_AD_NEWS_NOTHING',"Sorry but there's nothing to download, verify your criterias !");
define('_AD_NEWS_NOTHING_PRUNE',"Sorry but there's no news to prune, verify your criterias !");
define('_AD_NEWS_TOPIC_COLOR',"Topics's color");
define('_AD_NEWS_COLOR',"Color");
define('_AD_NEWS_REMOVE_BR',"Convert the html &lt;br&gt; tag to a new line ?");
// Added in 1.3 RC2
define('_AD_NEWS_PLEASE_UPGRADE',"<a href='upgrade.php'><font color='#FF0000'>Please upgrade the module !</font></a>");
?>