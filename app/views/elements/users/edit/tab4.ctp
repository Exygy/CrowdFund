<fieldset>
<legend>Links</legend>

Please provide us with any links to websites that will help explain your work.  For example, links to your lab website, your blog, some of your published articles, or your department site might be appropriate.
<? foreach ($my_links as $link) { ?> 
<dl>
<?php echo $this->element('projects/links', array('projectId' => $link['Link']['id'], 'id'=>'','link'=>$link['Link'])); ?>	
</dl>
<?  } ?>

<dl class="clear"></dl>
<?php echo $this->element('projects/link-add', array('action' => 'add/', 'foreign_id'=>$logged_in_user['User']['id'], 'type'=>'profile')); ?>	
</fieldset>
