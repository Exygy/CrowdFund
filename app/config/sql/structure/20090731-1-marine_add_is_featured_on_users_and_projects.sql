
-- Add column is_featured on users and projects table


ALTER TABLE  `users` ADD  `is_featured` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0';

ALTER TABLE  `projects` ADD  `is_featured` ENUM(  '0',  '1' ) NOT NULL DEFAULT  '0';