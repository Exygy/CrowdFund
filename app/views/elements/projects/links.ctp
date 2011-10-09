<div class="" style="margin: 0 5px;" id="link-<?=$link['id']?>">

<a href="<?=$link['path']?>" target="_blank"><? echo (!empty($link['title'])) ? $link['title'] : $link['path']; ?></a>: <?=$link['description']?>

	    	<?php echo $ajax->link( 
			    'Delete', 
			    array( 'controller' => 'links', 'action' => 'delete', $link['id']), 
			    array( 'update' => 'link-'.$link['id'] )
			); 
			?>			

</div>
