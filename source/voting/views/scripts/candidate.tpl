<!--<?php
    $this->headLink()->appendStylesheet('/plugins/jqueryui/jquery-ui-1.8.11.custom.css');
?>-->
<style>
#candidate .left { float:left; }
#candidate .right { float:right;margin-left:20px; }
#candidate .blue { color:blue; }
</style>
<div id="candidate">
    <form id="form_candidate" name="form_candidate"  action="http://fb.frisco/en/voting/vote/" method="post" >
        <div class="left">
            <img alt="first" src="{[$candidate->get_image_path()]}" />
        </div>
        <div class="right">
            <input type="hidden" name="data[candidate]" value="{[$candidate->get_id()]}" />
            <h3>Vote fur dein Glace</h3>
            <span>Trage bitte deine Mailaddrese ein und bestatige den link weicher Du per Email erhalst</span>
            <br />
            <br />
            <a><span class="blue">Vielen Dank</span></a>
            <br />
            <br />
            <input type="text" name="data[email]" value="" />
            <br />
            <span id="errors" style="color:red;font-size: 11px;"></span>
        </div>
    </form>
</div>
