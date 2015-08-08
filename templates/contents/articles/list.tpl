<form name="articles_list" action="index.php?section=articles&type={[$type]}&page_id={[$page_id]}" method="post" enctype="multipart/form-data">
<input type="hidden" name="data[page]" value="{[$PAGE]}" />
<h2>{[$articles_title]}</h2>
    <strong>{[$articles_content]}</strong>
    <br /><br /><br /><br />
	{[foreach from=$articles_list item=article]}
        {[include file="contents/articles/articles_list_element.tpl"]}
    {[/foreach]}


    {[if isset($no_result)]}
        <h3>{[$labels.no_results]}</h3>
    {[/if]}
    {[if $PAGES > 1]}
        <div class="paging" align="center">
        <input type="button" value=" &#171; " ONCLICK="elements['data[page]'].value='{[$PREV]}';submit();" class="button_paging">&nbsp;&nbsp;
        {[$labels.found]}: {[$TOTAL]},&nbsp;&nbsp; {[$labels.pages]} {[$PAGE]} {[$labels.of]} <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}, {[$labels.with]} {[$PER_PAGE]} {[$labels.per_page]}</span>
        &nbsp;&nbsp;<input type="button" value=" &#187; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_paging">
        </div>	
    {[/if]}                                
</form>
