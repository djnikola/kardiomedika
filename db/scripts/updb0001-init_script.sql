-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2012 at 11:13 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `frisco`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `articles_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) CHARACTER SET utf8 NOT NULL,
  `create_date` datetime NOT NULL,
  `publish_date` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `articles_type` enum('music','sport','messen','special') NOT NULL,
  `is_active` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`articles_id`)
);

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articles_id`, `image`, `create_date`, `publish_date`, `deleted`, `articles_type`, `is_active`) VALUES
(25, 'uploads/articles/5/25/25__420482-10150495403266646-121738461645-9233715-2038337927-n.jpg', '0000-00-00 00:00:00', '2012-01-04 00:00:00', 0, 'sport', 'yes'),
(24, 'uploads/articles/4/24/24__aa.jpg', '0000-00-00 00:00:00', '2012-01-04 00:00:00', 0, 'messen', 'yes'),
(23, 'uploads/articles/3/23/23__sneeeeeeeg.jpg', '0000-00-00 00:00:00', '2012-01-04 00:00:00', 0, 'special', 'yes'),
(26, '', '0000-00-00 00:00:00', '2012-02-01 00:00:00', 0, 'music', 'yes'),
(27, 'uploads/articles/7/27/27__jeanswerk-profil-pic-facebook.jpg', '0000-00-00 00:00:00', '2012-02-04 00:00:00', 0, 'special', 'yes'),
(28, '', '0000-00-00 00:00:00', '2012-02-01 00:00:00', 0, 'messen', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `articles_trans`
--

CREATE TABLE IF NOT EXISTS `articles_trans` (
  `fk_articles_id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `short_content` text NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `lang` varchar(3) NOT NULL,
  KEY `fk_news_id` (`fk_articles_id`)
);

--
-- Dumping data for table `articles_trans`
--

INSERT INTO `articles_trans` (`fk_articles_id`, `caption`, `content`, `short_content`, `meta_title`, `meta_keywords`, `meta_description`, `lang`) VALUES
(23, 'Lorem ipsum dolor', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat, porta convallis metus. Phasellus venenatis, diam nec ultrices dictum, urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem, ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem, lacinia nec fringilla et, posuere in lacus. ', '', '', '', 'en'),
(23, 'chmod 777', '<p>chmod 777</p>', 'chmod 777', '', '', '', 'de'),
(25, 'Diamond Club', '<p>Diamond Club St. Moritz</p>', 'Diamond Club St. Moritz', '', '', '', 'de'),
(25, 'Lorem ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat, porta convallis metus. Phasellus venenatis, diam nec ultrices dictum, urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem, ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem, lacinia nec fringilla et, posuere in lacus. ', '', '', '', 'en'),
(24, 'Lorem ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat, porta convallis metus. Phasellus venenatis, diam nec ultrices dictum, urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem, ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem, lacinia nec fringilla et, posuere in lacus. ', '', '', '', 'en'),
(24, 'Kommunikationsplaner', '<p>Kommunikationsplaner</p>', 'Kommunikationsplaner', '', '', '', 'de'),
(26, 'Lorem ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat, porta convallis metus. Phasellus venenatis, diam nec ultrices dictum, urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem, ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem, lacinia nec fringilla et, posuere in lacus. ', '', '', '', 'en'),
(26, 'Lorem ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>\r\n<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus  sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices  ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat,  porta convallis metus. Phasellus venenatis, diam nec ultrices dictum,  urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et  tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem,  ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem,  lacinia nec fringilla et, posuere in lacus.</p>', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et tellus sed sapien malesuada hendrerit eu eget nunc. Mauris commodo ultrices ipsum. Fusce sit amet elit nibh, non luctus odio. In at ligula erat, porta convallis metus. Phasellus venenatis, diam nec ultrices dictum, urna elit pretium est, in pharetra augue ante eu leo. Pellentesque et tellus non ligula hendrerit pharetra et eu velit. Cras ipsum sem, ullamcorper aliquam convallis et, tempor vitae orci. Morbi ante sem, lacinia nec fringilla et, posuere in lacus. ', '', '', '', 'de'),
(27, 'Lorem ipsum', '<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodale</p>\r\n<p>s ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>', 'Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus eu interdum sit amet, egestas eget lorem. Fusce et leo at diam adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut. Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. ', '', '', '', 'en'),
(27, 'Lorem ipsum', '<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodale</p>\r\n<p>s ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>', 'Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus eu interdum sit amet, egestas eget lorem. Fusce et leo at diam adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut. Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. ', '', '', '', 'de'),
(28, 'Lorem ipsum dolor', '<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>\r\n<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>', 'Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus eu interdum sit amet, egestas eget lorem. Fusce et leo at diam adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut. Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. ', '', '', '', 'en'),
(28, 'Lorem ipsum dolor', '<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>\r\n<p>Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt  ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus  posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus  eu interdum sit amet, egestas eget lorem. Fusce et leo at diam  adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin  hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget  tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut.  Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing  vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat.</p>', 'Etiam ultrices, urna eget consectetur porttitor, odio urna tincidunt ipsum, vulputate eleifend lectus ante sed augue. Maecenas vel purus posuere metus consequat mollis ut vitae sapien. Morbi augue urna, tempus eu interdum sit amet, egestas eget lorem. Fusce et leo at diam adipiscing faucibus. Nulla in nunc nisi, nec accumsan felis. Proin hendrerit consequat odio sed laoreet. Aliquam sit amet velit elit, eget tincidunt lectus. Nam commodo posuere lacus, id porta tellus sodales ut. Fusce nec tristique risus. Vivamus bibendum, urna at adipiscing vulputate, turpis ante dapibus diam, quis eleifend sem diam eu erat. ', '', '', '', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `auth_locations`
--

CREATE TABLE IF NOT EXISTS `auth_locations` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_group_id` int(11) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sub_section` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`loc_id`)
);

--
-- Dumping data for table `auth_locations`
--

INSERT INTO `auth_locations` (`loc_id`, `fk_group_id`, `section`, `sub_section`, `value`) VALUES
(5, 1, 'users', 'list', '1'),
(27, 1, 'users', 'change_pass', '1'),
(23, 2, 'users', 'list', '1'),
(28, 2, 'users', 'new', '1'),
(25, 1, 'users', 'new', '1'),
(26, 1, 'users', 'delete', '1'),
(29, 1, 'login', 'welcome', '1'),
(30, 2, 'login', 'welcome', '1'),
(31, 1, 'articles', 'new', '1'),
(32, 1, 'articles', 'list', '1'),
(33, 1, 'articles', 'delete', '1'),
(34, 1, 'pages', 'list', '1'),
(35, 1, 'pages', 'new', '1'),
(36, 1, 'pages', 'delete', '1'),
(37, 1, 'common', 'list', '1'),
(38, 1, 'common', 'new', '1'),
(39, 1, 'common', 'delete', '1'),
(50, 1, 'gallery', 'add_img', '1'),
(44, 1, 'items', 'list', '1'),
(45, 1, 'items', 'delete', '1'),
(46, 1, 'items', 'new', '1'),
(47, 1, 'gallery', 'list_gallery', '1'),
(48, 1, 'gallery', 'delete', '1'),
(49, 1, 'gallery', 'new_gallery', '1'),
(51, 1, 'deko', 'preview', '1'),
(52, 1, 'deko', 'new', '1'),
(53, 1, 'gallery', 'list_gallery_pictures', '1'),
(54, 1, 'gallery', 'delete_gallery_picture', '1'),
(55, 1, 'gallery', 'new_gallery_pictures', '1'),
(56, 1, 'gallery', 'delete_gallery', '1'),
(57, 1, 'gallery', 'sort_galleries', '1');

-- --------------------------------------------------------

--
-- Table structure for table `common_conf`
--

CREATE TABLE IF NOT EXISTS `common_conf` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_label` varchar(255) NOT NULL,
  `field_type` enum('text','textarea') NOT NULL DEFAULT 'text',
  PRIMARY KEY (`cc_id`)
);

--
-- Dumping data for table `common_conf`
--

INSERT INTO `common_conf` (`cc_id`, `cc_label`, `field_type`) VALUES
(1, 'contact_send_mail', 'text'),
(2, 'company_slogan', 'text'),
(3, 'office_one', 'textarea'),
(4, 'office_two', 'textarea');

-- --------------------------------------------------------

--
-- Table structure for table `common_conf_trans`
--

CREATE TABLE IF NOT EXISTS `common_conf_trans` (
  `fk_cc_id` int(10) unsigned NOT NULL,
  `cc_value` text NOT NULL,
  `lang` varchar(3) NOT NULL,
  `cc_label_tr` varchar(255) NOT NULL,
  KEY `fk_cc_id` (`fk_cc_id`)
);

--
-- Dumping data for table `common_conf_trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `common_meta`
--

CREATE TABLE IF NOT EXISTS `common_meta` (
  `mt_id` int(11) NOT NULL AUTO_INCREMENT,
  `mt_meta_title` varchar(255) NOT NULL,
  `mt_label` varchar(200) NOT NULL,
  `mt_meta_keywords` varchar(255) NOT NULL,
  `mt_meta_description` varchar(255) NOT NULL,
  `mt_index` varchar(255) NOT NULL,
  `lang` varchar(3) NOT NULL,
  PRIMARY KEY (`mt_id`,`mt_meta_title`)
);

--
-- Dumping data for table `common_meta`
--


-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `contact_us_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `notice` text NOT NULL,
  PRIMARY KEY (`contact_us_id`)
);

