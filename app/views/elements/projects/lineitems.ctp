
	<tr id="lineItem-<?=$lineItem['id']?>">
						   <td class="line-item"><?=$lineItem['title']?></td>
						   <td class="item-cost">$<?=number_format($lineItem['amount'], 2, '.', ',');?></td>
	
	<td>
    	  
  		<?php echo $html->link(
		    'Delete',
		    array('controller'=>'line_items', 'action'=>'delete', $lineItem['id']),
		    array(),
		    "Are you sure you want to delete this line item?"
		);?>

	</td>
	
	</tr>


