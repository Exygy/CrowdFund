<?php
class Contact extends Appmodel{
  var $name='Contact';
  var $validate = array( 'phone' => array(
					  'rule' => array('phone', null, 'us'),
					  'required' => false,
					  'allowEmpty' => true,
					  'message' => 'Valid phone numbers only'),
			 'zip' => array(
					'rule' => array('postal', null),
					'required' => false,
					'allowEmpty' => true,
					'message' => 'Numbers only'));
  					 
}
?>