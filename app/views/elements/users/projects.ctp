<div style="float: left; margin: 0px 0 0 10px">
<fieldset style="width: 290px">
<legend>Projects</legend>
<? if ($user['User']['type']=='scientist') { ?>
Projects I am working on :
<?
  if(!empty($scientist['Project'])){
    echo "<ul class=\"my_projects\">";
    foreach ($scientist['Project'] as $project){
      $img=HTTP_BASE.'img/'.(empty($project['Image']) ? "monkey.jpg" : 'uploads/'.$project['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['slug']."\"><img src=\"$img\" width=100/><br />".$project['title']."</a> ".$html->link('Send this project to your friends', HTTP_BASE.'google/index/'.$project['id'])."</li>";
    }
    echo "</ul>";
  }
  else
    echo "<br/>" . $html->link("Create a project!", "/projects/add");
?>
<? } ?>
<div class="clear"></div>
<br/>
Projects I have donated to :
<?
  if(!empty($user['Donation'])){
    echo "<ul class=\"my_projects\">";
    foreach ($user['Donation'] as $project){
      $img=HTTP_BASE.'img/'.(empty($project['Project']['Image']) ? "monkey.jpg" : 'uploads/'.$project['Project']['Image'][0]['path']);
      echo "<li><a href=\"".HTTP_BASE."projects/view/".$project['Project']['slug']."\"><img src=\"$img\" width=100/><br />".$project['Project']['title']."</a></li>";
    }
    echo "</ul>";
  }
  else
    echo '<br><a href="'.HTTP_BASE.'"projects/category">Start donating now!</a>';

?>
</fieldset>

</div>
