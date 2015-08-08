<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: '/{[$CURR_LANG]}/products/category-list/',
            dataType: "html",
            success: function(data, textStatus, responseObject) {
                $(data).appendTo($("#content").find("#category_list"));
            }
        });
        $.ajax({
            url: '/{[$CURR_LANG]}/products/brand-list/category_id/1/',
             dataType: "html",
            success: function(data, textStatus, responseObject) {
                $(data).appendTo($("#content").find("#brand_list"));
            }
        });
        $.ajax({
            url: '/{[$CURR_LANG]}/products/product-list/brand_id/1/type/togo/',
            dataType: "html",
            success: function(data, textStatus, responseObject) {
                $("#content").find("#products_list").html(data);
            }
        });
        $.ajax({
            url: '/{[$CURR_LANG]}/products/product-view/id/1/',
            dataType: "html",
            success: function(data, textStatus, responseObject) {
                $("#content").find("#product_view").html(data);
            }
        });
    });
    
    function loadData(link, placeholder){
        if (-1 === link.indexOf('/type/') && -1 === link.indexOf('format=html')) {
            link += 'type/'+$("#type").val() + '/' ;
        }
        jQuery.get(link, function(data) {
            var container = '#' + placeholder;
            jQuery(container).html(data);
            return false;
        });
    }
</script>
<div id="content">
    <div id="category_list"></div>
    <div id="brand_list" style="float:left;display: block;width: 120px;height: 700px;margin-right: 50px;border-width: 1px;border-color: #0C3070"></div>
    <div id="product_view" style="width: 600px;float: left;"></div>
    <div id="products_list"></div>
</div>