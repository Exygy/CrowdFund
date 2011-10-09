<?php echo $form->create('LineItem', array('action' => 'add/')); ?>

   		<?php echo $form->label('line_item_category_id', 'Category'); ?>
	    <?php echo $form->select('line_item_category_id', array($categories), null, null, false); ?>
		<div class="field-hint-inactive" id="data[LineItem][title]-H"><div><?=TT_LINE_ITEM_TITLE?></div></div>

	    <?php echo $form->input('title'); ?>
		<div class="field-hint-inactive" id="data[LineItem][amount]-H"><div><?=TT_LINE_ITEM_AMOUNT?></div></div>
	    
	    <?php echo $form->input('amount', array('label'=>'Amount ($)')); ?>
	    <?php echo $form->hidden('project_id', array('value' => $projectId)); ?>

<div class="submit-btn-small">
<?php echo $form->end('Add'); ?>
</div>