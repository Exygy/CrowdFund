	<div id="project-info" class="body-section">
	
<?=$this->element('projects/project-header');?>
	
		<h1><?=$project['title']; ?></h1>
		
			<div id="media">
			
				<div id="photos">
				
				<!-- <a href="images/image-1.jpg" rel="lightbox[roadtrip]">image #1</a> -->
				<? if(!empty($images)):?>
				
				
					<div class="main-image"><a href="<?=IMG_UPLOAD_DIR.$images[0]['path']?>" rel="lightbox[project]" title="<?=$images[0]['title']?>"><img src="<?=IMG_UPLOAD_THUMBS_DIR.$images[0]['thumb_path']?>" /></a></div>
					
					<div class="thumbnails">
					<? foreach ($images as $image) { ?>
					<a href="<?=IMG_UPLOAD_DIR.$image['path']?>" rel="lightbox[project]" title="<?=$image['title']?>"><img src="<?=IMG_UPLOAD_THUMBS_DIR.$image['thumb_path']?>" /></a>					
					<? } ?>
					</div>
					
				<? endif; ?>
				</div>

				<div id="videos">
				
				<? foreach ($videos as $video) { ?>
				<?=$video['embed']?>
				<? } ?>
				</div>
			
			</div> <!-- end media -->
		
			<div id="donations">

					<?=$this->element('projects/donate');?>

			</div>

<div class="tweet-project">
<a class="default-tweet" href='#' target="_blank" title='Tweet This' alt='Tweet This' id='tweetthis'>Tweet This Project! &raquo;</a>
<script>var twitterdesc = 'Science 2.0!  Just donated to a cool project, check it out:';</script> 					
</div>

<div class="facebook-project">


<?    $change = array("\r\n" => " ");
      $abstract = addslashes(trim(strtr($project['abstract'], $change))); ?>
       
<? //$abstract = (strlen($project['abstract'])>165) ? substr($project['abstract'], 0, 164) . '...'  : $project['abstract']; ?>
<? $img = (!empty($images)) ? IMG_UPLOAD_THUMBS_DIR.$images[0]['thumb_path'] : ''; ?>

<a class="default-tweet fb" onclick="postToWall('I just found this cool project on EurekaFund!', '<?=$project['title']; ?>', '<?=HTTP_BASE.'projects/view/'.$project['id']?>', '<?=$abstract?>', '<?=$img?>'); return false;" href='#' title='Share on Facebook' alt='Share on Facebook'>Share on Facebook! &raquo;</a>


</div>

<div style="clear:left"></div>

			<div id="researchers">
				<p><span>Submitted by: </span><strong><?=$html->link($user['fname'] . ' ' . $user['lname'], '/users/profile/'.$user['id'])?></a></strong></p>
				
				<? if (!empty($collaborators)): ?>
				<p><span class="floatleft">Collaborators: </span>
				<? $i = 1; ?>
				<ul>
				<? foreach ($collaborators as $collaborator) {
				
					 echo '<li><strong>';
					 echo $collaborator['fname'].' '.$collaborator['lname']; 
					 if (!empty($collaborator['affiliation'])) echo ' ('.$collaborator['affiliation'].')';
					 echo '</strong>';
 					 if (!empty($collaborator['description'])) echo ': <em>'.$collaborator['description'].'</em></li>';
					 //if ($i<count($collaborators)) echo ', '; 
					 $i++; 
				
				  } 
				?>
				</ul>
				</p>
				
				
				<? endif; ?>
			
			</div>

			
			<? if (!empty($project['homepage'])): ?>	
			<div id="homepage">
				<p><span>Homepage:</span>&nbsp;<a href="<?=$project['homepage']?>"><?=$project['homepage']?></a></p>
			</div>			
			<? endif; ?>
			
			<div id="abstract">
				<p><span>Abstract: </span><?=$project['abstract']?></p>
			</div>
			
			<div id="background">
				<p><span>Background: </span><?=$project['background']?></p>
			</div>
			
	
			
			<? if (!empty($links) || !empty($documents)): ?>	

			<div id="links">
				<p><span>Links: </span>
				<ul>
					<? if (!empty($links)): ?>
					<? foreach ($links as $link) { ?>
					<li><a href="<?=$link['path']?>" target="_blank"><? echo ((!empty($link['title'])) ? $link['title'] : $link['path']); ?></a><? if (!empty($link['description'])): ?><? echo ': <em>'.$link['description'].'</em>'; ?>
					</li>
										
					<? endif; ?>
					<? } ?>
					<? endif; ?>

					<? if (!empty($documents)): ?>
					<? foreach ($documents as $document) { ?>
					<li><a href="<?=DOC_UPLOAD_DIR.$document['path']?>" target="_blank"><? echo ((!empty($document['title'])) ? $document['title'] : $document['path']); ?></a></li>					
					<? } ?>
					<? endif; ?>
					
				</ul>
				</p>
			</div>	
			<? endif; ?>
				
		
		
		
	</div>
