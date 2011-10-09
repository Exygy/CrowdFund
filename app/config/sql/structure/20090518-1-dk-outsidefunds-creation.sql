CREATE TABLE `outside_funding_sources` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`project_id` INT NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`amount` FLOAT NOT NULL
) ENGINE = MYISAM ;
