	<div id="project-info" class="body-section">
		<h1 style="margin: 5px 0 0 15%;"><?=EUREKA_DONATE_TO_EN?> "<?=$this->data['Project']['title']?>"</h1>
	
		<div id="edit-form" style="margin: 30px 0 0 15%;">

<? if (empty($logged_in_user)){ ?>
<dl>Have an EurekaFund Account? <a href="<?= HTTP_BASE ?>projects/loginDonate/<?= $this->data['Project']['id'] ?>/<?= ($amt? $amt: '') ?>">Click here to login</a></dl>
<? } ?>

<?= $form->create('Donation', array( 'url' => '/projects/donate/' . $this->data['Project']['id'])) ?>
<?= $form->hidden('Donation.project_id', array( 'value' => $this->data['Project']['id'] ) ) ?>




<fieldset>
<legend>Donation Amount</legend>
<dl><?= $form->input('Donation.project_donation_amt', array( 'label' => "Donation Amount ($)" ) )?></dl>
<? if ( $this->data['Project']['id'] != 0 ) { ?>
<dl><?= $form->input('Donation.eureka_donation_amt', array( 'label' => "Would you like to donate also to Eureka Fund?", 'value'=>'0.00') )?></dl>
<dl>
<div class="multi" style="float:left; margin-top: 15px;">
<?= $form->input( 'Donation.flexible_donation', 
		  array( 'value' => '1',
			 'type' => 'checkbox',
			'checked'=>true,
			'label'=>'<span>If this project is not fully funded, my donation may be used for similar research at the discretion of EurekaFund.</span>'
			 )
		  );
?>
</div>
</dl>
<? } else { ?>
<dl><?= $form->input('Donation.eureka_donation_amt', array( 'type' => 'hidden', 'value'=>'0.00') )?></dl>
<dl><?= $form->input('Donation.flexible_donation', array( 'type' => 'hidden', 'value'=>'1') )?></dl>
<? } ?>
</fieldset>

<fieldset>
<legend>Billing Info</legend>
<dl><?= $form->input('Donation.fname', array( 'label' => "First Name" , 'value'=>(empty($logged_in_user) ? '' : $logged_in_user['User']['fname'])) )?></dl>
<dl><?= $form->input('Donation.lname', array( 'label' => "Last Name" , 'value'=>(empty($logged_in_user) ? '' : $logged_in_user['User']['lname'])) )?></dl>
<dl><?= $form->input('Donation.email', array( 'label' => "Email" , 'value'=>(empty($logged_in_user) ? '' : $logged_in_user['User']['email'])) )?></dl>
<dl><?= $form->input('Donation.user_id', array( 'type'=>'hidden', 'value'=>(empty($logged_in_user) ? '0' : $logged_in_user['User']['id'])) )?></dl>
<dl><?= $form->input('Donation.card_num', array( 'label' => "Card Number" ) )?></dl>
<dl><?= $form->input('Donation.card_cvv', array( 'label' => "Security Code" ) )?></dl>
<dl><?= $form->input('Donation.card_expiry', array( 'label' => "Expiration Date",
						    'dateFormat' => 'MY',
						    'minYear' => 2009,
						    'maxYear' => 2020 ) )?></dl>
<dl><?= $form->input('Donation.card_zip', array( 'label' => "Billing Zip Code" ) )?></dl>
</fieldset>

<?php echo $form->end('Donate!'); ?>
			
		
		</div>
		

	</div>
