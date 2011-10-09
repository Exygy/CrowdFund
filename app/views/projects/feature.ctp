			<? if (!empty($project['Image'])) { 
						$image=IMG_UPLOAD_THUMBS_DIR.$project['Image'][0]['thumb_path'];
 
					} else { 
						$image=HTTP_BASE.'img/monkey.jpg'; 
					}
			?>
<div class="features-wrap">

<div class="feature">
				<div class="desc">Featured Project</div>
<div class="thumb">
				<?=$html->link( $html->image( $image, array( 'width' => '270', 'height' => '220' ) ), '/projects/view/' . $project['Project']['slug'], array( 'escape' => false ) )?>
</div>
				<h1><?=$html->link( $project['Project']['title'], '/projects/view/' . $project['Project']['slug'] )?></h1>
					<div class="submitted">Posted by <?=$html->link($project['User']['fname'].' '.$project['User']['lname'], '/users/profile/'.$project['User']['id'])?> in <a href="<?=HTTP_BASE ?>projects/category/<?=$project['Project']['project_category_id']?>"><?=$project['ProjectCategory']['title']?></a><br/>
<?=Date('M d, Y', strtotime($project['Project']['timestamp']));?></div>
<p><strong>The problem:</strong> <?=$project['Project']['problem']?></p>
<p><strong>The potential impact:</strong> <?=$project['Project']['impact']?></p>
<p><strong>Goal:</strong> $<?=number_format($project['goal']['total'], 2, '.', ',');?></p>
<p><strong>Raised:</strong> $<?=number_format($project['goal']['raised'], 2, '.', ',');?></p>
</div>


<div class="feature">
				<div class="desc">About Eureka Fund</div>
<p><center>
<strong>
<u>Early research is underfunded.  </u>
</strong>
</center></p>
<p>
<img width=50 src="<?=HTTP_BASE ?>img/icon-1.png" id="icon1" name="icon1" />
<img width=50 src="<?=HTTP_BASE ?>img/icon-2.png" id="icon2" name="icon2" />
<img width=50 src="<?=HTTP_BASE ?>img/icon-3.png" id="icon3" name="icon3" />
<img width=50 src="<?=HTTP_BASE ?>img/icon-4.png" id="icon4" name="icon4" />
<img width=50 src="<?=HTTP_BASE ?>img/icon-5.png" id="icon5" name="icon5" />
<center><span style="font-size:.8em;">Wind, Transport, Water, Solar, and Storage.  </span></center>
</p>
<p>
<center>
<u><strong>SCIENCE NEEDS YOUR HELP</strong></u>
<br/><br/>
Your donation will go to basic research that will lead to breakthrough innovation!
<br/><br/>
</center>
</p>
<div class="thumb">
<? $image = 'logo-big.gif'; ?>
				<?=$html->image( $image, array( 'width' => '270', 'height' => '220' ) )?>
<br/><br/>
</div>
<p><center><strong>EurekaFund is a new way to fund early science -- directly by you.</strong></center></p>
<p><center><strong>Be the first to find out about and support the technologies that will lead us to a cleaner safer future.</strong></center></p>
<p>
<center><?=$html->link( 'Learn More', '/pages/about' );?></center>
</p>

</div>


<div class="feature">
				<div class="desc">Featured Scientist</div>
<div class="thumb">
<? 
$image = '/img/istockphoto_8478786-another-expert.jpg';
if ( isset($scientist['Image']) && $scientist['Image']['path'] != '' ) {
  $image = $scientist['Image']['path'];
}
?>
				<?=$html->link( $html->image( $image, array( 'width' => '270', 'height' => '220' ) ), '/users/profile/' . $scientist['Profile']['id'], array( 'escape' => false )  )?>
</div>
				<h1><?=$html->link( $scientist['User']['fname'].' '. $scientist['User']['lname'], '/users/profile/' . $scientist['Profile']['id'] )?></h1>
<p><strong>University:</strong><?=$scientist['Scientist']['university'];?> </a></p>
<p><strong>About My Research:</strong><?=$scientist['Scientist']['details'];?> </a></p>
</div>

