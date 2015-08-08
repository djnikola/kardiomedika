<script type="text/javascript">
      $(".categoryUrl").click(function() {
            loadData(this.href, 'brand_list'); return false;
        });
</script>
{[if $brands|@count gt 0 ]}
  {[foreach from=$categorys item=category]}
  <a class="categoryUrl" href="{[$category.url]}" > {[$category.name]}</a> <br/>
  {[/foreach]}
{[else]}
    No category.
{[/if]}
