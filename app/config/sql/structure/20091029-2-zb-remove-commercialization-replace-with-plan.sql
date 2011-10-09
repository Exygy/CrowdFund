-- commercialization becomes plan
ALTER TABLE `projects` CHANGE `commercialization` `plan` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
