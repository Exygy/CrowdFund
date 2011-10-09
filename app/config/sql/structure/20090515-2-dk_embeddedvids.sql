CREATE TABLE `embeddedvideos` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`foreign_id` INT NOT NULL ,
`type` ENUM( 'project' ) NOT NULL ,
`path` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NULL ,
`title` VARCHAR( 255 ) NULL
) ENGINE = MYISAM ;

RENAME TABLE `embeddedvideos` TO `embedded_videos` ;

ALTER TABLE `embedded_videos` ADD `embed` TEXT NOT NULL ;