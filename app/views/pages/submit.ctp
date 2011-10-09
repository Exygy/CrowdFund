		<?php echo $this->renderElement('header-simple'); ?>	
		<?php echo $this->renderElement('header-end'); ?>
	
	
	<div id="project-info" class="body-section">
		<h1 style="margin: 5px 0 0 15%;">Submit Your Proposal</h1>
	
		<div style="margin: 30px 0 0 15%;">

		<form action="">
		
		<fieldset>
		<legend>Project Overview</legend>

		<dl>
		<dt><label>Abstract</label></dt>
		<dd><textarea cols="50" rows="10" name="abstract"></textarea></dd>
		</dl>
		<dl>
		<dt><label>Background</label></dt>
		<dd><textarea cols="50" rows="5" name="background"></textarea></dd>
		</dl>
		<dl>
		</fieldset>
		
		<fieldset>
		<legend>Financial Details</legend>
		
		<dl>
		<dt><label>Goal</label></dt>
		<dd><input type="text" name="goal" /></dd>
		</dl>
		<dl>
		<dt><label>Individual Costs</label></dt>
		<dd><input type="password" name="pw" /> <input type="password" name="pw" /></dd>
		<dd><input type="password" name="pw" /> <input type="password" name="pw" /></dd>
		</dl>
		</fieldset>
		
		
		<fieldset>
		<legend>Media</legend>
		<dl>
		<dt><label>Images</label></dt>
		<dd><input type="file" name="image" size="30"></dd>
		</dl>
		<dl>
		<dt><label>Videos</label></dt>
		<dd><input type="input" name="video" size="30"></dd>
		</dl>
		</fieldset>

		
		<fieldset>
		<legend>Finish</legend>
		<dl>
		<p>Still working on it? Save a draft and finish your proposal later.</p>

		<dt></dt>
		<dd><button type="submit">Save Draft</button></dd>
		</dl>
		<dl>
		<p>Ready to submit? Go ahead and submit your proposal below.</p>
		<dt></dt>
		<dd><button type="submit">Submit</button></dd>
		</dl>

		
		
		</fieldset>
		
	
		</form>
		</div>
		

	</div>