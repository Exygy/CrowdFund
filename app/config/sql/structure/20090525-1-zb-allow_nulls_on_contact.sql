 ALTER TABLE `contacts` CHANGE `id` `id` INT( 11 ) NOT NULL DEFAULT '0',
CHANGE `address` `address` VARCHAR( 128 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `city` `city` VARCHAR( 64 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `state` `state` VARCHAR( 8 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE `zip` `zip` INT( 11 ) NULL DEFAULT '0',
CHANGE `phone` `phone` VARCHAR( 32 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL 
