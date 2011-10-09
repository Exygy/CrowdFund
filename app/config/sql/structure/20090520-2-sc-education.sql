ALTER TABLE `profiles` ADD `education` ENUM( 'High School', 'Associates', 'Bachelors', 'Masters', 'PhD' ) NOT NULL ;

CREATE TABLE `educations` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`level` VARCHAR( 16 ) NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `educations` ( `id` , `level` )
VALUES (
NULL , 'High School'
), (
NULL , 'Associates'
), (
NULL , 'Bachelors'
), (
NULL , 'Masters'
), (
NULL , 'PhD'
);