<? if (!empty($photo)){ ?>
Current Photos
<? foreach($photo as $img){ ?>
<img src="<?= HTTP_BASE.'/img/'.$img['Image']['path'] ?>" height="150" />
<?php echo $ajax->link( 
	    'Delete', 
	    array( 'controller' => 'images', 'action' => 'remove_profile_pic', $img['Image']['id']), 
	    array( 'update' => 'current_photo' )
	); 
?>			

<? } } ?>
