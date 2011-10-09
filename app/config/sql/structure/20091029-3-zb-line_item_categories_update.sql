-- updating line item categories and making sure that doesn't lead to broken line items
UPDATE `line_item_categories` SET `title` = 'personnel and wages' WHERE `line_item_categories`.`id` =5 LIMIT 1 ;
UPDATE `line_item_categories` SET `title` = 'materials and equipment' WHERE `line_item_categories`.`id` =3 LIMIT 1 ;
DELETE FROM `line_item_categories` WHERE `line_item_categories`.`id` =7 LIMIT 1 ;
DELETE FROM `line_item_categories` WHERE `line_item_categories`.`id` =9 LIMIT 1 ;
UPDATE `line_items` SET line_item_category_id =5 WHERE line_item_category_id =9;
UPDATE `line_items` SET line_item_category_id =3 WHERE line_item_category_id =7;
