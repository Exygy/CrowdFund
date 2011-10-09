	
	<div id="project-info" class="body-section">
	
		<div id="edit-form">
		<h1>Submit Your Proposal</h1>

<?php echo $this->element('projects/form-steps', array('tab'=>1, 'projectId'=>'none', 'completed_steps'=>1)); ?>	

<fieldset>
<legend>Project Basics</legend>

			<div class="instructions"><?=EUREKA_PROJECT_STEP1_EN?></div>

			<?php echo $form->create('Project'); ?>
			
			<?php echo $this->element('projects/firstpage', array('projectCategories'=>$projectCategories)); ?>	
						
			<div class="submit-btn">
			<?php echo $form->end('Continue'); ?>
			</div>
		
		</div>
		

	</div>
