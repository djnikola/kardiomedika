-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2012 at 09:29 AM
-- Server version: 5.0.75
-- PHP Version: 5.2.6-3ubuntu4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `wa_cms_frisco`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `brand_id` int(10) unsigned NOT NULL,
  `new` enum('yes','no') NOT NULL,
  `name` varchar(120) NOT NULL,
  `type` enum('togo','home') NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `category_id` (`brand_id`),
  KEY `new` (`new`)
);

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `brand_id`, `new`, `name`, `type`, `description`, `image_path`) VALUES
(1, 1, '', 'Erdbeer', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'extreme_erdbeer.jpg'),
(2, 1, '', 'Vanilla', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'extreme_vanille.jpg'),
(3, 1, '', 'Chocolate', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'extreme_chocolat.jpg'),
(4, 1, '', 'Stracciatella', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'extreme_stracciatella.jpg'),
(5, 1, '', 'Bananasplit', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'extreme_bananasplit.jpg'),
(7, 2, '', 'Classic', 'togo', 'Nulla sagittis sem vitae sapien scelerisque quis lacinia justo viverra. Sed ut lacus ac turpis tristique rhoncus molestie at eros. Etiam tempus iaculis leo nec pulvinar. Ut congue, augue ut mollis dignissim, elit risus semper nunc, nec eleifend elit tellus nec tortor. Duis non libero libero, sit amet cursus est. Proin malesuada augue et justo convallis luctus. Aenean ac nulla purus. Nam volutpat diam vitae velit condimentum quis laoreet velit vulputate. ', 'mega_classic.jpg'),
(8, 2, '', 'White', 'togo', 'Nulla sagittis sem vitae sapien scelerisque quis lacinia justo viverra. Sed ut lacus ac turpis tristique rhoncus molestie at eros. Etiam tempus iaculis leo nec pulvinar. Ut congue, augue ut mollis dignissim, elit risus semper nunc, nec eleifend elit tellus nec tortor. Duis non libero libero, sit amet cursus est. Proin malesuada augue et justo convallis luctus. Aenean ac nulla purus. Nam volutpat diam vitae velit condimentum quis laoreet velit vulputate. ', 'mega_white.jpg'),
(9, 2, '', 'Almond', 'togo', 'Donec scelerisque nisl quis nisi faucibus vel tincidunt arcu laoreet. Proin ac metus dui, quis tincidunt magna. Nullam vel lorem vel diam molestie auctor. Nulla id diam at enim semper posuere. Vestibulum gravida consectetur est ac fringilla. ', 'mega_almond.jpg'),
(10, 1, '', 'Erdbeer Vanille', 'home', 'EXTRÊME Cornets stehen für kalte Verführung und natürlichen Glacegenuss. Für unsere EXTRÊME verwenden wir ausnahmslos rein natürliche Zutaten. Diese müssen den höchsten Ansprüchen gerecht werden und werden deshalb mit grösster Sorgfalt ausgelesen:\r\n\r\n    * Cremiger Rahm aus Schweizer Milch aus Mittelland und Voralpen, der binnen 48 Stunden von unseren Glaciers direkt zu Glace verarbeitet wird.\r\n    * Ausgewählte, rein natürliche Zutaten\r\n    * Knusprige, schmackhafte Waffel ', 'extreme_erdbeer_vanille.jpg'),
(11, 1, '', 'Petit Vanille', 'home', 'EXTRÊME Cornets stehen für kalte Verführung und natürlichen Glacegenuss. Für unsere EXTRÊME verwenden wir ausnahmslos rein natürliche Zutaten. Diese müssen den höchsten Ansprüchen gerecht werden und werden deshalb mit grösster Sorgfalt ausgelesen: ', 'extreme_petit_vanille.jpg'),
(12, 1, '', 'Chocolat Stracciatella', 'home', 'EXTRÊME Cornets stehen für kalte Verführung und natürlichen Glacegenuss. Für unsere EXTRÊME verwenden wir ausnahmslos rein natürliche Zutaten. Diese müssen den höchsten Ansprüchen gerecht werden und werden deshalb mit grösster Sorgfalt ausgelesen: ', 'extreme_chocolat_stracciatella.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE IF NOT EXISTS `product_brand` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` text,
  `image_path` varchar(255) default NULL,
  `order_num` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `order_num` (`order_num`)
);

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `name`, `description`, `image_path`, `order_num`) VALUES
(1, 'Extreme', NULL, 'extreme.gif', 1),
(2, 'Mega', NULL, 'mega.gif', 2),
(3, 'Pacific', NULL, 'pacific.gif', 3),
(4, 'Winnetou', NULL, 'winnetou4.gif', 4),
(5, 'Rakete', NULL, 'rakete.gif', 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_brand_tr`
--

CREATE TABLE IF NOT EXISTS `product_brand_tr` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `language` char(5) NOT NULL,
  `translation_id` int(10) unsigned NOT NULL,
  `name` varchar(100) default NULL,
  `description` text,
  `image_path` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `language` (`language`,`translation_id`)
);

--
-- Dumping data for table `product_brand_tr`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `order_num` int(10) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `order_num` (`order_num`)
);

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `order_num`, `name`, `description`, `image_path`) VALUES
(1, 1, 'Neuheiten', '', ''),
(2, 2, 'Classic', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_category_brand`
--

CREATE TABLE IF NOT EXISTS `product_category_brand` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category_id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `category_id` (`category_id`,`brand_id`)
);

--
-- Dumping data for table `product_category_brand`
--

INSERT INTO `product_category_brand` (`id`, `category_id`, `brand_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_category_tr`
--

CREATE TABLE IF NOT EXISTS `product_category_tr` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `language` char(5) NOT NULL,
  `translation_id` int(10) unsigned NOT NULL,
  `name` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `language` (`language`,`translation_id`)
);

--
-- Dumping data for table `product_category_tr`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_tr`
--

CREATE TABLE IF NOT EXISTS `product_tr` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `language` char(5) NOT NULL,
  `translation_id` int(10) unsigned NOT NULL,
  `name` varchar(100) default NULL,
  `description` text,
  `image_path` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `language` (`language`,`translation_id`)
);

--
-- Dumping data for table `product_tr`
--



INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0003-products_table.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: zeka $',locate(':','$Author: zeka $')+1)),     
trim(TRAILING '$' from substring('$Revision: 114 $',locate(':','$Revision: 114 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-09 10:56:56 +0100 (Thu, 09 Feb 2012) $',locate(':','$Date: 2012-02-09 10:56:56 +0100 (Thu, 09 Feb 2012) $')+1)),     
now()); 
