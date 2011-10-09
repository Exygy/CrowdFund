<div class="body-section">

	<div style="margin-top:15px; margin-left: 45px;">
		
		<div class="tweet-project">
			<a class="default-tweet" href='#' target="_blank" title='Tweet This' alt='Tweet This' id='tweetthis'>Tweet This Project! &raquo;</a>
			<script>
			var twitterdesc = 'Science 2.0!  Just donated to a cool project, check it out:';
			var projectLocation = '<?=HTTP_BASE.'projects/view/'.$project['id']?>';
			</script> 					
		</div>
			
		<div class="facebook-project">
				
			<?    $change = array("\r\n" => " ");
			      $abstract = addslashes(trim(strtr($project['abstract'], $change))); ?>
			       
			       
			<? //don't bother trying to get the project image for now... ?>       
			<? //$img = (!empty($images)) ? IMG_UPLOAD_THUMBS_DIR.$images[0]['thumb_path'] : ''; ?>
			
			<a class="default-tweet fb" onclick="postToWall('I just donated to this project on EurekaFund, please take a look and help this project get funded!', '<?=$project['title']; ?>', '<?=HTTP_BASE.'projects/view/'.$project['id']?>', '<?=$abstract?>', ''); return false;" href='#' title='Share on Facebook' alt='Share on Facebook'>Share on Facebook! &raquo;</a>
			
			
		</div>
		
		<div style="clear:left"></div>
			
		<p><a href="<?= HTTP_BASE ?>projects/view/<?= $id ?>">Return to Project</a></p>
		
	</div>
	

</div>
