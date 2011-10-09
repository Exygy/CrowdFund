
	<div id="search-results">
		<h1>Current Proposals</h1>
		<div id="search-filters">
			<ul>
				<li>filter proposals by:</li>
				
				<? $i=0; ?>
				
				<? foreach ($projectCategories as $catId=>$category): ?>
					<? if ($i != (count($projectCategories)-1)): ?>
						<li><a href="<?=HTTP_BASE ?>projects/category/<?=$catId?>"><?=$category?></a> <span>|</span> </li>
					<? else: ?>
						<li><a href="<?=HTTP_BASE ?>projects/category/<?=$catId?>"><?=$category?></a></li>
					<? endif; ?>
					<? $i++; ?>
				<? endforeach; ?>
			</ul>
		</div>
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
