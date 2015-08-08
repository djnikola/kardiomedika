INSERT INTO `lang_table_admin` (
`lang_table_id` ,
`label` ,
`trans` ,
`lang`
)
VALUES (
NULL , 'location', 'Location', 'en'
);

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0004-artiles_cleanup.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: zeka $',locate(':','$Author: zeka $')+1)),     
trim(TRAILING '$' from substring('$Revision: 114 $',locate(':','$Revision: 114 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-09 10:56:56 +0100 (Thu, 09 Feb 2012) $',locate(':','$Date: 2012-02-09 10:56:56 +0100 (Thu, 09 Feb 2012) $')+1)),     
now()); 
