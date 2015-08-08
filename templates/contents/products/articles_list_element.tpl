<div class="event clearfix">
    <div class="col-2">
        {[if $article.image != '']} 
            <a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}"><img src="{[$baseUrl]}{[$article.image]}" alt="{[$article.caption]}"/></a>
        {[else]}
            <a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}"><img src="{[$baseUrl]}templates/images/no-image.png" alt="{[$article.caption]}"/></a>
        {[/if]}    
    </div>
    <div class="col-2 last">
    <h3>{[$article.caption]}</h3>
    <table class="event-data">
        <tr>
            <th>Datum</th>
            <td>{[$article.publish_date|date_format:"%d.%m.%y."]}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>Sporthalle Baden</td>
        </tr>
        <tr>
            <th>Highlights</th>
            <td>DJ xyz, DJ Frisco</td>
        </tr>
    </table>
    <a href="#" class="eventImages">Images</a>
    <a href="#" class="eventVideos">Videos</a>
    
    <p>{[$article.short_content]}</p>
    <a	href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}" class="more left">{[$labels.read_more]}</a>
    </div>
</div>
                                        

                