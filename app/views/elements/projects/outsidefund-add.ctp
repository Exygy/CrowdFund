<?php echo $form->create('OutsideFundingSource', array('action' => 'add/')); ?>

	    <?php echo $form->input('title', array('label'=>'Funding Source')); ?><br/>
	    <?php echo $form->input('amount', array('label'=>'Amount ($)')); ?>
	    <?php echo $form->hidden('project_id', array('value' => $projectId)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>