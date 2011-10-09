
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


		<!-- Passes args to paginator -->	
		<?php echo $paginator->options(array('url' => $this->passedArgs)); ?>
		<!-- Shows the page numbers -->
		<?php echo $paginator->numbers(); ?>
		<!-- Shows the next and previous links -->
		<?php
			echo $paginator->prev('Ç Previous ', null, null, array('class' => 'disabled'));
			echo $paginator->next(' Next È', null, null, array('class' => 'disabled'));
		?> 
		<!-- prints X of Y, where X is current page and Y is number of pages -->
		<?php echo $paginator->counter(); ?>

	</div> <!-- search-results -->
