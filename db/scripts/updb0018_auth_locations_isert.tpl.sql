INSERT INTO `frisco`.`auth_locations` (
`loc_id` ,
`fk_group_id` ,
`section` ,
`sub_section` ,
`value`
)
VALUES (NULL , '1', 'history', 'new', '1');

INSERT INTO `frisco`.`auth_locations` (
`loc_id` ,
`fk_group_id` ,
`section` ,
`sub_section` ,
`value`
)
VALUES (NULL , '1', 'history', 'list', '1');

INSERT INTO `frisco`.`auth_locations` (
`loc_id` ,
`fk_group_id` ,
`section` ,
`sub_section` ,
`value`
)
VALUES (NULL , '1', 'history', 'delete', '1');


INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0018_auth_locations_isert.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: miljan $',locate(':','$Author: miljan $')+1)),     
trim(TRAILING '$' from substring('$Revision: 138 $',locate(':','$Revision: 138 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $',locate(':','$Date: 2012-02-14 15:36:57 +0100 (Tue, 14 Feb 2012) $')+1)),     
now()); 