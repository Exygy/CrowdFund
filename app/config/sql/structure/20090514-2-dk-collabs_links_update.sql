CREATE TABLE `collaborators` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fname` VARCHAR( 255 ) NOT NULL ,
`lname` VARCHAR( 255 ) NOT NULL ,
`description` TEXT NULL ,
`affiliation` VARCHAR( 255 ) NULL ,
`link` VARCHAR( 255 ) NULL
) ENGINE = MYISAM ;

ALTER TABLE `collaborators` ADD `project_id` INT NOT NULL AFTER `id` ;

ALTER TABLE `projects` ADD `homepage` VARCHAR( 255 ) NULL AFTER `background` ;

CREATE TABLE `links` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`foreign_id` INT NOT NULL ,
`type` ENUM( 'profile', 'project' ) NOT NULL ,
`path` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NULL ,
`title` VARCHAR( 255 ) NULL
) ENGINE = MYISAM ;
