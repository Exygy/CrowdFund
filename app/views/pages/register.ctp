<div style="margin: 30px 0 0 15%;">
<form action="<?= HTTP_BASE ?>users/signup" method="post">

<fieldset>
<legend>Register</legend>
<dl>
What type of user are you?
<input id="radioPublic" name="type" value="donor" type="radio"> <label for="donor">Public Donor</label> <input id="radioScientist" name="type" value="scientist" type="radio"> <label for="radioScientist">Scientist</label>
</dl>
<dl>
<dt><label>First Name</label></dt>
<dd><input type="text" name="fname" /></dd>
</dl>
<dl>
<dt><label>Last Name</label></dt>
<dd><input type="text" name="lname" /></dd>
</dl>
<dl>
<dt><label>Email Address</label></dt>
<dd><input type="text" name="email" /></dd>
</dl>
<dl>
<dt><label>Password</label></dt>
<dd><input type="password" name="password" /></dd>
</dl>
<dl>
<dt><label>Confirm</label></dt>
<dd><input type="password" name="password2" /></dd>
</dl>
<dl>
<dt></dt>
<dd><button type="submit">Register</button></dd>
</dl>

</fieldset>
</form>
</div>
