--
-- This SQL is update news V1.3 to v1.44
-- Run at once by modules/news/admin/sqlupdate.php
-- by www.bluemooninc.biz

ALTER TABLE __PREFIX__topics ADD INDEX `topic_title` (`topic_title`);
ALTER TABLE __PREFIX__topics ADD INDEX `menu` (`menu`);

