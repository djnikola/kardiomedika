
<div class="event clearfix">
    <div class="col-1">
        {[if $article.image != '']} 
            <a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}"><img src="{[$baseUrl]}{[$article.image]}" alt="{[$article.caption]}"/></a>
        {[else]}
            <a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}"><img src="{[$baseUrl]}templates/images/no-image.png" alt="{[$article.caption]}"/></a>
        {[/if]}    
    </div>
    <div class="col-2">
    <h3>{[$article.caption]}</h3>
    <table class="event-data">
        <tr>
            <th align="left" width="70">{[$labels.date]}:</th>
            <td>{[$article.publish_date|date_format:"%d.%m.%Y."]}</td>
        </tr>
        <tr>
            <td colspan="2">{[$article.content|truncate:140:"...":true]}</td>
        </tr>
    </table>
    
			<a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}" class="more left"> &raquo; {[$labels.read_more]}</a>
    </div>
    
    <div class="fb-like" data-href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}" data-send="true" data-width="450" data-show-faces="false"></div>
</div>
                                        

                