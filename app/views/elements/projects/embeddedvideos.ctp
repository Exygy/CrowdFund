<div class="floatleft video-thumbnails" style="margin: 0 5px;" id="embeddedvideo-<?=$embeddedvideo['id']?>">

<?=$embeddedvideo['embed']?>

	    	<?php echo $ajax->link( 
			    'Delete', 
			    array( 'controller' => 'embedded_videos', 'action' => 'delete', $embeddedvideo['id']), 
			    array( 'update' => 'embeddedvideo-'.$embeddedvideo['id'] ),
   			    'Are you sure you want to delete this video?'

			); 
			?>			

</div>