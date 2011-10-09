<?php
class OutsideFundingSource extends AppModel{
  var $name='OutsideFundingSource';
  var $belongsTo = 'Project';
  
    var $validate = array( 'title' => array(
					  'alphaNumeric' => array(
								  'rule' => array('custom', '/^[a-z0-9\'\- ]*$/i'),
								  'required' => true,
								  'message' => EUREKA_ERROR_ALPHA_EN
								  ),
					  'between' => array(
							     'rule' => array('between', 2, 50),
							     'message' => EUREKA_ERROR_FUNDING_TITLE_BETWEEN_EN
							     )
					  ),
			 'amount' => array(
					  'money' => array(
								  'rule' => array('money', 'left'),
								  'required' => true,
								  'message' => EUREKA_ERROR_MONEY_EN
								  )
					  ),
	);

}
?>