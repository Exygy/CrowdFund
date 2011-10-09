<div id="edit-form">
<?php echo $form->create('Profile', array( 'url' => '/users/edit_password')); ?>
<fieldset>
<legend>Change your password:</legend>

<dl>
<?= $form->input('User.password', array('label'=>'Old Password', 'value'=>'')); ?>
</dl>

<dl>
<?= $form->input('User.new_password', array('type'=>'password', 'value'=>'') );?>
</dl>

</fieldset>
<?= $form->end('Change Password') ?>
</div>
