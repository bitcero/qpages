CREATE TABLE `mod_qpages_categos` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `nameid` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `mod_qpages_meta` (
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `page` int(11) NOT NULL,
  KEY `name` (`name`,`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mod_qpages_pages` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `nameid` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `public` tinyint(1) NOT NULL DEFAULT '1',
  `groups` text NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,
  `custom_url` varchar(100) NOT NULL,
  `home` tinyint(1) NOT NULL DEFAULT '0',
  `excerpt` varchar(255) NOT NULL,
  `custom_title` varchar(150) NOT NULL,
  `image` mediumtext NOT NULL,
  `template` varchar(255) NOT NULL,
  PRIMARY KEY (`id_page`),
  KEY `titulo_amigo` (`nameid`),
  KEY `cat` (`category`),
  KEY `home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
