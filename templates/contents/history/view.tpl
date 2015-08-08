<div class="wrap">

    <table cellpadding="0" cellspacing="0" border="0" class="ticker_table">         
    <tr>
        <td>
            {[if $single_history->image != '']} 
                <img src="{[$baseUrl]}{[$single_historys->image]}" alt="{[$single_history->caption]}"/> 
            {[else]}
                <img src="{[$baseUrl]}templates/images/no-image.png" alt="{[$single_history->caption]}" />
            {[/if]}
        </td>
        <td>
            <h2>{[$single_history->caption]}</h2>
            <h2 class="_history_color">{[$single_history->publish_date|date_format:"%d.%m.%y"]}</h2>
            <p>
                {[$single_history->location]}<br />
                {[$single_history->highlights]}<br />
            </p>
            <br />
            {[$single_history->content]}
            
            <br /><br />
            <div class="fb-like" data-href="{[articles_seo_url articles_id=$article.articles_id title=$article.caption type=$article.articles_type]}" data-send="true" data-width="450" data-show-faces="false"></div>
            <!-- <a	href="{[articles_seo_url articles_id=$new.articles_id title=$new.caption type=$new.articles_type]}">{[$labels.read_more]}</a>-->
        </td>
    </tr>
    </table>
</div>