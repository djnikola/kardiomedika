CREATE TABLE IF NOT EXISTS `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `status` enum('A','D') DEFAULT NULL,
  `status_dt` datetime DEFAULT NULL,
  `style_json` text,
  `fb_settings` text NOT NULL COMMENT 'json fb settings',
  `email_settings` text NOT NULL COMMENT 'json email settings',
  `settings` text NOT NULL COMMENT 'global application settings',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Open different facebook sms applications.' AUTO_INCREMENT=2 ;


INSERT INTO `application` (`id`, `name`, `status`, `status_dt`, `style_json`, `fb_settings`, `email_settings`, `settings`) VALUES
(1, 'CMS', 'A', '2011-04-05 21:47:09', NULL, '{}', '{\r\n    "from_email":"fbapp@horisen.biz",\r\n    "from_name":"Frisco",\r\n    "reply_email":"zeka@horisen.com",\r\n    "transport":"smtp",\r\n    "subject":"frisco voting game",\r\n    "parameters":{\r\n        "server":"mail.horisen.com",\r\n        "auth":"login",\r\n        "username":"fbapp@horisen.biz",\r\n        "password":"Fbh0r1sen*9",\r\n        "port":"587"\r\n    },\r\n    "text":{\r\n        "heading":"Frisco confirmation mail",\r\n        "description":"Please click on link bellow to confirm voting",\r\n        "footer":"Thank you for using Frisco voting game"\r\n    }\r\n\r\n}', '{\r\n"captcha":{\r\n    "fontName"      : "font4.ttf",\r\n    "wordLen"       : "3",\r\n    "timeout"       : "300",\r\n    "width"         : "150",\r\n    "height"        : "40",\r\n    "dotNoiseLevel" : "20",\r\n    "lineNoiseLevel": "2"\r\n}\r\n}');


CREATE TABLE IF NOT EXISTS `voting_candidate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contest_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `image_path` varchar(255) NOT NULL,
  `order_num` int(10) unsigned NOT NULL DEFAULT '0',
  `votes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'redundant count of total votes',
  PRIMARY KEY (`id`),
  KEY `order_num` (`order_num`),
  KEY `contest_id` (`contest_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `voting_candidate` (`id`, `contest_id`, `name`, `description`, `image_path`, `order_num`, `votes`) VALUES
(1, 1, 'Erdbeer', 'Erdbeer. ice cream with blubbery and strawberry.', '/content/products/1/extreme_erdbeer.jpg', 1, 1),
(2, 1, 'Vanille', 'Vanille ice cream with milk, vanilla and honey.', '/content/products/2/extreme_vanille.jpg', 2, 0);


CREATE TABLE IF NOT EXISTS `voting_contest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `start_dt` datetime DEFAULT NULL,
  `end_dt` datetime DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `voting_contest` (`id`, `name`, `start_dt`, `end_dt`, `status`) VALUES
(1, 'Ice  cream', '2012-02-03 11:51:03', '2013-02-03 11:51:06', 'active'),
(2, 'Chocolate', '2013-02-04 11:51:35', '2014-02-03 11:51:46', 'active');


CREATE TABLE IF NOT EXISTS `voting_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `posted` datetime NOT NULL,
  `contest_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `code` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contest_id` (`contest_id`,`candidate_id`,`user_id`,`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;


CREATE TABLE IF NOT EXISTS `voting_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;


INSERT INTO upgrade_db_log (
    file,
    username,
    revision,
    repos_dt,
    insert_dt
)
values (substring_index(
trim(both '$' from '$HeadURL: svn+sshp://radisa.no-ip.info/repos/webteam/genesis/branches/frisco/db/scripts/updb0006-voting.sql $'),'/',-1),
trim(TRAILING '$' from substring('$Author: zeka $',locate(':','$Author: zeka $')+1)),
trim(TRAILING '$' from substring('$Revision: 119 $',locate(':','$Revision: 119 $')+1)),
trim(TRAILING '$' from substring('$Date: 2012-02-09 16:52:13 +0100 (Thu, 09 Feb 2012) $',locate(':','$Date: 2012-02-09 16:52:13 +0100 (Thu, 09 Feb 2012) $')+1)),
now());
