<?php echo $form->create('Image', array('action' => 'upload/', 'enctype' => 'multipart/form-data')); ?>

	    <?php echo $form->input('title'); ?>
	    <?php echo $form->label('filedata', 'Image File'); ?>
	    <?php echo $form->file('filedata'); ?>
	    <?php echo $form->input('description', array('rows' => 10,  'cols' => 65) ); ?>
	    <?php echo $form->hidden('foreign_id', array('value' => $foreign_id)); ?>
	    <?php echo $form->hidden('type', array('value' => $type)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>