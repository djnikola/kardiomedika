-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2012 at 11:52 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `frisco`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `type` enum('external','internal','functionality','static') COLLATE latin1_general_ci NOT NULL DEFAULT 'internal',
  `class` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `request_params` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `navigation` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `default_page` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `show_place` enum('first','second') COLLATE latin1_general_ci NOT NULL DEFAULT 'first',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `parent`, `level`, `type`, `class`, `request_params`, `link`, `navigation`, `default_page`, `ordering`, `show_place`) VALUES
(1, 0, 0, 'static', 'home', 'section=pages&subsection=view', 'home.tpl', 'no', 1, 0, 'first'),
(2, 0, 0, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(3, 0, 0, 'functionality', 'products', 'section=products&subsection=index', '', 'yes', 0, 0, 'first'),
(4, 0, 0, 'static', 'all-naturall', 'section=pages&subsection=view', 'all-naturall.tpl', 'yes', 0, 0, 'first'),
(5, 0, 0, 'static', 'events', 'section=pages&subsection=view', 'events.tpl', 'yes', 0, 0, 'first'),
(6, 0, 0, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(7, 0, 0, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(8, 6, 1, 'static', 'facebook', 'section=pages&subsection=view', 'frisco_community/facebook.tpl', 'yes', 0, 0, 'first'),
(9, 6, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(10, 6, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(11, 5, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(12, 5, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(13, 5, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(14, 5, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(15, 7, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(16, 7, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(17, 2, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(18, 2, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(19, 2, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(20, 2, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(21, 2, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first'),
(22, 4, 1, 'internal', '', NULL, '', 'yes', 0, 0, 'first');


-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2012 at 11:54 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `frisco`
--

-- --------------------------------------------------------

--
-- Table structure for table `page_trans`
--

DROP TABLE IF EXISTS `page_trans`;
CREATE TABLE IF NOT EXISTS `page_trans` (
  `fk_page_id` int(11) NOT NULL,
  `permalink` varchar(255) CHARACTER SET utf8 NOT NULL,
  `caption` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `permalink` (`permalink`,`lang`),
  KEY `fk_page_id` (`fk_page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `page_trans`
--

INSERT INTO `page_trans` (`fk_page_id`, `permalink`, `caption`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `lang`) VALUES
(1, 'home', 'Home', '', '', '', '', 'en'),
(1, 'home', 'Home', '<p>text</p>', '', '', '', 'de'),
(2, 'ueber-uns', 'Über uns', '', '', '', '', 'en'),
(2, 'ueber-uns', 'Über uns', '', '', '', '', 'de'),
(3, 'unsere-marken', 'Unsere Marken', '', '', '', '', 'en'),
(3, 'unsere-marken', 'Unsere Marken', '', '', '', '', 'de'),
(4, 'all-natural', 'All natural', '', '', '', '', 'en'),
(4, 'all-natural', 'All natural', '', '', '', '', 'de'),
(5, 'events', 'Events', '', '', '', '', 'en'),
(5, 'events', 'Events', '', '', '', '', 'de'),
(6, 'frisco-community', 'Frisco Community', '', '', '', '', 'en'),
(6, 'frisco-community', 'Frisco Community', '', '', '', '', 'de'),
(7, 'action', 'Action', '', '', '', '', 'en'),
(7, 'action', 'Action', '', '', '', '', 'de'),
(8, 'facebook', 'Facebook', '', '', '', '', 'en'),
(8, 'facebook', 'Facebook', '', '', '', '', 'de'),
(9, 'youtube', 'Youtube', '', '', '', '', 'en'),
(9, 'youtube', 'Youtube', '', '', '', '', 'de'),
(10, 'gastroblog', 'Gastroblog', '', '', '', '', 'en'),
(10, 'gastroblog', 'Gastroblog', '', '', '', '', 'de'),
(11, 'music', 'Music', '', '', '', '', 'en'),
(11, 'music', 'Music', '', '', '', '', 'de'),
(12, 'sport', 'Sport', '', '', '', '', 'en'),
(12, 'sport', 'Sport', '', '', '', '', 'de'),
(13, 'messen', 'Messen', '', '', '', '', 'en'),
(13, 'messen', 'Messen', '', '', '', '', 'de'),
(14, 'special', 'Special', '', '', '', '', 'en'),
(14, 'special', 'Special', '', '', '', '', 'de'),
(15, 'aktuelles', 'Aktuelles', '', '', '', '', 'en'),
(15, 'aktuelles', 'Aktuelles', '', '', '', '', 'de'),
(16, 'wettbewerbe', 'Wettbewerbe', '', '', '', '', 'en'),
(16, 'wettbewerbe', 'Wettbewerbe', '', '', '', '', 'de'),
(17, 'firmengeschichte', 'Firmengeschichte', '', '', '', '', 'en'),
(17, 'firmengeschichte', 'Firmengeschichte', '', '', '', '', 'de'),
(18, 'sortiment-historie', 'Sortiment Historie', '', '', '', '', 'en'),
(18, 'sortiment-historie', 'Sortiment Historie', '', '', '', '', 'de'),
(19, 'kontakt', 'Kontakt', '', '', '', '', 'en'),
(19, 'kontakt', 'Kontakt', '', '', '', '', 'de'),
(20, 'nestle-shops', 'Nestle Shops', '', '', '', '', 'en'),
(20, 'nestle-shops', 'Nestle Shops', '', '', '', '', 'de'),
(21, 'mediacenter', 'Mediacenter', '', '', '', '', 'en'),
(21, 'mediacenter', 'Mediacenter', '', '', '', '', 'de'),
(22, 'all-natural-638', 'All natural', '', '', '', '', 'en'),
(22, 'all-natural-638', 'All natural', '', '', '', '', 'de');



INSERT INTO upgrade_db_log ( 
    file,     
    username,     
    revision,     
    repos_dt,     
    insert_dt
)  
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0020_tmp_pages.sql $'),'/',-1),     
trim(TRAILING '$' from substring('$Author: boris $',locate(':','$Author: boris $')+1)),     
trim(TRAILING '$' from substring('$Revision: 144 $',locate(':','$Revision: 144 $')+1)),     
trim(TRAILING '$' from substring('$Date: 2012-02-17 11:55:23 +0100 (Fri, 17 Feb 2012) $',locate(':','$Date: 2012-02-17 11:55:23 +0100 (Fri, 17 Feb 2012) $')+1)),     
now()); 