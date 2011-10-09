<?php
class OauthUserToken extends AppModel{
	var $name='OauthUserToken';
	var $belongsTo = array(
						'User'=>array(
						'className'=>'User',
						'foreignKey'=>'id'));
}
?>