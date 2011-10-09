

CREATE TABLE `donations` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_donation_amt` float NOT NULL default '0',
  `eureka_donation_amt` float NOT NULL default '0',
  `flexible_donation` enum('0','1') NOT NULL default '1',
  `card_num` varchar(32) NOT NULL,
  `card_cvv` varchar(6) NOT NULL,
  `card_expiry` date NOT NULL,
  `card_zip` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
