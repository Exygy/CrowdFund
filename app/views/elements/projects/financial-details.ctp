										 		<form><? // this form is here for styling ?>

				<div id="budget">
					<? if (!empty($lineItems)): ?>
					<span>Financial Details: </span>
					<table>
					 <thead>
					  <tr>
					   <th>Item</th>
					   <th>Cost</th>
					   <th>Donate</th>
					  </tr>
					 </thead>
					 <tbody>
					 
					 <? $i=0; $j=0; ?>
					 <? foreach($lineItems as $lineItem) { ?>
					 <? // $lineItems comes grouped by category, so each time these aren't equal, we just got to a new bunch ?>
					 <? if ($lineItem['LineItemCategory']['title'] != $lineItemCategories[$i]) { ?>
					 	<? $i++; ?>					 	
					 	<tr>
						<td class="category"><?=$lineItem['LineItemCategory']['title']?></td>
						<td class="category">$<?=number_format($lineItemTotals[$i], 2, '.', ',');?></td>
						<td class="category"><?=$html->link( 'Donate This Amount', '/projects/donate/' . $lineItem['project_id'] . '/' . number_format($lineItemTotals[$i], 0, '', ',') )?></td>
						</tr>
					 <? } ?>	 
						 
					 	<? $lineItemTitle = $lineItem['title']; ?>
					 	<? if (strlen($lineItemTitle)>43) {
					 		$lineItemTitle = substr($lineItemTitle, 0, 40).'...'; ?>
			 				<div class="field-hint-inactive" id="line-<?=$j?>-H"><div><?=$lineItem['title']?> </div></div>					 			
					 	<?  } ?>


						  <tr>
						   <td class="line-item" id="line-<?=$j?>"><?=$lineItemTitle?></td>
						   <td class="item-cost">$<?=number_format($lineItem['amount'], 2, '.', ',');?></td>
						   <td><?=$html->link( 'Donate This Amount', '/projects/donate/' . $lineItem['project_id'] . '/' . number_format($lineItem['amount'], 0, '', ',') )?></td>
						  </tr>
					 <? $j++;
					    } ?>
					 
					 </tbody>
					</table>
					<? endif; ?>
					
				</div>
					 </form>
