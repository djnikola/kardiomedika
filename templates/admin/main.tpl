<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>{[$labels.administration_panel]}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Admin panel"/>
    <meta name="keywords" content="Admin panel"/>
   
    
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="icon" href="favicon.ico" type="image/ico"/>
    <link rel="stylesheet" href="../scripts/css/admin/style.css" type="text/css" />
    
    <link rel="stylesheet" href="../scripts/css/snippets.css" type="text/css" />
    
    <script type="text/javascript" src="../scripts/java_scripts/common.js"></script>

 <!-- dhtmlgoodies_calendar -->
    <script type="text/javascript" src="../scripts/java_scripts/dhtmlgoodies_calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="../scripts/css/admin/dhtmlgoodies_calendar.css"/>

    <script type="text/javascript" src="../scripts/java_scripts/jquery.js"></script>

</head>

<body id="{[$section]}">

<div id="wrapper">
    
    <!-- Central content controled by modules -->
	<div class="content clearfix ">
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
    {[checkUserPrivileges permission=permission section=$section subsection=$subsection]}
    {[if isset($smarty.session.loged) && $smarty.session.loged == 1 && $permission]}
    <tr>
    <td  class="_left">
    	
			{[if isset($smarty.session.loged) && $smarty.session.loged == 1]}
			<div class="menu_holder">
				{[foreach from=$menu item=menuitem]}
					{[if $smarty.session.user.group == $menuitem.user_group]}
					<ul>
						<li><a href="{[$menuitem.link]}">{[$menuitem.caption]}</a></li>
					</ul>
					{[/if]}
				{[/foreach]}
			</div>

			{[/if]}
       
    </td>
    <td class="_main">  
       	
        	
            	<div class="toolbar">
                	{[if isset($smarty.session.loged) && $smarty.session.loged == 1]}
                	{[$labels.you_are_loged_as]}: <strong>{[$smarty.session.user.username]}</strong>
                    <div class="logout"><a href="index.php?navi=login&subnavi=logout">Logout</a></div>
					{[/if]}
                </div>
                
                <div class="inner">
                
                    {[if isset($errors)]}
				    <div class="messages_errors">
				    	{[foreach from=$errors item=error]}
				    	<span>{[$error]}</span><br />
				    	{[/foreach]}
				    </div>
				    {[/if]}
				    
				    {[if isset($notices)]}
				    <div class="messages_notices">
				    	{[foreach from=$notices item=notice]}
				    	<span>{[$notice]}</span><br />
				    	{[/foreach]}
				    </div>
				    {[/if]}
                
                
					{[include file="$template"]}
					
                </div>

        </td>
        </tr>
       
		{[else]}
		<tr>
		<td>
			{[if isset($errors)]}
		    <div class="messages_errors">
		    	{[foreach from=$errors item=error]}
		    	<span>{[$error]}</span><br />
		    	{[/foreach]}
		    </div>
		    {[/if]}
		    
		    {[if isset($notices)]}
		    <div class="messages_notices">
		    	{[foreach from=$notices item=notice]}
		    	<span>{[$notice]}</span><br />
		    	{[/foreach]}
		    </div>
		    {[/if]}
		    
			{[include file="$template"]}
		</td>
		</tr>
		{[/if]}
		
    </table>

    </div>
    
    <!-- Footer -->       
    <div class="footer">
    	        
		<div class="footer_address">
			 Copyright &copy; <a href="http://www.kardiomedika.com" target="_target">Kardiomedika {[$current_year]}</a>
        </div>      
	</div>
		
</div>

</body>
</html>


