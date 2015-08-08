CREATE TABLE IF NOT EXISTS `voting_trans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` char(5) NOT NULL,
  `section` varchar(20) DEFAULT NULL,
  `key` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_trans` (`language`,`section`,`key`(100)),
  KEY `language` (`language`,`section`)
);

INSERT INTO upgrade_db_log (
    file,
    username,
    revision,
    repos_dt,
    insert_dt
)
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0007-module_trans.sql $'),'/',-1),
trim(TRAILING '$' from substring('$Author: zeka $',locate(':','$Author: zeka $')+1)),
trim(TRAILING '$' from substring('$Revision: 127 $',locate(':','$Revision: 127 $')+1)),
trim(TRAILING '$' from substring('$Date: 2012-02-13 16:20:49 +0100 (Mon, 13 Feb 2012) $',locate(':','$Date: 2012-02-13 16:20:49 +0100 (Mon, 13 Feb 2012) $')+1)),
now());
