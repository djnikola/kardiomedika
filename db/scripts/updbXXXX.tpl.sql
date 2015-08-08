INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updbXXXX.tpl.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: boris $',locate(':','$Author: boris $')+1)),     
trim(TRAILING '$' from substring('$Revision: 40 $',locate(':','$Revision: 40 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-01-27 12:26:57 +0100 (Fri, 27 Jan 2012) $',locate(':','$Date: 2012-01-27 12:26:57 +0100 (Fri, 27 Jan 2012) $')+1)),     
now()); 
