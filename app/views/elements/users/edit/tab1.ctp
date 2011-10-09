<?=$this->element( 'users/edit/basic-user-form-start' )?>
<div style="float:left;">
<fieldset>
<legend>Personal Info</legend>

<dl>
<div class="field-hint-inactive" id="data[User][fname]-H"><div><?=TT_USER_FNAME?></div></div>
<?= $form->input('User.fname', array('label'=>'First Name')); ?>
</dl>

<dl>
<div class="field-hint-inactive" id="data[User][lname]-H"><div><?=TT_USER_LNAME?></div></div>
<?= $form->input('User.lname', array('label'=>'Last Name') ); ?>
</dl>

<dl>
<?= $form->input('Profile.dob', array( 'empty' => true,
    				       'minYear'=> 1900, 
				       'maxYear' => 2009 ) );?>
</dl>

<dl>
<?php echo $form->label('Profile.gender', 'Gender'); ?>
<div class="multi">
<?= $form->input( 'Profile.gender', 
		  array( 'options' => array( 'male' => 'male', 
					     'female' => 'female' ),
			 'type' => 'radio',
			 'legend' => false,
			 'class'=> 'multi-choice'
			 )
		  );
?>
</div>
</dl>

<dl>
<div class="field-hint-inactive" id="data[User][email]-H"><div><?=TT_USER_EMAIL?></div></div>
<?= $form->input('User.email' ); ?>
</dl>

<dl>
<label>Password</label>
**** [<a href="<?= HTTP_BASE ?>users/edit_password">edit password</a>]
</dl>


</fieldset>
</div>

<div style="float:right;">
<fieldset>
<legend>Contact Info</legend>

<dl>
<div class="field-hint-inactive" id="data[Contact][address]-H"><div><?=TT_CONTACT_ADDRESS?></div></div>
<?= $form->input('Contact.address' ); ?></dl>
<dl>
<div class="field-hint-inactive" id="data[Contact][city]-H"><div><?=TT_CONTACT_CITY?></div></div>
<?= $form->input('Contact.city' ); ?>
</dl>
<dl><label>State</label><?= $form->select('Contact.state', $geography->stateList(), (isset($this->data['Contact']['state']) ? $this->data['Contact']['state'] : 'CA'), array('label'=>'State')); ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[Contact][zip]-H"><div><?=TT_CONTACT_ZIP?></div></div>
<?= $form->input('Contact.zip' ); ?>
</dl>
<dl>
<div class="field-hint-inactive" id="data[Contact][phone]-H"><div><?=TT_CONTACT_PHONE?></div></div>
<?= $form->input('Contact.phone' ); ?>
</dl>

</fieldset>
</div>

<div class="clear"></div>
