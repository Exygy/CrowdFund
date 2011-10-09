	<div id="project-info" class="body-section">
	
<?=$this->element('projects/project-header');?>

		<h1><?=$project['title']; ?></h1>
		
			<div id="media">
			
				<div id="photos">
				
				<!-- <a href="images/image-1.jpg" rel="lightbox[roadtrip]">image #1</a> -->
				<? if(!empty($images)):?>
				
				
					<div class="main-image"><a href="<?=IMG_UPLOAD_DIR.$images[0]['path']?>" rel="fb_project_photos" class="fb_project_photos" title="<?=$images[0]['title']?>"><img src="<?=IMG_UPLOAD_THUMBS_DIR.$images[0]['thumb_path']?>" /></a></div>
					
					<div class="thumbnails">
					<? for ($i = 1; $i < count( $images ); $i++ ) { ?>
					<? $image = $images[$i]; ?>
					<a href="<?=IMG_UPLOAD_DIR.$image['path']?>" rel="fb_project_photos" class="fb_project_photos" title="<?=$image['title']?>"><img src="<?=IMG_UPLOAD_THUMBS_DIR.$image['thumb_path']?>" /></a>					
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
<?=$html->link('Tweet This Project! &raquo;', '#', array( 'target'=>'_blank', 'class' => 'default-tweet iframe', 'id' => 'tweetthis'), null, null, false )?>
<script>var twitterdesc = 'Science 2.0!  Just donated to a cool project, check it out:';</script> 					
</div>

<div class="facebook-project">

<?    $change = array("\r\n" => " ");
      $abstract = addslashes(trim(strtr($project['abstract'], $change))); ?>
       
<? //$abstract = (strlen($project['abstract'])>165) ? substr($project['abstract'], 0, 164) . '...'  : $project['abstract']; ?>
<? $img = (!empty($images)) ? IMG_UPLOAD_THUMBS_DIR.$images[0]['thumb_path'] : ''; ?>

<a class="default-tweet fb" onclick="postToWall('I just found this cool project on EurekaFund!', '<?=$project['title']; ?>', '<?=HTTP_BASE.'projects/view/'.$project['slug']?>', '<?=$abstract?>', '<?=$img?>'); return false;" href='#' title='Share on Facebook' alt='Share on Facebook'>Share on Facebook! &raquo;</a>

</div>


<script>
/*
$(document).ready(function() {
	$("a.fb").fancybox({
		'hideOnContentClick': false,
		frameWidth : 700,
		frameHeight: 400
		});
});
*/
</script>

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
			
			<div id="problem">
				<p><span>The Problem: </span><?=$project['problem']?></p>
			</div>
			
			<div id="plan">
				<p><span>The Plan: </span><?=$project['plan']?></p>
			</div>

			<div id="impact">
				<p><span>The Impact: </span><?=$project['impact']?></p>
			</div>
			
	
		
			<div id="info">
				<p><span>More info: </span>Want to dig deeper? Go the the <?=$html->link('Project Details', 'details/'.$project['id'])?> page to learn more about this project.</span>
			</div>
		
		
		
	</div>
