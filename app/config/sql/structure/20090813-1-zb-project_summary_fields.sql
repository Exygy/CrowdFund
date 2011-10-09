ALTER TABLE `projects` ADD `problem` VARCHAR( 255 ) NOT NULL AFTER `background` ,
ADD `impact` VARCHAR( 255 ) NOT NULL AFTER `problem` ,
ADD `commercialization` VARCHAR( 255 ) NOT NULL AFTER `impact` ;