--
-- Dumping data for table `contact_us`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_category_id` int(10) unsigned NOT NULL,
  `gallery_path` varchar(255),
  `created_date` date NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_special` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gallery_id`),
  KEY `gallery_category_id` (`gallery_category_id`)
);

--
-- Dumping data for table `gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE IF NOT EXISTS `gallery_category` (
  `gallery_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`gallery_category_id`)
);

--
-- Dumping data for table `gallery_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery_category_trans`
--

CREATE TABLE IF NOT EXISTS `gallery_category_trans` (
  `fk_gallery_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lang` varchar(3) NOT NULL
);

--
-- Dumping data for table `gallery_category_trans`
--

INSERT INTO `gallery_category_trans` (`fk_gallery_category_id`, `name`, `description`, `lang`) VALUES
(1, 'Basic Category', 'This is basic category', 'en'),
(1, 'Grundlegende Kategorie', 'Dies ist eine grundlegende Kategorie', 'de'),
(1, 'Basic Category', 'This is basic category', 'en'),
(1, 'Grundlegende Kategorie', 'Dies ist eine grundlegende Kategorie', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_pictures`
--

CREATE TABLE IF NOT EXISTS `gallery_pictures` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_gallery_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`picture_id`)
);

--
-- Dumping data for table `gallery_pictures`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery_pictures_trans`
--

CREATE TABLE IF NOT EXISTS `gallery_pictures_trans` (
  `fk_picture_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lang` varchar(3) NOT NULL,
  KEY `fk_picture_id` (`fk_picture_id`)
);

--
-- Dumping data for table `gallery_pictures_trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallery_trans`
--

CREATE TABLE IF NOT EXISTS `gallery_trans` (
  `fk_gallery_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `lang` varchar(3) NOT NULL,
  KEY `fk_gallery_id` (`fk_gallery_id`)
);

