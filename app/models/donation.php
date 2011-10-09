<?php
class Donation extends AppModel {
  var $name = 'Donation';
  var $belongsTo = array(
			 'User' => array(
					 'className'  => 'User'
					 ),
			 'Project' => array(
					    'className'  => 'Project'
					    )
			 
			 );
  
  var $validate = array( 'card_num' => array(
					  'cc' => array(
							'rule' => array('cc', 'all', false, null),
							'message' => EUREKA_ERROR_CC_RULE_EN
							),
					  
						),
			 'card_zip' => array(
					     'postal' => array( 
							       'rule' => 'postal',
							       'message' => EUREKA_ERROR_ZIP_RULE_EN
								)
					     ),
			 'fname' => array(
					  'rule'=>'notEmpty',
					  'message'=>'You must enter a first name'),
			 'lname'=> array(
					 'rule'=>'notEmpty',
					 'message'=> 'You must enter a last name'),
			 'email'=> array(
					 'rule'=> 'email',
					 'message'=>'You must enter a valid email address')
			 
			 );

}
?>