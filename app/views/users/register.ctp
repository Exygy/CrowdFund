<div id="edit-form">

<fieldset>
<legend>Register</legend>

<? if ($success){ ?>
<p></p>
<? } else { ?>
<?php echo $form->create('User', array( 'url' => 'register')); ?>
<dl>
<div class="field-hint-inactive" id="data[User][fname]-H"><div><?=TT_USER_FNAME?></div></div>
<?= $form->input('User.fname', array('label'=>'First Name')) ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[User][lname]-H"><div><?=TT_USER_LNAME?></div></div>
<?= $form->input('User.lname', array('label'=> 'Last Name')); ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[User][email]-H"><div><?=TT_USER_EMAIL?></div></div>
<?= $form->input('User.email', array('label'=> 'Email')); ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[User][password]-H"><div><?=TT_USER_PASSWORD?></div></div>
<?= $form->input('User.password') ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[User][password_confirm]-H"><div><?=TT_USER_PASSWORD_CONFIRM?></div></div>
<?= $form->input('User.password_confirm', array( 'type' => 'password' ) ) ?>
</dl>

<dl>
User Type:
<span id="demo"> 
<a class="small_text" href="#">What is this?</a>
</span>
<div id="tooltip">
<u>Donors</u><br/>
If you're interested in browsing research projects, making donations and spreading the word, you're a Donor!
<br/><br/>
<u>Scientists</u><br/>
If you'll be submitting grant proposals and are willing to help peer-review projects, you're a Scientist!  Scientists are also able to browse and donate.  Unless you're planning on using Eureka Fund to raise money for your research, you should probably sign up as a donor.
</div> 
<script>
$(document).ready(function() {
    $("#demo a").tooltip('#tooltip'); 
});
</script>
<div class="multi"> 
	<div class="input radio"><input type="hidden" name="data[User][type]" id="UserType_" value="" />
		<input type="radio" name="data[User][type]" id="UserTypeDonor" value="donor"  class="switch-d"/>
		<label for="UserTypeDonor">Donor</label>
		<input type="radio" name="data[User][type]" id="UserTypeScientist" value="scientist" class="switch-s" />
		<label for="UserTypeScientist">Scientist</label>
	</div>

</div>
	
	
	

 
</dl> 
 


<dl>
<?= $form->end('Register') ?>
</dl>
<? } ?>
</fieldset>
</form>
</div>
