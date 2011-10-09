<div class="body-section">


<?php if ($logged_in_user['User']['type'] == 'donor') { ?>

	<div id="project-intro">
	
	<h1>Submitting a Proposal</h1>
	<div id="project-intro-text">
		<p>When you signed up for EurekaFund, you told us you were a donor, not a scientist! </p>
		<p>Only scientists can submit proposals. Would you like to upgrade your account (for free) and submit a proposal?</p>
		<p> If so, please send us an email to 'upgrade-me@eurekafund.org'.</p>
	</div>
		
	</div>
	
	
	
<?php	} else { ?>

	<div id="project-intro">
	<h1>Submitting a Proposal</h1>
	
	
		<div id="project-intro-text">
		<p>Submitting a proposal on Eureka Fund is quick and straightforward. Here's how it works:</p>
		
		<p>You'll be taken through several steps and asked to provide the following information about your project:</p>
		<ol>
		<li>Basic background information for people to understand what the project is about</li>
		<li>Financial details of your budget (be specific)</li>
		<li>List of collaborators</li>
		<li>Detailed information about the research, including technical documentation, figures, images, and videos.</li>
		</ol>
		
		<p>The more information you provide during this process, the better chance you'll have of making it onto the Eureka Fund platform. You can save your project and come back to it at any time, and you'll be able to both preview and edit it before final submission to Eureka Fund.</p>
		
		<p>Once you submit a project to Eureka Fund it does not automatically go live on our website. It will be sent out for anonymous peer-review first, and if your project is selected for our website then somebody from Eureka Fund will contact you directly to review the project details. The process shouldn't take longer than a few weeks.</p>
		
		<p>Now that you understand how it works, <?php echo $html->link('let\'s get started', '/projects/add'); ?>...</p>
		</div>
		
		<div id="get-started">
		
		<?php echo $html->link('Get Started', '/projects/add'); ?> 
		
		</div> 
	 
	</div>

<?php } ?>
</div>
