<?php /* Smarty version 2.6.26, created on 2015-03-01 22:54:01
         compiled from ../templates/static_content/en/home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'special_gallery_pictures', '../templates/static_content/en/home.tpl', 36, false),)), $this); ?>
<!-- NIVO SLIDER -->
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">
		<!-- <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/poliklinika-kardiomedika.jpg" alt="" title="Poliklinika Kardio Medika" /> -->
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/kardiomedika-10-godina.jpg" alt="KardioMedika 10 years" title="10 years of Kardiomedika" />
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/eeg-aparat.jpg" alt="Erg aparat" title="EEG- electroencephalography for children and adults." />
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/dobrodosli-kardiomedika.jpg" alt="Kardio Medika" title="Welcome" />
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/cekaonica-kardiomedika.jpg" alt="Kardio Medika čekaonica" title="Čekaonica Kardio Medika." />
                <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/04_slider.jpg" alt="" title="Ultrazvučni aparat poslednje generacije" /> 
		<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/ultra-zvucna-dijagnostika.jpg" alt="Dijagnostika u vašem domu" title="Kompletna ultrazvučna dijagnostika u Vašem domu" />
		<!--<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/savremena-oprema-kardiomedika.jpg" alt="Savremena medicinska oprema" title="" /> -->
		<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/stres-ehokardiografski-test.jpg" alt="Test opterećenja" title="Stres ehokardiografski test" />
		<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/spirometrija.jpg" alt="Spirometrija" title="Spirometrija" />
		<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/tibijalno-brahijalni-index-2.jpg" alt="Tibijalno Brahijalni index" title="Tibijalno Brahijalni index" />
                <!-- <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/08_slider.jpg" alt="" title="" /> -->
		<!-- <img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/slider/telemedicina.jpg" alt="" title="Telemedicina" /> -->
	</div>
	<div id="htmlcaption" class="nivo-html-caption">
		
	</div>
</div>
<!-- NIVO SLIDER -->
<h2 style="padding:30px 0 0 0; margin: 0 ;">Welcome</h2>
<h3 style="padding:0; margin: 0 0 30px 0;">to the webpage of Kardio Medika Polyclinic</h3>
<p>
The first private medical practice of the Mijalković family was founded in 1933 and named “General practice of Dr Borivoje P. Mijalković”. Since then, three generations have changed.<br /><br />

Kardio Medika was founded in 2004. A large number of successfully treated patients and growing interest in our services best illustrate the quality of our performance. The polyclinic is located in Niš, in the vicinity of the Primary Healthcare Center.
</p>
<br /><br />
<h3>Gallery</h3>
<p>
In a modern space with five fully equipped medical offices, our highly professional and caring staff will welcome you and care for you through your visit. You can schedule an appointment at a date and time most convenient for you.
</p>
<?php echo special_gallery_pictures(array('count' => 4), $this);?>

<?php if (count ( $this->_tpl_vars['costum_picture_list'] ) > 0): ?>
<div class="home_gallery_wrap">
<?php $_from = $this->_tpl_vars['costum_picture_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gallery_picture']):
?>
<div class="gallery_picture_list_home">
	<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/galerija?gallery_id=3" class="grouped_elements" rel="cs"  author="CS" >
	<span style="background-image:url(<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['gallery_picture']['thumbnail']; ?>
);"></span>
	</a>			
</div>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
<div class="home_video_wrap">
	<iframe width="318" height="191" src="//www.youtube.com/embed/a7moMaL5gMQ" frameborder="0" allowfullscreen></iframe>
</div>

<h2 style="margin:0 300px 0 0;">Unapređenje zdravlja</h2>
<hr>
<div class="home_special_news_wrap">
    <div class="home_special_news_home">
	<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/vesti-zdrava-ishrana" class="grouped_elements" rel="cs"  author="CS" >
	<span style="background-image:url(<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/zdrava-hrana.jpg);"></span>
	</a>
        <span style="font-size: 20px;">Zdrava ishrana</span>
    </div>
    <div class="home_special_news_home">
	<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/zanimljivosti-iz-sveta-zdravlja" class="grouped_elements" rel="cs"  author="CS" >
	<span style="background-image:url(<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/zanimljivosti-zdravlja.jpg);"></span>
        </a>
        <span style="font-size: 20px;">Zanimljivosti</span>
    </div>
    <div class="home_special_news_home">
	<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['lang']; ?>
/faktori-rizika" class="grouped_elements" rel="cs"  author="CS" >
	<span style="background-image:url(<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/infarkt-faktori-rizika.jpg);"></span>
	</a>	
        <span style="font-size: 20px;">Faktori rizika</span>
    </div>
</div>


