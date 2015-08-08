ALTER TABLE `articles` DROP `deleted` ;
ALTER TABLE `articles` DROP `create_date`;
ALTER TABLE `articles_trans` DROP `meta_title` ,
DROP `meta_keywords` ,
DROP `meta_description` ;



INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0002-articles_change_tabe_structure.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: boris $',locate(':','$Author: boris $')+1)),     
trim(TRAILING '$' from substring('$Revision: 93 $',locate(':','$Revision: 93 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-06 15:39:16 +0100 (Mon, 06 Feb 2012) $',locate(':','$Date: 2012-02-06 15:39:16 +0100 (Mon, 06 Feb 2012) $')+1)),     
now()); 
