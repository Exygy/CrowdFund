<div class="" style="margin: 0 5px;" id="doc-<?=$link['id']?>">

<?=$html->link( (!empty($link['title'])) ? $link['title'] : $link['path'], '/files/uploaded/' . $link['path'] )?> : <?=$link['description']?>

	    	<?php echo $ajax->link( 
			    'Delete', 
			    array( 'controller' => 'documents', 'action' => 'delete', $link['id']), 
			    array( 'update' => 'doc-'.$link['id'] )
			); 
			?>			

</div>
