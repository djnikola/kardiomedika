<div class="event clearfix">
    <div class="col-2">
        {[if $history.image != '']} 
            <img src="{[$baseUrl]}{[$history.image]}" alt="{[$history.caption]}"/>
        {[else]}
            <img src="{[$baseUrl]}templates/images/no-image.png" alt="{[$history.caption]}"/>
        {[/if]}    
    </div>
    <div class="col-2 last">
    <h3>{[$history.caption]}</h3>
    <table class="event-data">
<!--        <tr>
            <th>Datum</th>
            <td>{[$history.create_date|date_format:"%d.%m.%y."]}</td>
        </tr>-->
        <tr>
<!--            <th>Location</th>-->
            <td width="">{[$history.content]}</td>
        </tr>
<!--        <tr>
            <th>Highlights</th>
            <td>Noooooo</td>
        </tr>-->
    </table>
<!--    <a href="#" class="eventImages">Images</a>
    <a href="#" class="eventVideos">Videos</a>-->
    
    </div>
    
<!--    <div class="fb-like" data-href="{[articles_seo_url historys_id=$history.history_id title=$history.caption type=$history.history_type]}" data-send="true" data-width="450" data-show-faces="false"></div>-->

</div>
                                        

                