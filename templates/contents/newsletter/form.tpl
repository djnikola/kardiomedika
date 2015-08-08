<link rel="stylesheet" type="text/css" href="scripts/css/style.css" />
<style type="text/css">
    body{
        background: none;
        background-color: black;
    }
</style>

<table cellpadding="0" cellspacing="0" border="0" class="ticker_table">
                        	<tr>
                            	<td colspan="2"><h2>Newsletter </h2></td>
                            </tr>
                        	<tr>
                            	<td>
                                    {[if $show_form == 1]}
                                    <form  method="post" action="newsletter_form.php" enctype="multipart/form-data">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td valign="middle" align="left">
                                                    Vorname
                                                </td>
                                                <td valign="middle" align="right">
                                                    <input type="text" name="data[vorname]" value="{[if isset($smarty.request.data.vorname) && $smarty.request.data.vorname]}{[$smarty.request.data.vorname]}{[/if]}" class="_input" {[if isset($errors.vorname) && $errors.vorname == 1]}style="background-color:#F58C8C;"{[/if]}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle" align="left">
                                                    Name
                                                </td>
                                                <td valign="middle" align="right">
                                                    <input type="text" name="data[name]" value="{[if isset($smarty.request.data.name) && $smarty.request.data.name]}{[$smarty.request.data.name]}{[/if]}" class="_input" {[if isset($errors.name) && $errors.name == 1]}style="background-color:#F58C8C;"{[/if]}/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="middle" align="left">
                                                    Email
                                                </td>
                                                <td valign="middle" align="right">
                                                    <input type="text" name="data[email]" value="{[if isset($smarty.request.data.email) && $smarty.request.data.email]}{[$smarty.request.data.email]}{[/if]}" class="_input" {[if isset($errors.email) && $errors.email == 1]}style="background-color:#F58C8C;"{[/if]}/>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td valign="bottom" align="right" colspan="2" style="text-align: right;">
                                                    <input type="submit" align="right" name="" value="" class="ok_btn"/>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                    </form>
                                    {[else]}
                                    <h3>Thanks!</h3>
                                    {[/if]}
                                </td>
                            </tr>                                                     
                        
                        </table>


