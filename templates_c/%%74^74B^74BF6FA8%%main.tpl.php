<?php /* Smarty version 2.6.26, created on 2015-01-26 00:55:22
         compiled from static_content/en/main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'static_content/en/main.tpl', 212, false),array('modifier', 'strip_tags', 'static_content/en/main.tpl', 222, false),array('modifier', 'truncate', 'static_content/en/main.tpl', 222, false),array('function', 'special_articles', 'static_content/en/main.tpl', 213, false),array('function', 'articles_seo_url', 'static_content/en/main.tpl', 224, false),)), $this); ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $this->_tpl_vars['meta_title']; ?>
</title>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/css/kardiomedika.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/css/gallery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/nivo-slider-theme/default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/css/nivo-slider.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/css/ui-lightness/jquery-ui-1.8.7.custom.css" media="screen" />

    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/jqueryui/jquery-ui-1.8.11.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/highcharts.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/dhtmlgoodies_calendar.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/jquery-ui-1.8.7.date-picker.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="<?php echo $this->_tpl_vars['meta_description']; ?>
"/>
    <meta name="keywords" content="<?php echo $this->_tpl_vars['meta_keywords']; ?>
"/>
    <meta name="author" content="Codespeed"/>
	
    <link href="<?php echo $this->_tpl_vars['baseUrl']; ?>
favicon.ico" rel="icon" type="image/x-icon" />
    <script type="text/javascript">
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
	  
	  $(window).load(function() {
		//{manualAdvance:true}
                $('#slider').nivoSlider();
            });
		
		
	
	$(function() {
		$( "#accordion_1" ).accordion();
	});
	
	$(function() {
		$( "#accordion > ul > li > a" ).click(function(){
		if(false == $(this).next().is(':visible')) {
			$('#accordion ul > ul').slideUp(300);
		}
		$(this).next().slideToggle(300);
		});
	});
	
	$(function() {
		$( "#content_accordion > ul > li > h4" ).click(function(){
		if(false == $(this).next().is(':visible')) {
			$('#content_accordion ul > ul').slideUp(300);
		}
		$(this).next().slideToggle(300);
		});
	});
	
	
var min=14;
var max=20;
function increaseFontSize() {
 
   var p = document.getElementsByTagName('p');
   for(i=0;i<p.length;i++) {
 
      if(p[i].style.fontSize) {
         var s = parseInt(p[i].style.fontSize.replace("px",""));
      } else {
 
         var s = 15;
      }
      if(s!=max) {
 
         s += 1;
      }
      p[i].style.fontSize = s+"px"
 
   }
}
function decreaseFontSize() {
   var p = document.getElementsByTagName('p');
   for(i=0;i<p.length;i++) {
 
      if(p[i].style.fontSize) {
         var s = parseInt(p[i].style.fontSize.replace("px",""));
      } else {
 
         var s = 15;
      }
      if(s!=min) {
 
         s -= 1;
      }
      p[i].style.fontSize = s+"px"
 
   }
}

    </script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.blink').each(function() {
            var elem = $(this);
            setInterval(function() {
                elem.hide().fadeIn(500);
            }, 1000);
        });
    });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55395318-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<header>
    
        <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
en/" id="logo">KardioMedika</a>
		<a href="http://www.vitaphone.de/en" target="_blank" id="vitaphone">Vitafone</a>
        <nav class="main-menu">
            <?php echo $this->_tpl_vars['menu']; ?>

        </nav>
</header>

<section class="content clearfix">
    <div class="subtop"></div>
    <div class="subcontent clearfix">
		<div class="col_1 clearfix">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contents/".($this->_tpl_vars['template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<div class="col_2">
                        <div style="text-align: center;">
                                <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
sr/"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/serbia_round_icon_64.png" alt="serbia flag" /></a> 
                                <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
en/"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/united_kingdom_round_icon_64.png" alt="serbia flag" /></a>
                        </div>
			<div class="phones">
				<h2><?php echo $this->_tpl_vars['labels']['contact_phone']; ?>
</h2>
				<div class="phone_number"><span><?php echo $this->_tpl_vars['labels']['phone']; ?>
:</span>018/ 4257 213</div>
				<div class="phone_number"><span><?php echo $this->_tpl_vars['labels']['cell']; ?>
:</span>064 860 91 41</div> 
				<br /><hr />
			</div>
			<div>
				<a href="javascript:decreaseFontSize();">A-</a> 
				<a href="javascript:increaseFontSize();">A+</a>
			</div>
                        <br/><br/>
                        <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/electronic-medical-record">
                            <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/zdravstveni-elektronski-karton-logo.jpg" alt="Zdravstveni elektronski karton" />
                        </a>
                        <br/><br/>
			<h3>Internal medicine</h3>
			<div id="accordion">	
			<?php echo $this->_tpl_vars['side_menu_internal_medicine']; ?>

			</div>
                        <br/>
			<h3>Pediatrics</h3>
                        <div id="accordion">
                        <?php echo $this->_tpl_vars['side_menu_pediatrics']; ?>

			</div>
                        <h3>Neurology</h3>
                        <div id="accordion">
                        <?php echo $this->_tpl_vars['side_menu_neurology']; ?>

                        </div>
                        <h3>Psychiatry</h3>
                        <div id="accordion">
                       <?php echo $this->_tpl_vars['side_menu_psychiatry']; ?>

                        </div>
			<br />
			<hr />
			<h3>Tests</h3>
			<div >
				<div class="acc_like_element">
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/blood-pressure-tracker"><p>Blood pressure tracker</p></a>
				</div>
			</div>
	
			<div >
				<div class="acc_like_element">
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/basal-metabolism"><p>Basal metabolism</p></a>
				</div>
			</div>
			<div>
				<div class="acc_like_element">
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/body-mass-index"><p>Body Mass Index</p></a>
				</div>
			<div>
				<div class="acc_like_element">
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
e_toolkit.zip"><p>Risk factors (installation)</p></a>
				</div>
			</div>
				
			</div>
				
			<br />
			<hr />
                        <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['labels']['news'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</h3>
			<?php echo special_articles(array('type' => 'news','count' => 5), $this);?>

			<?php if (count ( $this->_tpl_vars['costum_articles_list'] ) > 0): ?>
			<?php $_from = $this->_tpl_vars['costum_articles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
                                <?php if ($this->_tpl_vars['article']['articles_id'] == 35): ?>
                                
                                <div class="blink" style="float:right; color:red; font-weight: bold; font-size: 20px;"><?php echo $this->_tpl_vars['labels']['important']; ?>
</div>
                                <br />
                                <?php endif; ?>
				<h4><?php echo $this->_tpl_vars['article']['caption']; ?>
</h4>
				<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['article']['content'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100, "...", true) : smarty_modifier_truncate($_tmp, 100, "...", true)); ?>

                                <br />
                                <a href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
" class="more left"> &raquo; <?php echo $this->_tpl_vars['labels']['read_more']; ?>
</a>
                                <br />                                
                                <br />
                                <br />
			<?php endforeach; endif; unset($_from); ?>
				<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/vesti">&raquo; <?php echo $this->_tpl_vars['labels']['all_news']; ?>
</a>
				<br /><br />
			<?php endif; ?>
			
			<div >
				<div class="acc_like_element">
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/prijatelji-kardiomedike"><p>Prijatelji Kardiomedike</p></a>
				</div>
			</div>
				
			<div class="sponsors_logos">
				<a href="http://www.bgbitaliana.rs" target="_blank"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
uploads/sponsors/esi-logo.jpg" width="100"/></a><br />
				<a href="http://www.hemofarm.com/" target="_blank"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
uploads/sponsors/svakodobro.jpg" width="100"/></a><br /><br />
				<a href="http://www.advancedsoftware.rs/" target="_blank"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
uploads/sponsors/advanced_software_150.png" width="150"/></a><br /><br/>
				<a href="http://heart.co.rs/index_sr.htm/" target="_blank"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
uploads/sponsors/heart.jpg" width="80"/></a><br />
			</div>

        </div>
    </div>
    <div class="push"></div>
</section>
			
<footer>
    <aside class="wrap">
        
        <div class="foot_info">
        <h3>INTERNAL MEDICINE - NEUROLOGY - PEDIATRICS - PSYCHIATRY</h3>
            <ul>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/home">Home</a></li>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/about-us">About us</a></li>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/our-services">Our services</a></li>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/telemedicine">Telemedicine</a></li>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/ultrasound">Ultrasound</a></li>
                <li><a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/online_appointments">Online appointments</a></li>
            </ul>
            <br />
            <address>
                <p>&copy; 2011 Kardiomedika.com  Vojvode Mišića boj 58, lokal 1, Niš, 018/4257 213; 063/ 80 55 456 <br />
                    <a href="mailto:kardiomedika@open.telekom.rs?subject=Kontakt preko Web Sajta">kardiomedika@open.telekom.rs</a>
                </p>
            </address>
        </div>
        
        <a href="#" id="foot_logo">KardioMedika</a>
    
        <div class="foot_social">
            <ul class="social">
                <li><a href="https://www.facebook.com/Kardiomedika" class="socFB" target="_blank">Facebook</a></li>
                <li><a href="#" class="socTW">Twitter</a></li>
                <li><a href="http://www.youtube.com/watch?v=4MT7VVJqvsQ" target="_blank" class="socYT">YouTube</a></li>
            </ul>
        </div>
    </aside>
</footer>
</body>
</html>