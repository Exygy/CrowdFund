<div class="thumbnails" style="margin: 0 5px;" id="image-<?=$image['id']?>">


<a href="<?=IMG_UPLOAD_DIR.$image['path']?>" rel="lightbox[project]" title="<?=$image['title']?>"><img src="<?=IMG_UPLOAD_THUMBS_DIR.$image['thumb_path']?>" />
</a>
<div class="handle"></div>

<? if(!empty($image['description'])):?><p style='font-weight:normal'><?=$image['description']?></p><? endif; ?>

	    	<?php echo $ajax->link( 
			    'Delete', 
			    array( 'controller' => 'images', 'action' => 'delete', $image['id']), 
			    array( 'update' => 'image-'.$image['id'] ),
			    'Are you sure you want to delete this image?'
			); 
			?>			

</div>