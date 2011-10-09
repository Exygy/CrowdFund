<fieldset>
<legend>Research Documentation</legend>

<? foreach ($my_docs as $link) { ?> 
<dl>
<?php echo $this->element('documents', array('projectId' => $link['Document']['id'], 'id'=>'','link'=>$link['Document'])); ?>	
</dl>
<?  } ?>
				
<dl class="clear"></dl>
<?php echo $this->element('projects/document-add', array('action' => 'upload/', 'foreign_id'=>$logged_in_user['User']['id'], 'type'=>'scientist_doc')); ?>	
</fieldset>

