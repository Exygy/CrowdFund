-- changing profiles.dob from datetime to date
 ALTER TABLE `profiles` CHANGE `dob` `dob` DATE NOT NULL DEFAULT '0000-00-00'; 

-- changing profiles.profession from text to varchar
 ALTER TABLE `profiles` CHANGE `profession` `profession` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL  ;

