-- allow for projects to be labeled as "demo" for the initial launch
ALTER TABLE `projects` ADD `is_demo` ENUM( '0', '1' ) NOT NULL DEFAULT '1';
