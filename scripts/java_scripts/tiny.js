var tinyWin = null;
var tinyFieldName = null;
var webRoot = '';

function customFileBrowser(field_name, url, type, win) {
	// Do custom browser logic
	tinyWin = win;
	tinyFieldName = field_name;
//	if(field_name == "href"){
//		cmsLinkDialog("customCallback");
//	}
//	else
		mcFileManager.open("undefined","undefined","undefined",'customCallback');
}

function cmsLinkDialog(callback){
	window.open("http://www.trt.rs/admin/admin-cms-dialog.php?callback=" + callback,"CMS","height=300,width=500,scrollbars=yes,menubar=no,toolbar=no");
}

function fileBasename(path) {
	var slash = '/';
	if (path.match(/\\/)) {
		slash = '\\';
	}
	return path.substring(path.lastIndexOf(slash) + 1, path.lastIndexOf('.'));
}

function customCallback(path){
	if(path.indexOf(webRoot) == 0){
		var result = path.substr(webRoot.length);
	}
	else{
		var result = path;
	}

	tinyWin.document.forms[0].elements[tinyFieldName].value = result;
	if(tinyWin.document.forms[0].elements['alt'])
		tinyWin.document.forms[0].elements['alt'].value = fileBasename(path);
		
	if(tinyWin.document.forms[0].elements['vspace']){
		tinyWin.document.forms[0].elements['vspace'].value = 10;
		tinyWin.document.forms[0].elements['vspace'].onchange();
	}
	if(tinyWin.document.forms[0].elements['hspace']){
		tinyWin.document.forms[0].elements['hspace'].value = 10;
		tinyWin.document.forms[0].elements['hspace'].onchange();
	}

	tinyWin.focus();
}


function applyTiny(elements,webroot, swidth, sheight, lang, options){

    if(!swidth)		var swidth = 700;

	if(!sheight)	var sheight = 300;
	
    
    var valid_elms = "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style],img[href|src|name|title|onclick|align|alt|title|width|height|vspace|hspace],iframe[id|class|width|size|noshade|src|height|frameborder|border|marginwidth|marginheight|target|scrolling|allowtransparency],style[type|color] ";



    
	tinyMCE.init({
	
		// General options

        //inline_styles : true,
        verify_html : false,
		language: lang,
		mode : "exact",
		elements : elements,
		theme : "advanced",
		plugins : "filemanager,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
		// Theme options
		theme_advanced_buttons1 : "|,insertfile,insertimage,|,bold,italic,underline,strikethrough,cut,copy,|,styleselect,formatselect,|,justifyleft,justifycenter,justifyright,justifyfull|,bullist,numlist,sub,sup",
		theme_advanced_buttons2 : "paste,pastetext,pasteword,|,image,|,link,unlink,tablecontrols,|,removeformat",
		theme_advanced_buttons3 : "template,|,forecolor,backcolor,|,fullscreen,code,undo,redo,|",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        
        theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		 
		width : swidth,
		height: (options == null || options.height == null)? sheight:options.height,
		// Example content CSS (should be your site CSS)
		content_css : "../scripts/css/admin/editor_style.css",
        //valid_children : "+body[style]",
        //extended_valid_elements: valid_elms,
		 
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../scripts/java_scripts/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
		file_browser_callback: "customFileBrowser",
        relative_urls : false,
        //apply_source_formatting : false,
		document_base_url : webroot

		});
}

function applyMiniTiny(elements,webroot,swidth, sheight, options){
	if(!swidth){
		var swidth = 700;
	}
	if(!sheight){
		var sheight = 200;
	}
	tinyMCE.init({
		language : 'en',
		plugins : "safari,layer,preview,advlink,table,filemanager,paste,searchreplace,table,media,fullscreen,style",
		// PLUGIN ADVIMAGE
		
		plugin_preview_width : "300",
		plugin_preview_height : "200",
		
		theme : "advanced",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,
		
		theme_advanced_buttons1 : "paste,pastetext,pasteword,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo",
		theme_advanced_buttons2 : "link,unlink,code,styleselect,formatselect,insertfile",
		theme_advanced_buttons3 : "",
		
		relative_urls : (options == null || options.relative_urls == null)?true:options.relative_urls,
		remove_script_host : (options == null || options.remove_script_host == null)?false:options.remove_script_host,
		document_base_url : webroot,
		content_css : webroot + "../scripts/css/admin/editor_style.css",
		theme_advanced_statusbar_location : "bottom",
		
		width : swidth+'px',
		height: (options == null || options.height == null)? sheight+"px":options.height,
		debug : false,
		auto_reset_designmode : false, // ??
		button_tile_map : true, // ??
		auto_resize : false, //
		browsers : "msie,gecko,opera,safari", //
		dialog_type : "modal",
		mode : "exact",
		elements : elements,
		apply_source_formatting : true,
		file_browser_callback: "customFileBrowser",
		paste_auto_cleanup_on_paste: true,
		paste_use_dialog: false
	});
}