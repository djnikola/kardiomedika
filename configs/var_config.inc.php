<?php
/**
 * Language configurations
 */
$available_languages = array("sr", "en");
$default_language = "sr";

$config = array();
$config['default_language'] = $default_language;
$config['languages'] = $available_languages;

$config["contact_form_email_recipient"] = "info@codespeed.rs";

//gallery configuration
$config['galleryMaxPictures'] = 3;
$config['gallery_thumbnails'] = array("100x100", "200x200");
$config['gallery_pictures_thumbnails'] = array("100x100", "200x200");
$config['product_thumbnails'] = array("100x100", "200x200");
$config['product_picture_num'] = 4;

//name of gallery table picture
$config['gp_table_name'] = 'gallery_pictures';

//name of fk field in gallery table picture
$config['gp_fk_id_name'] = 'fk_gallery_id';
$config['articles_thumbnails'] = array("200x200", "230x230");
$config['products_thumbnails'] = array("250x250", "120x120");
$config['make_thumbnails'] = "GD";
$config['upload_picture_number'] = 1;
$config['per_page'] = 10;

// common meta use this to control which section has his own common meta title						
$config['controlers'] = array(
	'news',
);

// Overall meta
$config['meta'] = array(
						'title' => "Kardiomedika",
						'keywords' => "specijalisticka poliklinika",
						'description' => "kardiologija, specijalisticka poliklinika, nis",
						);
?>