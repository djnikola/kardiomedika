<?php

$right = '';
$left = '';
$dinamicInclude = '';

switch ($subsection){
		
	default:
   
    /*heandling videos*/
		$videos = array();
        $video_for_channal = "http://gdata.youtube.com/feeds/api/users/djfabschweiz/uploads";
        $results = simplexml_load_file($video_for_channal);

        foreach ($results->entry as $entry) {

            list($tag, $vid) = explode("videos/", $entry->id);
            $videos[$vid]['id'] = $vid;
        }
        
        $video_chunks = array_chunk($videos, 4);
		$num_chunks = count($video_chunks)
        ;
        
        $smarty->assign("video_chunks", $video_chunks);
		$template = "media/media.tpl";
				
		break;
}

?>