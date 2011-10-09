<?php
class User_interest extends AppModel{
  var $name='User_interest';
  var $hasOne=array(
		    'User'=>array(
				  'className'=>'User'));
}
?>