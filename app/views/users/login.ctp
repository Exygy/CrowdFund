<div id="edit-form">


<fieldset>
<h2>Existing Users: Log in</h2>
<?php
$session->flash('auth');
echo $form->create('User', array('action' => 'login')); 
?>

<dl>
<div class="field-hint-inactive" id="data[User][email]-H"><div><?=TT_USER_LOGIN_EMAIL?></div></div>
<?= $form->input('email') ?>
</dl>

<dl>
<div class="field-hint-inactive" id="data[User][password]-H"><div><?=TT_USER_LOGIN_PASSWORD?></div></div>
<?= $form->input('password') ?>
<span class="small_text help_text"><a href="<?= HTTP_BASE ?>users/reset_password">Forgot your password?</a> </span>
</dl>

<?= $form->end('Login') ?>
</fieldset>

<fieldset>
<h2>New users: Join us!</h2>
<div class="register">
It's easy and it's free!  <?=$html->link('Sign up here', '/users/register')?>
</div>
</fieldset>
</div>
