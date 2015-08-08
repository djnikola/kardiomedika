<script type="text/javascript">
    $(".productUrl").click(function() {
        loadData(this.href, 'product_view'); return false;
    });
</script>
{[if $products|@count gt 0 ]}
  {[foreach from=$products item=product]}
  <a class="productUrl" href="{[$product.url]}" > <img border="0" src="{[$product.image_path]}" alt="{[$product.name]}" /> </a>
  {[/foreach]}
{[else]}
    No products for this brand.
{[/if]}
