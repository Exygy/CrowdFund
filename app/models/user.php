<?php
class User extends AppModel{
  var $name='User';
  // var $hasOne=array( 'Scientist' );
  
  var $validate = array( 'fname' => array(
					  /*
					  'alphaNumeric' => array(
								  'rule' => 'alphaNumeric',
								  'message' => EUREKA_ERROR_ALPHA_EN
								  ), */
					  'between' => array(
							     'rule' => array('between', 2, 25),
							     'message' => EUREKA_ERROR_USER_FNAME_BETWEEN_EN
							     ),
					  'notEmpty' => array( 'rule' => 'notEmpty' ),
					  ),
			 'lname' => array( 
					  /*
					  'alphaNumeric' => array(
								  'rule' => 'alphaNumeric',
								  'message' => EUREKA_ERROR_ALPHA_EN
								  ), */
					  'between' => array(
							     'rule' => array('between', 2, 25),
							     'message' => EUREKA_ERROR_USER_LNAME_BETWEEN_EN
							     ),
					  'notEmpty' => array( 'rule' => 'notEmpty' ),
					  ),
			 'email' => array( 'email' => array( 
							    'rule' => 'email',
							    'message' => EUREKA_ERROR_EMAIL_VALID_EN
							     ),
					   'isUnique' => array ( 
								'rule' => 'isUnique',
								'message' => EUREKA_ERROR_EMAIL_UNIQUE_EN
								 ),
					   'notEmpty' => array( 'rule' => 'notEmpty' )

					  ),
			 'password' => array(
					     'between' => array( 'rule' => array( 'between', 6, 32 ),
								 'message' => EUREKA_ERROR_PASSWORD_BETWEEN_EN
								 ),
					     'notEmpty' => array( 'rule' => 'notEmpty' )
					     ),
			 'password_confirm' => array(
						     'notEmpty' => array( 'rule' => 'notEmpty',
									  'message' => EUREKA_ERROR_PASSWORD_CONFIRM_EN ),
						     'password_confirm' => array( 'rule' => array( 'confirmPassword', 'password' ),
										  'message' => EUREKA_ERROR_PASSWORD_CONFIRM_EN ),
						     ),
												  
			 'type' => array(
					 'rule'=>array( 'multiple', 
							array( 
							       'in'=>array('donor', 'scientist'))),
					 'message' => EUREKA_ERROR_USERTYPE_REQD_EN
					 )
			 );

  function confirmPassword($data) {
    $valid = false;

    if ($this->data['User']['password'] == Security::hash(Configure::read('Security.salt') . $this->data['User']['password_confirm'])) {
      $valid = true;
    }
    
    return $valid;
  }

  
  function checkHash($id){
    $user=$this->findById($id);
    return !empty($user['User']['hash']);
  }
			
		      
}
?>
