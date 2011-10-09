		<div id="pagination">
		<!-- Passes args to paginator -->	
		<?php echo $paginator->options(array('url' => $this->passedArgs)); ?>

		<?php echo $paginator->prev(); ?> 

		<!-- Shows the page numbers -->
		<?php echo $paginator->numbers(); ?>
		<!-- Shows the next and previous links -->
		<?php echo $paginator->next(); ?> 
			<div class="counter">
			<!-- prints X of Y, where X is current page and Y is number of pages -->
			Page <?php echo $paginator->counter(); ?>
			</div>
		</div>
