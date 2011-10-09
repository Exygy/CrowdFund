	<?php echo $this->renderElement('header-simple'); ?>	
	<?php echo $this->renderElement('header-end'); ?>

<div style="margin: 30px 0 0 15%;">
<form action="<?= HTTP_BASE ?>user/login" method="post">

<h2>Login</h2>

<fieldset>

<dl>
<dt><label>Email</label></dt>
<dd><input type="text" name="email" /></dd>
</dl>
<dl>
<dt><label>Password</label></dt>
<dd><input type="password" name="password" /></dd>
</dl>
<dl>

<input type="submit" value="login"/>
</fieldset>
</div>
