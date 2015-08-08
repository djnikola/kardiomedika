CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) CHARACTER SET utf8 NOT NULL,
  `create_date` datetime NOT NULL,
  `publish_date` datetime NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0015_history_new_table.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: miljan $',locate(':','$Author: miljan $')+1)),     
trim(TRAILING '$' from substring('$Revision: 135 $',locate(':','$Revision: 135 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-14 13:17:03 +0100 (Tue, 14 Feb 2012) $',locate(':','$Date: 2012-02-14 13:17:03 +0100 (Tue, 14 Feb 2012) $')+1)),     
now()); 


