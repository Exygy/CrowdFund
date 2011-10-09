		
			<dl>
			<div class="field-hint-inactive" id="data[Project][project_category_id]-H"><div><?=TT_PROJECT_CAT?></div></div>
			
	    	<?php echo $form->input('project_category_id', $projectCategories); ?>
			</dl>


			<dl>				
			<div class="field-hint-inactive" id="data[Project][title]-H"><div><?=TT_PROJECT_TITLE?> </div></div>
		
	    	<?php echo $form->input('title', array('after'=>'<span class="reqMark">*</span>', 'size'=>45)); ?>
			</dl>
			
	    	<dl>
		    <?php echo $form->input('abstract', array('after'=>'<span class="reqMark">*</span>', 'cols'=>64, 'rows'=>10)); ?>
			</dl>
			<dl>
		    <?php echo $form->input('background', array('after'=>'<span class="reqMark">*</span>', 'cols'=>64, 'rows'=>10)); ?>   
			</dl>
			<dl>
	    	<?php echo $form->input('homepage'); ?>
			</dl>
			<dl>
				<?php echo $form->input('problem', array('after'=>'<span class="reqMark">*</span>', 'cols'=>64, 'rows'=>5, 'label' => 'What is the problem your research will address?')); ?> 
			</dl>
			<dl>
				<?php echo $form->input('plan', array('after'=>'<span class="reqMark">*</span>', 'cols'=>64, 'rows'=>10, 'label' => 'What is your plan (very briefly)?')); ?> 
			</dl>
			<dl>
				<?php echo $form->input('impact', array('after'=>'<span class="reqMark">*</span>', 'cols'=>64, 'rows'=>5, 'label' => 'If your research is successful, what is the potential impact on society')); ?> 
			</dl>
			<dl>
			<p><span class="reqMark">*</span>Indicates this field is required.</p>
			</dl>