--
-- Dumping data for table `gallery_trans`
--


-- --------------------------------------------------------

--
-- Table structure for table `lang_table`
--

CREATE TABLE IF NOT EXISTS `lang_table` (
  `lang_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `trans` text NOT NULL,
  `lang` varchar(4) NOT NULL,
  PRIMARY KEY (`lang_table_id`)
);

--
-- Dumping data for table `lang_table`
--

INSERT INTO `lang_table` (`lang_table_id`, `label`, `trans`, `lang`) VALUES
(1, 'latest_news', 'Latest News', 'en'),
(2, 'latest_news', 'Aktuelle News', 'de'),
(3, 'view_all', 'view all', 'en'),
(4, 'view_all', 'alle', 'de'),
(5, 'latest_events', 'Latest events', 'en'),
(6, 'latest_events', 'Jüngsten Ereignisse', 'de'),
(7, 'news', 'News', 'en'),
(8, 'news', 'Nachrichten', 'de'),
(9, 'termine', 'Events', 'en'),
(10, 'termine', 'Termine', 'de'),
(11, 'read_more', 'read more', 'en'),
(12, 'read_more', 'mehr lesen', 'de'),
(13, 'gallery', 'Gallery', 'en'),
(14, 'gallery', 'Gallery', 'de'),
(15, 'back', 'Back', 'en'),
(16, 'back', 'Zurück', 'de'),
(17, 'contact_us', 'Contact Us', 'en'),
(18, 'contact_us', 'Kontakt', 'de'),
(19, 'name', 'Name', 'en'),
(20, 'name', 'Name', 'de'),
(21, 'telephone', 'Telephone', 'en'),
(22, 'telephone', 'Telefon', 'de'),
(23, 'subject', 'Subject', 'en'),
(24, 'subject', 'Subjekt', 'de'),
(25, 'text', 'Text', 'en'),
(26, 'text', 'Tekst', 'de'),
(27, 'send', 'Send', 'en'),
(28, 'send', 'Senden', 'de'),
(29, 'thank_you', 'Thank You', 'en'),
(30, 'thank_you', 'Danke', 'de'),
(31, 'landing_comment', 'Landing comment', 'en'),
(32, 'landing_comment', 'Kommentar', 'de'),
(33, 'no_results', 'no results', 'en'),
(34, 'no_results', 'keine ergebnisse', 'de'),
(35, 'all_articles', 'all articles', 'en'),
(36, 'all_articles', 'alle Artikel', 'de'),
(37, 'articles', 'Articles', 'en'),
(38, 'articles', 'Artikel', 'de'),
(39, 'events', 'Events', 'en'),
(40, 'events', 'Events', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `lang_table_admin`
--

CREATE TABLE IF NOT EXISTS `lang_table_admin` (
  `lang_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `trans` text NOT NULL,
  `lang` varchar(4) NOT NULL,
  PRIMARY KEY (`lang_table_id`)
);

