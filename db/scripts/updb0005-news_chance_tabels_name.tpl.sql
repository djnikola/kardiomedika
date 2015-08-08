RENAME TABLE `news` TO `articles` ;

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0005-news_chance_tabels_name.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: miljan $',locate(':','$Author: miljan $')+1)),     
trim(TRAILING '$' from substring('$Revision: 135 $',locate(':','$Revision: 135 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-14 13:17:03 +0100 (Tue, 14 Feb 2012) $',locate(':','$Date: 2012-02-14 13:17:03 +0100 (Tue, 14 Feb 2012) $')+1)),     
now()); 

