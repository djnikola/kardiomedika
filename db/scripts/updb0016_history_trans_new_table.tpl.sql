CREATE TABLE IF NOT EXISTS `history_trans` (
  `fk_history_id` int(11) NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `fk_history_id` (`fk_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0016_history_trans_new_table.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: miljan $',locate(':','$Author: miljan $')+1)),     
trim(TRAILING '$' from substring('$Revision: 138 $',locate(':','$Revision: 138 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $',locate(':','$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $')+1)),     
now()); 