<script type="text/javascript">
    $("#type").change(function() {
        loadData('<?php echo $this->product_url ;?>/type/'+this.value, 'products_list'); return false;
    });
</script>
<div >
    
     <h4>{[$single_products->name]} </h4>
    {[if $single_products->type != '']}
        <select name="type" id="type">
            <option value="togo">To-go</option>
            <option value="home">Home</option>
        </select>
    {[/if]}<br/>
    <img src="{[$single_products->image_path]}" />
    <p>{[$single_products->description]}</p>
</div>