<?php
class Collaborator extends AppModel{
  var $name='Collaborator';
  var $belongsTo = 'Project';
  
    var $validate = array( 'fname' => array(
    				/* alphaNumeric rule doesn't allow hyphenated (-) or double last name (white space)
					  /*'alphaNumeric' => array(
								  'rule' => 'alphaNumeric',
								  'required' => true,
								  'message' => EUREKA_ERROR_ALPHA_EN
								  ),*/
					  'between' => array(
							     'rule' => array('between', 2, 25),
							     'message' => EUREKA_ERROR_USER_FNAME_BETWEEN_EN
							     )
					  ),
			 'lname' => array(
					  /*'alphaNumeric' => array(
								  'rule' => 'alphaNumeric',
								  'required' => true,
								  'message' => EUREKA_ERROR_ALPHA_EN
								  ), */
					  'between' => array(
							     'rule' => array('between', 2, 25),
							     'message' => EUREKA_ERROR_USER_LNAME_BETWEEN_EN
							     )
					  ),
	);

}
?>