ALTER TABLE `page_trans` ADD `permalink` VARCHAR( 255 ) NOT NULL AFTER `fk_page_id`;
ALTER TABLE `page` ADD `request_params` VARCHAR( 255 ) NULL DEFAULT NULL AFTER `class`;

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0005-permalink.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: boris $',locate(':','$Author: boris $')+1)),     
trim(TRAILING '$' from substring('$Revision: 122 $',locate(':','$Revision: 122 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-10 11:42:00 +0100 (Fri, 10 Feb 2012) $',locate(':','$Date: 2012-02-10 11:42:00 +0100 (Fri, 10 Feb 2012) $')+1)),     
now()); 
