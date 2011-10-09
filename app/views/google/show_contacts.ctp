<div class="body-section">
<h1>Your contacts :</h1>
 
 

<?=$form->create('Google', array( 'url' => '/google/recap' )); ?>
	
<div class="multi">
	<div style="overflow:auto;height:300px;"> 
		<?=$form->input('contact', array( 'options' => $contacts, 'type' => 'select', 'multiple' => 'checkbox', 'label' => 'Select yout contacts' )); ?>
	</div>
</div>

		<?=$form->input('project_id', array( 'value' => $project_id , 'type' => 'hidden')); ?>

<br/>
<?=$form->end('Next'); ?>
	

</div>