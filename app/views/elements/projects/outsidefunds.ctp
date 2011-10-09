<div style="clear:both; margin: 0 5px;" id="outsideFund-<?=$outsideFund['id']?>">

	<span class="text" style="margin-right: 6px;"><?=$outsideFund['title']?>: $<?=number_format($outsideFund['amount'], 2, '.', ',')?> </span>
	<?php echo $ajax->link( 
				    'Delete', 
				    array( 'controller' => 'outside_funding_sources', 'action' => 'delete', $outsideFund['id']), 
				    array( 'update' => 'outsideFund-'.$outsideFund['id'] )
				); 
				?>		
		    		

 </div>