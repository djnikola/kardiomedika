INSERT INTO `lang_table_admin` (`lang_table_id`, `label`, `trans`, `lang`) VALUES (NULL, 'main_navigation', 'Main Navigation', 'en'), (NULL, 'main_navigation', 'Hauptnavigation', 'de');
INSERT INTO `lang_table_admin` (`lang_table_id`, `label`, `trans`, `lang`) VALUES (NULL, 'footer_links', 'Footer Links', 'en'), (NULL, 'footer_links', 'Footer Links', 'de');
INSERT INTO `lang_table_admin` (`lang_table_id`, `label`, `trans`, `lang`) VALUES (NULL, 'visible_in_menus', 'Visible in menus', 'en'), (NULL, 'visible_in_menus', 'Sichtbar in Menüs', 'de');

INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0019_admin_translation_labels.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: boris $',locate(':','$Author: boris $')+1)),     
trim(TRAILING '$' from substring('$Revision: 140 $',locate(':','$Revision: 140 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-16 22:46:50 +0100 (Thu, 16 Feb 2012) $',locate(':','$Date: 2012-02-16 22:46:50 +0100 (Thu, 16 Feb 2012) $')+1)),     
now()); 