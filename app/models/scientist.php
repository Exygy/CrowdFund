<?php
class Scientist extends Appmodel{
  var $name='Scientist';
  var $belongsTo=array(
		    'User'=>array(
				  'className'=>'User',
				  'foreignKey'=>'id'));
  var $hasMany=array(
		     'Document'=>array(
				   'className'=>'Document',
				   'foreignKey'=>'foreign_id',
				   'conditions'=>array(
						       'type'=>'scientist_cv')),
		     'Link'=>array(
				   'className'=>'Link',
				   'foreignKey'=>'foreign_id',
				   'conditions'=>array(
						       'type'=>'profile')),
		     'Document'=>array(
				       'className'=>'Document',
				       'foreignKey'=>'foreign_id',
				       'conditions'=>array(
							   'type'=>'scientist_cv')),
		     'Project'=>array(
				      'className'=>'Project',
				      'foreignKey'=>'user_id',
				      'conditions'=>array()));
  var $hasAndBelongsToMany=array(
				 'Expertise'=>array(
   						   'className'=>'Expertise',
						   'foreignKey'=>'scientist_id',
						   'associationForeignKey'=>'expertise_id'));

				 
}
?>