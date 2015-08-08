<script type="text/javascript" src="scripts/java_scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
function openSection(container, section_id){
	var containerDiv = document.getElementById(container);
	 
	if (containerDiv.hasChildNodes()) {
		// Get all children of node
		var children = containerDiv.childNodes;               

		// Loop through the children
		for(var c=0; c < children.length; c++) {
			if(children[c].style) {
				if(children[c].id == section_id){
					children[c].style.display = 'block';
				}else{
					children[c].style.display = 'none';
				}
			}
	     }
	 }
}

$(document).ready(function() {
    
    /* Apply fancybox to multiple items */
	$("a.grouped_elements").fancybox();    

});


</script>

         	<div class="content clearfix">
           
                <div class="ct_2_top">
                </div>
                <div class="ct_2_content">
                    <h2 name="videos">VIDEOS</h2>

                    <div id="media_video_container">
                        {[foreach from=$video_chunks key=vk  item=chunk]} 
                            <div class="media_video_box" id="media_video_box_{[$vk]}" {[if $vk == 0]}style="display:block;"{[else]}style="display:none;"{[/if]}>
                            {[foreach from=$chunk key=k item=vid]} 
                               <div class="video_clip_2">
                                    <iframe width="360" height="230" src="http://www.youtube.com/embed/{[$vid.id]}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            {[/foreach]}
                            </div>
                        {[/foreach]}
                    </div>
                    
                    <div class="special_paging clearfix">
                        {[foreach from=$video_chunks key=vk  item=chunk]} 
                    	<a href="#videos" class="paging_count_btn" onclick="openSection('media_video_container','media_video_box_{[$vk]}')">{[$vk]}</a>
                        {[/foreach]}
                    </div>                  
                </div>
                <div class="ct_2_bottom">
                </div>
                
                <!-- media videos -->
                
                
                <br /><br />
            	
                                
            </div>


		