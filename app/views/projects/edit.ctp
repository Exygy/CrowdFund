<?         //echo $javascript->link('prototype.js');
  	       //echo $javascript->link('scriptaculous/scriptaculous.js'); ?>
  	       
<script type='text/javascript'>
jQuery.noConflict();
</script>

	<div id="project-info" class="body-section">
	
		<div id="edit-form">
		<h1>Submit Your Proposal</h1>


<?php echo $this->element('projects/form-steps', array('tab'=>$tab, 'projectId'=>$projectId, 'completed_steps'=>$completed_steps)); ?>	

<fieldset>
<legend><?=$tabtitle?></legend>

		
		<? switch ($tab) 
			{  case 1: ?>
			<!-- ====TAB 1==== -->
		 	
			<div class="instructions"><?=EUREKA_PROJECT_STEP1_EN?></div>
				
			<?php echo $form->create('Project', array('action' => 'edit/'.$tab.'/')); ?>

			<?php echo $this->element('projects/firstpage', array('projectCategories'=>$projectCategories)); ?>	
			
			<?php echo $this->element('projects/end-form'); ?>	
			
			<? break; ?> 
			
			<!-- ====TAB 2==== -->
			
			<? case 2: ?>
			<div class="instructions"><?=EUREKA_PROJECT_STEP2_EN?></div>
			
			<? if (!empty($this->data['LineItem'])): ?>
				<div id="budget" class="indented">
				<h2>Itemized Budget:</h2>			
					<table>
					 <thead>
					  <tr>
					   <th>Item</th>
					   <th>Cost</th>
					  </tr>
					 </thead>
					 <tbody>
					 
					 	<? foreach ($lineItemCategories as $catId=>$lineItemCategory) { ?>
			
							<? $current = 'unselected'; ?>
						
							<? 	if (!empty($this->data['LineItem'])) {  ?>
							<? 		foreach ($this->data['LineItem'] as $id=>$lineItem) { ?> 
									
									<? if ($lineItem['line_item_category_id'] == $catId) { ?>
										
										<? if ($current == 'unselected') { ?>
										 	<tr><td class="category"><?=$lineItemCategory?></td><td class="category">&nbsp;</td></tr>
											<? $current = 'selected'; ?>
										<? } ?>
										<?php echo $this->element('projects/lineitems', array('projectId' => $projectId, 'id'=>$id,'lineItem'=>$lineItem)); ?>	
									<? } ?>
							
							<?      } ?>
							<?  } ?>
							
						<? } ?>
						
					 </tbody>
					</table>					
				</div>
			<? endif; ?>

			
			<div class="clear"></div>
			<fieldset>
			<legend>Add Line Item</legend>	
			<div id="add-line">
			<?php echo $this->element('projects/lineitem-add', array('projectId' => $projectId, 'categories'=>$lineItemCategories)); ?>
			</div>	    	
			</fieldset>
			
			
				<? 	if (!empty($this->data['OutsideFundingSource'])) {  ?>
				<div class="indented">	
				<h2>Outside Funding Sources:</h2>			
				<? 		foreach ($this->data['OutsideFundingSource'] as $id=>$outsideFund) { ?> 
				
						<dl>
						<?php echo $this->element('projects/outsidefunds', array('projectId' => $projectId, 'id'=>$id,'outsideFund'=>$outsideFund)); ?>	
						</dl>
				
				<?      } ?>
				</div>
				<?  } ?>
			
			<div class="indented">	
			<? $onclick = "Effect.toggle('add-outsideFund','blind', { duration: 0.4 });"; ?>
			<? echo $form->label('outsidecheck', 'If this project has sources of funding outside of Eureka Fund, please check this box:', array('style'=>'width:370px;')); ?>
			<? echo $form->checkbox('outsidecheck', array('onclick'=>$onclick)); ?>
			</div>
			
			<dl class="clear"></dl>
			
			<fieldset id="add-outsideFund" style="display:none">
			<legend>Add Outside Funding Source</legend>	
			<div class="instructions">Please list the details for your outside funding source and the amount of funding you have already received.</div>
			<br/>
			<div>
			<?php echo $this->element('projects/outsidefund-add', array('projectId' => $projectId)); ?>	
			</div>	    	
			</fieldset>

			
			
			
			
			<?php echo $form->create('Project', array('action' => 'edit/'.$tab.'/')); ?>	
	    	<?php echo $form->hidden('nothing'); //just so $this->data ain't empty?>
			<?php echo $this->element('projects/end-form'); ?>				

			<? break; ?>

			<!-- ====TAB 3==== -->
			
			<? case 3: ?>
			<div class="instructions"><?=EUREKA_PROJECT_STEP3_EN?></div>
			
				<? 	if (!empty($this->data['Collaborator'])) {  ?>
				<? 		foreach ($this->data['Collaborator'] as $id=>$collaborator) { ?> 
				
						<dl>
						<?php echo $this->element('projects/collaborators', array('projectId' => $projectId, 'id'=>$id,'collaborator'=>$collaborator)); ?>	
						</dl>
				
				
				<?      } ?>
				<?  } ?>
				


			<dl class="clear"></dl>
			
			<? if (!empty($this->data['Collaborator'])) {
				$expand = '[+]';
			} else {
				$expand = '[-]';
			} ?>

			
			<fieldset>
			<legend class="pointer" onclick="Effect.toggle('add-collab','blind', { duration: 0.4 }); toggleExpand(1); return false;">Add Collaborator <span id="expandable1"><?=$expand?></span></legend>	
			<div id="add-collab" <? if (!empty($this->data['Collaborator'])) echo 'style="display:none"'; ?>>
			<?php echo $this->element('projects/collaborator-add', array('projectId' => $projectId)); ?>	
			</div>	    	
			</fieldset>
			
			<?php echo $form->create('Project', array('action' => 'edit/'.$tab.'/')); ?>	
	    	<?php echo $form->hidden('nothing'); //just so $this->data ain't empty?>
			<?php echo $this->element('projects/end-form'); ?>	

			<? break; ?>

			<!-- ====TAB 4==== -->
			
			<? case 4: ?>
			<div class="instructions"><?=EUREKA_PROJECT_STEP4_EN?></div>
			
			<div class="domtab">
			  <ul class="domtabs">
			    <li><a href="#t1">Links</a></li>
			    <li><a href="#t2">Images</a></li>
			    <li><a href="#t3">Videos</a></li>
			    <li><a href="#t4">Files</a></li>
			  </ul>
			  
			  <!-- Links Tab -->	  
			  <div class="tab-content">
			    <a name="t1" id="t1"><? if (!empty($this->data['Link'])) echo '<h2>Current Links:</h2>';  ?></a>

					<? $i=0; ?>
						<? 	if (!empty($this->data['Link'])) {  ?>
						<? 		foreach ($this->data['Link'] as $id=>$link) { ?> 
						
								<dl>
								<?php echo $this->element('projects/links', array('id'=>$id,'link'=>$link)); ?>	
								</dl>
						
						
						<?      } ?>
						<?  } ?>
						
		
		
					<dl class="clear"></dl>
					<fieldset>
					<legend>Add Link</legend>	
					<div id="add-link">
					<?php echo $this->element('projects/link-add', array('foreign_id' => $projectId, 'type'=>'project', 'action'=>'add')); ?>		    	
					</div>	    	
					</fieldset>

			  </div>
			  
			  <!-- Images Tab -->	  			  
			  <div class="tab-content">
				<div class="instructions">Click and drag the arrows to rearrange your images. The leftmost image will be used as your primary image on your project page, and in search results.</div>
			    <a name="t2" id="t2"><? if (!empty($this->data['Image'])) echo '<h2>Current Images:</h2>';  ?></a>
					<? $i=0; ?>
						<? 	if (!empty($this->data['Image'])) {  ?>
						<? $sortedImages = $this->data['Image'];
						//pr($sortedImages);
						  usort($sortedImages, 'orderCmp');
						
								?>

						<ul id="sort_images" class="sortable">
						<? 		foreach ($sortedImages as $image) { ?> 
						
								<? $id=$image['id']; ?>
								<li id="item_<?=$id?>">
								<?php echo $this->element('projects/images', array('id'=>$id,'image'=>$image)); ?>	
								</li>
						
						
						<?      } ?>
						</ul>
						<?  } ?>
						
		
		
					<dl class="clear"></dl>
					<fieldset>
					<legend>Add Image</legend>	
					<div id="add-image">
					<?php echo $this->element('projects/image-add', array('foreign_id' => $projectId, 'type'=>'project')); ?>		    	
					</div>	    	
					</fieldset>
		
			  </div>
			  
			  <!-- Videos Tab -->	  			  
			  <div class="tab-content">
			    <a name="t3" id="t3"><? if (!empty($this->data['EmbeddedVideo'])) echo '<h2>Current Videos:</h2>';  ?></a>

					<? $i=0; ?>
						<? 	if (!empty($this->data['EmbeddedVideo'])) {  ?>
						<? 		foreach ($this->data['EmbeddedVideo'] as $id=>$embeddedvideo) { ?> 
						
								<dl>
								<?php echo $this->element('projects/embeddedvideos', array('id'=>$id,'embeddedvideo'=>$embeddedvideo)); ?>	
								</dl>
						
						
						<?      } ?>
						<?  } ?>
						
					<dl class="clear"></dl>
					<fieldset>
					<legend>Add YouTube Video</legend>	
					<div id="add-youtube">
					<?php echo $this->element('projects/embeddedvideo-add', array('foreign_id' => $projectId, 'type'=>'project')); ?>		    	
					</div>	    	
					</fieldset>
		
			  </div>
			  

			  <!-- Files Tab -->	  			  
  			  <div class="tab-content">
			    <a name="t4" id="t4"><h2>Files</h2></a>
					<fieldset>
					<legend>Add Document</legend>	
					<div id="add-doc">
					<?php echo $this->element('projects/document-add', array('foreign_id' => $projectId, 'type'=>'project_doc', 'action'=>'upload/')); ?>		    	
					</div>	    	
					</fieldset>

			  </div>


			</div> <!-- end domtabs -->
		
	

			<?php echo $form->create('Project', array('action' => 'edit/'.$tab.'/')); ?>	
	    	<?php echo $form->hidden('nothing'); //just so $this->data ain't empty?>
			<?php echo $this->element('projects/end-form'); ?>	
			
			
				<script type="text/javascript">

			    Sortable.create("sort_images", {
			      overlap: 'horizontal',
			      constraint: 'horizontal',
			      handle: 'handle',
			      onUpdate: function() {
				      new Ajax.Request("/images/sort", {
				      method: "post",
				      parameters: { data: Sortable.serialize("sort_images") }
				      });
			      }
			    });
			    	
				</script>
		
			

			<? break; ?>

			<!-- ====TAB 5==== -->
			
			<? case 5: ?>
			<div class="instructions"><?=EUREKA_PROJECT_STEP5_EN?></div>



			<?php echo $form->create('Project', array('action' => 'submit/'.$projectId, 'onsubmit'=>'return checkSubmit();')); ?>	
			
			<div class="submit-btn">
			<?php echo $form->end('Submit'); ?>
			</div>
			
			<?php echo $form->create('Project', array('action' => 'edit/'.$tab.'/')); ?>
			<div class="submit-btn">			
			<?php echo $form->submit('Preview', array('name'=>'data[form_action][preview]')); ?>
			</div>

			<? break; ?>
			
			
			<? default: ?>

			<? break; ?>

		<? } //end switch ?> 		
		
		</fieldset>
		
		</div>
		

	</div>
	
