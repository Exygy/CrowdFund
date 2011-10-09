<?php
class Scientist_expertise extends AppModel{
  var $name='Scientist_expertise';
  var $hasOne=array(
		    'Scientist'=>array(
				       'className'=>'Scientist'));
}
?>