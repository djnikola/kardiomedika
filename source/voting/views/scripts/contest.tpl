<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/php.js"></script>
<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/json2.js"></script>
<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/jqueryui/jquery-ui-1.8.11.custom.min.js"></script>
<script type="text/javascript" src="{[$baseUrl]}scripts/java_scripts/flashmessenger/jquery.flashmessenger.js"></script>
<link rel="stylesheet" type="text/css" href="{[$baseUrl]}scripts/java_scripts/jqueryui/jquery-ui-1.8.11.custom.css" />
<link rel="stylesheet" type="text/css" href="{[$baseUrl]}scripts/java_scripts/flashmessenger/flashmessenger.css" />

<style>
#contest .left { float:left; margin-left:20px; }
#contest label { color:blue; font-size: 15px; }
</style>
<script type="text/javascript">

    $(document).ready(function(){
        $("#candidate a").click(function(){
            var candidateId = $(this).attr("data-id");
            loadCandidate(candidateId);
            return false;
        });
    });

    function getCandidateLink(id){
       return sprintf('/%s/voting/candidate/candidate_id/%d/', 'en', id);
    }

    function loadCandidate(id){
        $("#votingDialog").load(getCandidateLink(id), function() {
            //open dialog
            $(this).dialog({
                width:'auto',
                height:'auto',
                position:[200,50],
                modal:true,
                title:'Voting',
                resizable:false,
                buttons: {
                    "Senden": function() {
                        //save dialog_element
                        var data = jQuery('#form_candidate').serialize();
                        $.post(
                                jQuery('#form_candidate').attr('action'),
                                data,
                                function(data)
                                {
                                    var data = JSON.parse(data);
                                    if(data['success'])
                                    {
                                       var msg = data['message'];
                                       flashMessageAdd(msg, "ok", 500);
                                       jQuery("#votingDialog").dialog("close");
                                    }
                                    else
                                    {
                                       if(data['error']['message'])
                                       {
                                            var messages = data['error']['message'];
                                            for(var key in messages)
                                            {
                                                var error = messages[key];
                                                $("#errors").text(error);
                                            }
                                       }
                                    }
                                }
                        )
                        return false;
                    }
                }
            });
        });
    }

    /**
     * add flash message
     */
    function flashMessageAdd(message,messageType, time){
        if(undefined === time){
            time = 500;
        }
        $.flashMessenger(message,{
            clsName:messageType,
            modal:false,
            autoClose:true,
            position: "top",
            positionMargin: 50,
            wait:time
        });
    }

</script>
<div id="contest">
   {[foreach from=$candidates item=candidate]}
            <div class="left">
                <div id="candidate">
                    <a href="#" data-id="{[$candidate->get_id()]}" >
                        <img alt="first" src="{[$candidate->get_image_path()]}" />
                    </a>
                </div>
                <br />
                <a href="#" >
                    <label>>>info</label>
                </a>
            </div>
  {[/foreach]}
</div>
<div id="votingDialog" style="display:none;" title="Candidate" ></div>