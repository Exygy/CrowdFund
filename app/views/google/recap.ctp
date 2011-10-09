<div class="body-section">
<h1>Your contacts :</h1>


	<?=$form->create('Google', array( 'url' => '/google/message' )); ?>
	<div class = "recap"> <p>You're going to send an email to :</p>
	<ul>

	<?php 
	if (isset( $contacts )):
	
	foreach ($contacts as $friend) { 	?>
		
			<li><?=$friend;?></li>
			
	<?php 
	}
	endif;
	$contacts_encoded = urlencode( implode( ',', $contacts ) );
	 ?>
	
	</ul>
	</div>
	
	<br/>
	<?=$form->input('contacts_encoded', array( 'value' => $contacts_encoded , 'type' => 'hidden')); ?>
	<?=$form->input('project_id', array( 'value' => $project_id , 'type' => 'hidden')); ?>
	<?=$form->input('Message', array('cols'=>64, 'rows'=>10, 'label' => 'Personalize your message: ', 'value' => 'EurekaFund is a new way to fund science -- directly by the public.  You can learn about and support the technologies that will lead us to a cleaner safer future.   Check out this project I found on here that I thought you might like.')); ?> 

	

	<?=$form->end('Submit'); ?>
