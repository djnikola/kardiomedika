<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="{[$baseUrl]}scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    
    /* Apply fancybox to multiple items */
	$("a.element").fancybox();    

});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="event_table">         
<tr>
	<td valign="top" class="image_holder">
		{[if $single_articles->image_thumbnail != '']}
		<a href="{[$baseUrl]}{[$single_articles->image]}" class="element" rel="Kardiomedika"  author="Kardiomedika" >
			<img src="{[$baseUrl]}{[$single_articles->image_thumbnail]}" alt="{[$single_articles->caption]}"/> 
		</a>
		{[else]}
			<img src="{[$baseUrl]}templates/images/no-image.png" alt="{[$single_articles->caption]}" />
		{[/if]}
	</td>
	<td class="caption_holder">
		<h2>{[$single_articles->caption]}</h2>

		<div class="fb-like" data-href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}" data-send="true" data-width="450" data-show-faces="false"></div>
		<!-- <a	href="{[articles_seo_url articles_id=$new.articles_id title=$new.caption type=$new.articles_type]}">{[$labels.read_more]}</a>-->
	</td>
</tr>
<tr>
	<td colspan="2" class="content_holder">
		{[$single_articles->content]}
	</td>
</tr>
</table>
