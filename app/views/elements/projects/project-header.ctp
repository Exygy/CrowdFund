		<? if ($project['status'] == 'NEW'): ?>

		<div class="preview">
			<div>PREVIEW</div>
			<p>This is a preview of how your proposal will look to potential donors. Feel free to continue editing until you are ready to submit your proposal for approval by EurekaFund.</p>
			
			<?php echo $html->link('Edit', '/projects/edit/1/'.$project['id'], array( 'class' => 'button' ) ); ?>	
			<?php echo $html->link('Submit for Approval', '/projects/submit/'.$project['id'], array( 'class' => 'button', 
			      	   		       	   	      					  	 'onclick'=>'return checkSubmit();')); ?>	
			
		</div>
			
		<? elseif ($project['status'] == 'PENDING'): ?>
		
		<div class="preview">
			<div>PENDING</div>
			<p>Your proposal is pending approval by EurekaFund.</p>
		</div>

		<? elseif ($project['is_demo'] == 1 ): ?>
		
		<div class="preview">
			<div>DEMO PROJECT</div>
			<p>This project is not yet being supported by Eureka Fund.  During our beta period, we've added a few projects like this to the site to illustrate to you what the site will look like when we leave Beta.  Don't fear!  You can still <?=$html->link( 'donate to this project', '/projects/donate/' . $project['id'] )?>: your funds will directed to Eureka Fund's growth!  Or, you can take a look at the <a href="/projects/category/0/1">live (non-demo) projects</a> we have on the site currently.</p>
		</div>
		
		<? endif; ?>
