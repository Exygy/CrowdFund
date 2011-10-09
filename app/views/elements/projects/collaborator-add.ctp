<?php echo $form->create('Collaborator', array('action' => 'add/')); ?>

	    <?php echo $form->input('fname', array('label'=>'First Name')); ?>
	    <?php echo $form->input('lname', array('label'=>'Last Name')); ?>
	    <?php echo $form->input('affiliation', array('label'=>'University')); ?>	    
	    <?php echo $form->input('description'); ?>
	    <?php echo $form->hidden('project_id', array('value' => $projectId)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>