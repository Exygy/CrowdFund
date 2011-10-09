<?php echo $form->create('Link', array('action' => $action)); ?>
<div class="field-hint-inactive" id="data[Link][path]-H"><div><?=TT_LINK_URL?></div></div>
	    <?php echo $form->input('path', array('label' => "URL", 'value'=>'')); ?>
<div class="field-hint-inactive" id="data[Link][title]-H"><div><?=TT_LINK_TITLE?></div></div>
	    <?php echo $form->input('title', array('value'=>'')); ?>
<div class="field-hint-inactive" id="data[Link][description]-H"><div><?=TT_LINK_DESCRIPTION?></div></div>
	    <?php echo $form->input('description', array('value'=>'', 'rows' => 10,  'cols' => 65)); ?>
	    <?php echo $form->hidden('foreign_id', array('value' => $foreign_id)); ?>
	    <?php echo $form->hidden('type', array('value' => $type)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>