--
-- Dumping data for table `lang_table_admin`
--

INSERT INTO `lang_table_admin` (`lang_table_id`, `label`, `trans`, `lang`) VALUES
(1, 'you_are_loged_as', 'You are logged as', 'en'),
(2, 'you_are_loged_as', 'Sie sind als loged', 'de'),
(3, 'title', 'Title', 'en'),
(4, 'title', 'Titel', 'de'),
(5, 'type', 'Type', 'en'),
(6, 'type', 'Typ', 'de'),
(7, 'active', 'Active', 'en'),
(8, 'active', 'Aktiv', 'de'),
(9, 'search', 'Search', 'en'),
(10, 'search', 'Suche', 'de'),
(11, 'any', 'Any', 'en'),
(12, 'any', 'Alle', 'de'),
(13, 'yes', 'Yes', 'en'),
(14, 'yes', 'Ja', 'de'),
(15, 'no', 'No', 'en'),
(16, 'no', 'Nein', 'de'),
(17, 'action', 'Action', 'en'),
(18, 'action', 'Aktion', 'de'),
(19, 'edit', 'Edit', 'en'),
(20, 'edit', 'Edit', 'de'),
(21, 'delete', 'Delete', 'en'),
(22, 'delete', 'Löschen', 'de'),
(23, 'news', 'News', 'en'),
(24, 'news', 'News', 'de'),
(25, 'termine', 'Events', 'en'),
(26, 'termine', 'Termine', 'de'),
(27, 'administration_panel', 'Administration panel', 'en'),
(28, 'administration_panel', 'Administrations-Bereich', 'de'),
(29, 'data', 'Data', 'en'),
(30, 'data', 'Daten', 'de'),
(31, 'add_edit', 'Add or edit', 'en'),
(32, 'add_edit', 'Hinzufügen oder Bearbeiten', 'de'),
(33, 'picture', 'Picture', 'en'),
(34, 'picture', 'Bild', 'de'),
(35, 'short_content', 'Short content', 'en'),
(36, 'short_content', 'Short Inhalt', 'de'),
(37, 'content', 'Content', 'en'),
(38, 'content', 'Inhalt', 'de'),
(39, 'save', 'Save', 'en'),
(40, 'save', 'Sparen', 'de'),
(41, 'cancel', 'Cancel', 'en'),
(42, 'cancel', 'Kündigen', 'de'),
(43, 'from', 'From', 'en'),
(44, 'from', 'Von', 'de'),
(45, 'to', 'To', 'en'),
(46, 'to', 'Zu', 'de'),
(47, 'date', 'Date', 'en'),
(48, 'date', 'Datum', 'de'),
(49, 'add', 'Add', 'en'),
(50, 'add', 'Hinzufügen', 'de'),
(51, 'username', 'Username', 'en'),
(52, 'username', 'Name', 'de'),
(53, 'pass', 'Password', 'en'),
(54, 'pass', 'Kennwort', 'de'),
(55, 'page', 'Page', 'en'),
(56, 'page', 'Seite', 'de'),
(57, 'root_page_title', 'Root', 'en'),
(58, 'root_page_title', 'Root', 'de'),
(59, 'no_results', 'No Results', 'en'),
(60, 'no_results', 'Keine Ergebnisse', 'de'),
(61, 'pages', 'Pages', 'en'),
(62, 'pages', 'Seiten', 'de'),
(63, 'pages', 'Pages', 'en'),
(64, 'pages', 'Seiten', 'de'),
(65, 'articles', 'Articles', 'en'),
(66, 'articles', 'Artikel', 'de'),
(67, 'users', 'Users', 'en'),
(68, 'users', 'Benutzer', 'de'),
(69, 'ver_pass', 'Verify Password', 'en'),
(70, 'ver_pass', 'Passwort bestätigen', 'de'),
(71, 'name', 'Name', 'en'),
(72, 'name', 'Name', 'de'),
(73, 'surname', 'Surname', 'en'),
(74, 'surname', 'Nachname', 'de'),
(75, 'user_role', 'Role', 'en'),
(76, 'user_role', 'Rolle', 'de'),
(77, 'change_pass', 'Change Password', 'en'),
(78, 'change_pass', 'Kennwort ändern', 'de'),
(79, 'old_pass', 'Old Password', 'en'),
(80, 'old_pass', 'Altes Passwort', 'de'),
(81, 'list', 'List', 'en'),
(82, 'list', 'Liste', 'de'),
(83, 'are_you_sure', 'Are you sure', 'en'),
(84, 'are_you_sure', 'Sind Sie sicher', 'de'),
(85, 'gallery', 'Gallery', 'en'),
(86, 'gallery', 'Galerie', 'de'),
(87, 'pictures', 'Pictures', 'en'),
(88, 'pictures', 'Bilder', 'de'),
(89, 'category', 'Category', 'en'),
(90, 'category', 'Kategorie', 'de'),
(91, 'sort', 'Sort', 'en'),
(92, 'sort', 'Sortieren', 'de'),
(93, 'picture_list', 'Picture list', 'en'),
(94, 'picture_list', 'Bilder-Liste', 'de'),
(95, 'special', 'Special', 'en'),
(96, 'special', 'Besondere', 'de'),
(97, 'description', 'Description', 'en'),
(98, 'description', 'Beschreibung', 'de'),
(99, 'meta_keywords', 'Meta keywords', 'en'),
(100, 'meta_keywords', 'Meta keywords', 'de'),
(101, 'add_meta_tags', 'Add meta tags', 'en'),
(102, 'add_meta_tags', 'Add meta tags', 'de'),
(103, 'meta_title', 'Meta title', 'en'),
(104, 'meta_title', 'Meta title', 'de'),
(105, 'meta_description', 'Meta description', 'en'),
(106, 'meta_description', 'Meta description', 'de'),
(107, 'events', 'Events', 'en'),
(108, 'events', 'Events', 'de'),
(109, 'music', 'Music', 'en'),
(110, 'music', 'Music', 'de'),
(111, 'sport', 'Sport', 'en'),
(112, 'sport', 'Sport', 'de'),
(113, 'messen', 'Messen', 'en'),
(114, 'messen', 'Messen', 'de'),
(115, 'special', 'Special', 'en'),
(116, 'special', 'Special', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `type` enum('external','internal','functionality','static') NOT NULL DEFAULT 'internal',
  `class` varchar(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_opt` enum('_blank','_parent') NOT NULL DEFAULT '_parent',
  `default_page` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `show_place` enum('first','second') NOT NULL DEFAULT 'first',
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `parent`, `level`, `type`, `class`, `link`, `link_opt`, `default_page`, `ordering`, `show_place`) VALUES
(1, 0, 0, 'static', 'home', 'home.tpl', '_parent', 1, 0, 'first'),
(2, 0, 0, 'functionality', 'articles', 'section=articles', '_parent', 0, 1, 'first'),
(3, 0, 0, 'functionality', '', 'section=events', '_parent', 0, 2, 'first'),
(4, 0, 0, 'static', '', 'about.tpl', '_parent', 0, 6, 'first'),
(5, 0, 0, 'functionality', '', 'section=gallery', '_parent', 0, 4, 'first'),
(6, 0, 0, 'static', '', 'events.tpl', '_parent', 0, 5, 'first'),
(7, 0, 0, 'functionality', '', 'section=media', '_parent', 0, 3, 'first'),
(8, 4, 1, 'internal', '', '', '_parent', 0, 0, 'first');

-- --------------------------------------------------------

--
-- Table structure for table `page_trans`
--

CREATE TABLE IF NOT EXISTS `page_trans` (
  `fk_page_id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(250) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `meta_description` varchar(250) NOT NULL,
  `lang` varchar(3) NOT NULL,
  KEY `fk_page_id` (`fk_page_id`)
);

--
-- Dumping data for table `page_trans`
--

INSERT INTO `page_trans` (`fk_page_id`, `caption`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `lang`) VALUES
(1, 'Home', '', '', '', '', 'en'),
(2, 'Articles', '', '', '', '', 'en'),
(3, 'Events', '', '', '', '', 'en'),
(4, 'About', '', '', '', '', 'en'),
(5, 'Gallery', '', '', '', '', 'en'),
(6, 'Events', '', '', '', '', 'en'),
(7, 'Media', '', '', '', '', 'en'),
(1, 'Startseite', '', '', '', '', 'de'),
(2, 'Artikel', '', '', '', '', 'de'),
(3, 'Termine', '', '', '', '', 'de'),
(4, 'Über uns', '', '', '', '', 'de'),
(5, 'Gallery', '', '', '', '', 'de'),
(6, 'Events', '', '', '', '', 'de'),
(7, 'Medien', '', '', '', '', 'de'),
(8, 'jhkvjhv', '<p>jhkjhgjghjg bjbhjhjhk</p>', '', '', '', 'en'),
(8, 'jhkvjhv', '<p>jhkjhgjghjg bjbhjhjhk</p>', '', '', '', 'de');

-- --------------------------------------------------------

--
-- Table structure for table `upgrade_db_log`
--

CREATE TABLE IF NOT EXISTS `upgrade_db_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `revision` int(11) DEFAULT NULL,
  `repos_dt` varchar(100) DEFAULT NULL,
  `insert_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `upgrade_db_log`
--

INSERT INTO `upgrade_db_log` (`id`, `file`, `username`, `revision`, `repos_dt`, `insert_dt`) VALUES
(1, 'updb0001-init_script.sql ', ' boris ', 0, '2012-01-27 12:20:16', '2012-01-27 12:20:16'),
(2, 'updb0002-user_table_drop_fb_id.tpl.sql ', ' boris ', 40, ' 2012-01-27 12:26:57 +0100 (Fri, 27 Jan 2012) ', '2012-01-27 12:27:18'),
(3, 'updb0002-lang_table_insert_label_no_results.tpl.sql ', ' miljan ', 41, ' 2012-01-27 12:53:18 +0100 (Fri, 27 Jan 2012) ', '2012-01-27 12:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_group_id` int(11) NOT NULL,
  `fk_users_role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pass_hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_baned` tinyint(1) NOT NULL DEFAULT '0',
  `register_date` datetime NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `area_code` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `fk_country_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_level_id` (`fk_group_id`)
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fk_group_id`, `fk_users_role`, `username`, `password`, `pass_hash`, `is_active`, `is_baned`, `register_date`, `first_name`, `last_name`, `email`, `activation_code`, `street`, `city`, `state`, `zip`, `country_code`, `area_code`, `phone_number`, `fax`, `mobile_phone`, `fk_country_id`) VALUES
(139, 1, 0, 'test', '05d44990ddf67e3bcdfb4b4da5bc83d9', '7e1a8e1951353eeb773293b6920e06ad', 1, 0, '2010-09-14 16:24:56', 'test', 'test', 'boris@horisen.com', '', '', '', '', '', '', '', '', '', '', 0),
(140, 1, 0, 'proba', '3236fd5491c88cea3f48081425282e24', '6acb0ad54a3ec6febc942f622679f14f', 1, 0, '2010-09-16 11:21:43', 'proba', 'proba', 'boris@horisen.com', '', '', '', '', '', '', '', '', '', '', 0),
(141, 1, 0, 'dfgsd', '723b611e2a37a2eb765ce820b152070e', '9f880649bc575f288ac7f2ca04d16b8b', 1, 0, '2010-09-16 11:28:23', 'sdfgs', 'dfgsdfg', 'boris@horisen.com', '', '', '', '', '', '', '', '', '', '', 0),
(142, 1, 0, 'as', '89dd82ef65f10f7d1dcf4aee129684e1', 'b456762e209e164b822a04283ae264b4', 1, 0, '2010-10-20 11:20:23', 'Miljan', 'Stankovic', 'miljan@horisen.com', '', '', '', '', '', '', '', '', '', '', 0),
(143, 2, 0, 'nikola', 'ae4f14c471fc56b2d8937bd9888404fa', '15baae348449fb821946ee8305c698b1', 1, 0, '2012-01-19 15:24:13', 'Nikola', 'Djordjevic', 'nikola@horisen.com', '', '', '', '', '', '', '', '', '', '', 0);
