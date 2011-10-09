 ALTER TABLE `projects` CHANGE `status` `status` ENUM( 'NEW', 'PENDING', 'APPROVED', 'INACTIVE' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NEW';
 