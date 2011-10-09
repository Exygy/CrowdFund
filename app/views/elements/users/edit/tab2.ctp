<?=$this->element( 'users/edit/basic-user-form-start' )?>
<fieldset>
<legend>Your Details</legend>

<dl id="current_photo">
<?= $this->element('users/profile_photos', $photo) ?>
</dl>

<dl>
<?php echo $form->label('Image.path', 'Profile Photo'); ?>
<?php echo $form->file('Image.path'); ?>
</dl>

<dl>
<div class="field-hint-inactive" id="data[Profile][description]-H"><div><?=TT_PROFILE_DESCRIPTION?></div></div>
<?= $form->input('Profile.description', array('label' => 'What is your interest in EurekaFund?', 'cols'=>65, 'rows'=>10 ) ); ?>
</dl>

<dl>
<div class="field-hint-inactive" id="data[Profile][profession]-H"><div><?=TT_PROFILE_PROFESSION?></div></div>
<?= $form->input('Profile.profession') ?>
</dl>

<dl><?= $form->input( 'Profile.education_id', array ( 'type' => 'select',
								   'options' => $education,
								   'empty' => false )
					      );
?></dl>

<dl>
<div class="multi">
<? echo $form->input('Interest', array( 'type'=>'select', 
					'multiple'=>'checkbox', 
					'options'=>$interests, 
					'label'=>'Interests'));?> 
</div>
</dl>

</fieldset>
