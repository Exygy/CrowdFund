<div style="clear:both; margin: 0 5px;" id="collaborator-<?=$collaborator['id']?>">

	<span class="text" style="margin-right: 6px;"> <?=$collaborator['fname']?> <?=$collaborator['lname']?> <? if (!empty($collaborator['affiliation'])) echo '('.$collaborator['affiliation'].')'; ?> </span>
	<?php echo $ajax->link( 
				    'Delete', 
				    array( 'controller' => 'collaborators', 'action' => 'delete', $collaborator['id']), 
				    array( 'update' => 'collaborator-'.$collaborator['id'] )
				); 
				?>		
	
	<p class="floatleft" style="margin: 1px 0 5px 0; font-style:italic; font-size:0.9em;"> <?=$collaborator['description']?> </p>
	    		

 </div>