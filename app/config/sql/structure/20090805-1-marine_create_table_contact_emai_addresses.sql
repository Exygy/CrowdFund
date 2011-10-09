CREATE TABLE `contact_email_addresses` (
`id` INT( 11 ) NOT NULL ,
`sender_user_id` INT( 11 ) NOT NULL ,
`custom_text` VARCHAR( 255 ) NOT NULL ,
`email_type` ENUM(  'project',  'donation' ) NOT NULL ,
`email_address` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `id` )
) ENGINE = MYISAM