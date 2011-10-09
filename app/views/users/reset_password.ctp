<?php echo $form->create('Profile', array( 'url' => '/users/reset_password')); ?>
<fieldset>
<dl>
Forgot your password? Enter your registered email address below and we'll reset it for you.
</dl>

<dl>
<?= $form->input('User.email', array('label'=>'Email', 'value'=>'')); ?>
</dl>
<dl><?= $form->end('Reset Password') ?></dl>
</fieldset>

