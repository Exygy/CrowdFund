CREATE TABLE IF NOT EXISTS `expertises_scientists` (
  `scientist_id` int(11) NOT NULL default '0',
  `expertise_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`scientist_id`,`expertise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(128) NOT NULL default '',
  `lname` varchar(128) NOT NULL default '',
  `email` varchar(128) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `type` enum('donor','scientist') NOT NULL default 'donor',
  `active` int(11) NOT NULL default '0',
  `hash` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

