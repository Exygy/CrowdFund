<?php 
class Profile extends AppModel{
  var $name='Profile';
  var $belongsTo=array(
		    'User'=>array(
				  'className'=>'User',
				  'foreignKey'=>'id'),
		    'Education'
		       );
  var $hasOne=array(
		    'Image'=>array(
				   'className'=>'Image',
				   'foreignKey'=>'foreign_id',
				   'conditions'=>array(
						       'Image.type'=>'profile',
						       'Image.active'=>1)
				   ),
		    'Contact'=>array(
				     'className'=>'Contact',
				     'foreignKey'=>'id'),
		    'Scientist'=>array(
				     'className'=>'Scientist',
				     'foreignKey'=>'id'),
		    );

  var $hasMany=array(
		     'Donation'=>array(
				      'className'=>'Donation',
				      'foreignKey'=>'user_id',
				      'fields'=> array('DISTINCT project_id')
				       ),
		     );
  /*,
		     'Project'=>array(
				      'className'=>'Project',
				      'foreignKey'
								*/
  var $hasAndBelongsToMany=array(
				 'Interest'=>array(
						   'className'=>'Interest',
						   'foreignKey'=>'user_id',
						   'associationForeignKey'=>'interest_id'),
				 'Expertise'=>array(
						   'joinTable' => 'expertises_scientists',
						   'className'=>'Expertise',
						   'foreignKey'=>'scientist_id',
						   'associationForeignKey'=>'expertise_id')
				 );
}
?>