<?php
// dumper($labels);exit;
$admin_menu_links = array(

        
            '1' => array
            (
                'id' => '1',
                'parent' => 0,
                'level' => 0,
                'type' => 'functionality',
                'caption' =>  $labels['pages'],
                'link' => '?section=pages&subsection=list', 
                'default_page' => '0',
                'ordering' => '1',
                'section' => 'pages',
                'user_group' => '1',

            ),
 


        '2' => array
            (
                'id' => '2',
                'parent' => 0,
                'level' => 0,
                'type' => 'functionality',
                'caption' => $labels['events'],
                'link' => '?section=articles&subsection=list', 
                'default_page' => '0',
                'ordering' => '2',
                'section' => 'events',
                'user_group' => '1'
            ),
    
    '3' => array
            (
                'id' => '3',
                'parent' => 0,
                'level' => 0,
                'type' => 'functionality',
                'caption' =>  $labels['users'],
                'link' => '?section=users&subsection=list', 
                'default_page' => '0',
                'ordering' => '1',
                'section' => 'users',
                'user_group' => '1',

            ),
    '4' => array
            (
                'id' => '4',
                'parent' => 0,
                'level' => 0,
                'type' => 'functionality',
                'caption' =>  $labels['gallery'],
                'link' => '?section=gallery&subsection=list_gallery', 
                'default_page' => '0',
                'ordering' => '1',
                'section' => 'gallery',
                'user_group' => '1',

            ),
	'5' => array
            (
                'id' => '5',
                'parent' => 0,
                'level' => 0,
                'type' => '',
                'caption' =>  'Uputstvo',
                'link' => '../uploads/files/UputstvoKardioMedika.pdf', 
                'default_page' => '0',
                'ordering' => '100',
                'section' => '',
                'user_group' => '1',

            ),
	  
);


?>