 ALTER TABLE `documents` CHANGE `type` `type` ENUM( 'scientist_doc', 'project_doc' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'scientist_doc' 
;
