<script type="text/javascript">
   $(".brandUrl").click(function() {
        loadData(this.href, 'products_list'); return false;
    });
</script>
{[if $brands|@count gt 0 ]}
  {[foreach from=$brands item=brand]}
  <a class="brandUrl" href="{[$brand.url]}" > <img src="{[$brand.image_path]}" border="0" alt="{[$brand.name]}" /> </a> <br/>
  {[/foreach]}
{[else]}
    No brand for this category.
{[/if]}
