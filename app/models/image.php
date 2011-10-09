<?php
class Image extends AppModel{
  var $name='Image';
  
  
  
  
  var $validate = array(
  					  'title' => array(
						  'alphaNumeric' => array(
									  'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
									  'allowEmpty' => true,
									  'message' => EUREKA_ERROR_ALPHA_EN
									  ),
						  'between' => array(
								     'rule' => array('between', 2, 50),
								     'message' => EUREKA_ERROR_LINK_TITLE_BETWEEN_EN
								     )
						  ),
					'path' => array(
						  'URL' => array(
						  		  'rule' => array('minLength', 1),
						  		  'required' => true,
								  'message' => EUREKA_ERROR_URL_VALID_EN 						  
						  		  )
					 )
		);
		function deactivate_pics($user_id){
		  $this->query("UPDATE images SET active=0 WHERE active >0 AND type='profile' AND foreign_id=".$user_id);
		}

}
?>