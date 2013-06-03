--
-- This SQL is update news V1.10 or news_fileup V1.15 to v1.44
-- Run at once by modules/news/admin/sqlupdate.php
-- by www.bluemooninc.biz
#
# for update stories
#
ALTER TABLE __PREFIX__stories ADD keywords varchar(255) NOT NULL AFTER bodytext;
ALTER TABLE __PREFIX__stories ADD description varchar(255) NOT NULL AFTER keywords;
ALTER TABLE __PREFIX__stories ADD rating double(6,4) NOT NULL default '0.0000' AFTER comments;
ALTER TABLE __PREFIX__stories ADD votes int(11) unsigned NOT NULL default '0' AFTER rating;
#
# for update topics
#
ALTER TABLE __PREFIX__topics ADD menu tinyint(1) NOT NULL default '0' AFTER topic_title;
ALTER TABLE __PREFIX__topics ADD topic_frontpage tinyint(1) NOT NULL default '1' AFTER menu;
ALTER TABLE __PREFIX__topics ADD topic_rssurl varchar(255) NOT NULL default '' AFTER topic_frontpage;
ALTER TABLE __PREFIX__topics ADD topic_description text NOT NULL AFTER topic_rssurl;
ALTER TABLE __PREFIX__topics ADD topic_color varchar(6) NOT NULL default '000000' AFTER topic_description;
ALTER TABLE __PREFIX__topics ADD INDEX `topic_title` (`topic_title`);
ALTER TABLE __PREFIX__topics ADD INDEX `menu` (`menu`);
#
# Table structure for table `stories_files`
#
CREATE TABLE __PREFIX__stories_files (
  fileid int(8) unsigned NOT NULL auto_increment,
  filerealname varchar(255) NOT NULL default '',
  storyid int(8) unsigned NOT NULL default '0',
  date int(10) NOT NULL default '0',
  mimetype varchar(64) NOT NULL default '',
  downloadname varchar(255) NOT NULL default '',
  counter int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (fileid),
  KEY storyid (storyid)
) TYPE=MyISAM;
#
# Table structure for table `stories_votedata`
#
CREATE TABLE __PREFIX__stories_votedata (
  ratingid int(11) unsigned NOT NULL auto_increment,
  storyid int(8) unsigned NOT NULL default '0',
  ratinguser int(11) NOT NULL default '0',
  rating tinyint(3) unsigned NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingtimestamp int(10) NOT NULL default '0',
  PRIMARY KEY  (ratingid),
  KEY ratinguser (ratinguser),
  KEY ratinghostname (ratinghostname),
  KEY storyid (storyid)
) TYPE=MyISAM;
