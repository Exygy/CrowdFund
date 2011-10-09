<?php echo $form->create('Profile', array( 'url' => '/users/edit', 'enctype' => 'multipart/form-data')); ?>
<?= $form->input( 'User.id', array( 'type' => 'hidden', 
				    'value' => $user_id ) ); ?>
