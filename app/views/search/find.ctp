
	<div id="search-results">
		<h1>Search Results <? if (isset($searchstr)) echo 'for "'.$searchstr.'"';?></h1>

		<div class="clear"></div>
		<div id="search-items">
			<ul>
				<? foreach ($projects as $project) { ?>

				<?php echo $this->element('projects/search-item', array('project'=>$project)); ?>	
				
				<? } ?>
			</ul>
		</div> <!-- search-items -->

		<?php echo $this->element('projects/paginator'); ?>	
		
		

	</div> <!-- search-results -->
