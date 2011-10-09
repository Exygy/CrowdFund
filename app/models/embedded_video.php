<?php
class EmbeddedVideo extends AppModel{
  var $name='EmbeddedVideo';

        var $validate = array(
  					  'title' => array(
						  'alphaNumeric' => array(
									  'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
									  'allowEmpty' => true,
									  'message' => EUREKA_ERROR_ALPHA_EN
									  ),
						  'between' => array(
								     'rule' => array('between', 2, 50),
								     'message' => EUREKA_ERROR_VIDEO_TITLE_BETWEEN_EN
								     )
						  ),
					'path' => array(
						  'URL' => array(
						  		  'rule' => 'URL',
						  		  'required' => true,
								  'message' => EUREKA_ERROR_URL_VALID_EN 						  
						  		  )
					 )
		);


  
}
?>