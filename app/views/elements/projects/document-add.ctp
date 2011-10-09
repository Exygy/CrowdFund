<?php echo $form->create('Document', array('action' => $action, 'enctype' => 'multipart/form-data')); ?>
<div class="field-hint-inactive" id="data[Document][title]-H"><div><?=TT_DOCUMENT_TITLE?></div></div>
	    <?php echo $form->input('title'); ?>
	    <?php echo $form->label('filedata', 'Your File'); ?>
      	    <?php echo $form->file('filedata'); ?>
<div class="field-hint-inactive" id="data[Document][description]-H"><div><?=TT_DOCUMENT_DESCRIPTION?></div></div>
	    <?php echo $form->input('description', array('value'=>'', 'cols'=>65, 'rows'=>10)); ?>
	    <?php echo $form->hidden('foreign_id', array('value' => $foreign_id)); ?>
	    <?php echo $form->hidden('type', array('value' => $type)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>
