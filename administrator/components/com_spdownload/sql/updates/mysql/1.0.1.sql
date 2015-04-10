DROP TABLE IF EXISTS `#__spdownload`;

 CREATE  TABLE  `#__spdownload` (
 `id` int( 11  )  NOT  NULL  AUTO_INCREMENT ,
 `name` varchar( 255  )  NOT  NULL DEFAULT  '',
 `filepath` varchar( 255  )  NOT  NULL DEFAULT  '',
 `access` int(10) unsigned NOT NULL DEFAULT '0',
 PRIMARY  KEY (  `id`  ) ) ENGINE  =  MyISAM  DEFAULT CHARSET  = utf8;
