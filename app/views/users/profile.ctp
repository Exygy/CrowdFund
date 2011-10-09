<div class="body-section">
<h1><?= $user['User']['fname'].' '.$user['User']['lname'] ?> 
<? if ($user['User']['id']==$logged_in_user['User']['id'] || $logged_in_user['User']['privileges']){ ?>
<a style="font-size:18px" href="<?= HTTP_BASE.'users/edit/'.$this->data['logged_in_user']['User']['id'] ?>">edit</a>
<? } ?>

</h1>

<div id="left-nav">
   <? if ( isset($user['Image']) && $user['Image']['path'] != '' ) : ?>
   <?=$html->image( $user['Image']['path'], array( 'width' => '150' ) )?>
<? else : ?>
   <?=$html->image( "istockphoto_8478786-another-expert.jpg", array( 'width' => '150' ) )?>
   <? if ($user['User']['id']==$logged_in_user['User']['id'] ) : ?>
	<?=$html->link("Upload your photo", '/users/edit/2/'.$user['User']['id']);?>
   <? endif; ?>	
<? endif; ?>
<? if(!empty($scientist)){ ?>
<ul>

<? if (!empty($user['Contact']['state'])) { ?>
     <li><h2>Location:</h2><?=empty($user['Contact']['city'])?'':$user['Contact']['city'].', '?><?=$user['Contact']['state']?></li>
<? } ?>

<? if (!empty($scientist['Scientist']['university'])) { ?>
<li><h2>University:</h2><?= $scientist['Scientist']['university'] ?></li>
<? } ?>

<? if (!empty($scientist['Expertise'])) { ?>
<li><h2>Expertise:</h2><?=$commalist->makelist( $scientist['Expertise'], array( 'title' => 'expertise' ) )?></li>
<? } ?>

<? if (!empty($user['Interest'])) { ?>
<li><h2>Interests:</h2><?=$commalist->makelist( $user['Interest'], array( 'title' => 'interest' ) )?></li>
<? } ?>


<? if (!empty($user['Profile']['profession'])) { ?>
<li><h2>Profession:</h2><?= $user['Profile']['profession'] ?></li>
<? } ?>

<? if (!empty($user['Profile']['education'])) { ?>
<li><h2>Education:</h2><?= $user['Profile']['education'] ?></li>
<? } ?>

</ul>
<? } else { ?>
<?=$html->link("Tell us about yourself", '/users/edit');?>
<? } ?>



</div><!-- left-lev -->

<div id="main-content">
<? if ($user['User']['type']=='scientist') { ?>
<div id="research-details">
<h2>Research Details</h2>
<? if (!empty($scientist['Scientist']['details'])) { ?>
<h3>About My Research</h3>
<?= $scientist['Scientist']['details'] ?>
<? } ?>

<? if (!empty($scientist['Link'])) { ?>
<h3>Research Links</h3>
				     <?=$commalist->makelist( $scientist['Link'], array( 'link' => 'path' )) ?>
<? } ?>

<? if (!empty($scientist['Document'])) { ?>
<h3>Research Documentation</h3>
					 <?=$commalist->makelist( $scientist['Document'], array( 'link' => 'path' ) )?>
<? } ?>

</div>

<? } ?>

<h2>Personal Info</h2>

<ul class="my_profile">
<li><label>Name</label><span><?= $user['User']['fname'].' '.$user['User']['lname'] ?></span></li>

<? $formatEmail = str_replace('@', ' [at] ', $user['User']['email']); ?>
<? $formatEmail = str_replace('.', ' [dot] ', $formatEmail); ?>

<li><label>Email</label><span><?= $formatEmail ?></span></li>

<? if (!empty($user['Contact'])){ ?>
<?= (!empty($user['Contact']['phone']) ? "<li><label>Phone</label><span>".$user['Contact']['phone']."</span></li>" : '') ?>
<? } ?>

<? if (!empty($user['Profile']['description'])) { ?>
<hr>
<li><b>Why I'm interested in Eureka Fund</b><br>
<?= $user['Profile']['description'] ?></li>
<? } ?>

</ul>



</div><!-- main-content -->

<div id="right-nav">
<h2>My Projects</h2>
<? if ($user['User']['type']=='scientist') { ?>
<?
  if(!empty($scientist['Project'])){
  $found_this_project_type = false;
    foreach ($scientist['Project'] as $project){
if($project['status']=="APPROVED"){
	if ( ! $found_this_project_type ) { print "<strong>Projects I am working on</strong>"; $found_this_project_type = true; }
      $img=HTTP_BASE.'img/'.(empty($project['Image']) ? "monkey.jpg" : 'uploads/'.$project['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['slug']."\"><img src=\"$img\" width=100/><br />".$project['title']."</a> | ".$html->link('Send this project to your friends', HTTP_BASE.'google/index/'.$project['id'])."</li>";
}
    }
  }
  else if($user['User']['id']==$logged_in_user['User']['id'])
    echo "<br/>" . $html->link("Create a project!", "/projects/add");
?>
<? } ?>

<? if($user['User']['id']==$logged_in_user['User']['id']){ ?>
<?
  if(!empty($scientist['Project'])){
  $found_this_project_type = false;
    foreach ($scientist['Project'] as $project){
if($project['status']=="PENDING" && ($user['User']['id']==$logged_in_user['User']['id'])){
	if ( ! $found_this_project_type ) { print "<strong>Projects Pending Approval</strong>"; $found_this_project_type = true; }
      $img=HTTP_BASE.'img/'.(empty($project['Image']) ? "monkey.jpg" : 'uploads/'.$project['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['slug']."\"><img src=\"$img\" width=100/><br />".$project['title']."</a></li>";
}
    }
  }
?>
<?
  if(!empty($scientist['Project'])){
  $found_this_project_type = false;
    foreach ($scientist['Project'] as $project){
if($project['status']=="NEW" && ($user['User']['id']==$logged_in_user['User']['id'])){
	if ( ! $found_this_project_type ) { print "<strong>Projects I have not yet submitted</strong>"; $found_this_project_type = true; }
      $img=HTTP_BASE.'img/'.(empty($project['Image']) ? "monkey.jpg" : 'uploads/'.$project['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['slug']."\"><img src=\"$img\" width=100/><br />".$project['title']."</a></li>";
}
    }
  }
?>
<?
  if(!empty($scientist['Project'])){
  $found_this_project_type = false;
    foreach ($scientist['Project'] as $project){
if($project['status']=="INACTIVE" && ($user['User']['id']==$logged_in_user['User']['id'])){
	if ( ! $found_this_project_type ) { print "<strong>Inactive Projects</strong>"; $found_this_project_type = true; }
      $img=HTTP_BASE.'img/'.(empty($project['Image']) ? "monkey.jpg" : 'uploads/'.$project['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['slug']."\"><img src=\"$img\" width=100/><br />".$project['title']."</a></li>";
}
    }
  }
}
?>
<strong>Projects I have donated to</strong>
<?
  if(!empty($user['Donation'])){
    foreach ($user['Donation'] as $project){
      $img=HTTP_BASE.'img/'.(empty($project['Project']['Image']) ? "monkey.jpg" : 'uploads/'.$project['Project']['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['Project']['slug']."\"><img src=\"$img\" width=100/><br />".$project['Project']['title']."</a></li>";
    }
  }
  else
    echo '<br><a href="'.HTTP_BASE.'"projects/category">Start donating now!</a>';

?>
</div><!-- right-nav -->

</div><!-- body-section -->
