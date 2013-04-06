<?php

//Add New table 'bannerextension' in database;

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('dailyfeature')};

CREATE TABLE `bannerextension` (
  `id` int(11) unsigned NOT NULL auto_increment,  
  `filepath` varchar(255) NOT NULL,  
  `url` varchar(255) NOT NULL default '#',
  `title` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
");

$installer->endSetup();