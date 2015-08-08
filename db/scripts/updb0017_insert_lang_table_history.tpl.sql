INSERT INTO `frisco`.`lang_table` (
`lang_table_id` ,
`label` ,
`trans` ,
`lang`
)
VALUES (NULL , 'history', 'History', 'en');

INSERT INTO `frisco`.`lang_table` (
`lang_table_id` ,
`label` ,
`trans` ,
`lang`
)
VALUES (NULL , 'history', 'Geschichte', 'de');

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0017_insert_lang_table_history.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: miljan $',locate(':','$Author: miljan $')+1)),     
trim(TRAILING '$' from substring('$Revision: 138 $',locate(':','$Revision: 138 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $',locate(':','$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $')+1)),     
now()); 