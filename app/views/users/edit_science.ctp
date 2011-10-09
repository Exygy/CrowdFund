
<div id="edit-form">
<fieldset>
<legend>Links</legend>
Please provide us with any links to websites that will help explain your work.  For example, links to your lab website, your blog, some of your published articles, or your department site might be appropriate.
<? //pr($my_links); ?>
<? foreach ($my_links as $link) { ?> 
<dl>
<?php echo $this->element('projects/links', array('projectId' => $link['Link']['id'], 'id'=>'','link'=>$link['Link'])); ?>	
</dl>
<?  } ?>
				
<dl class="clear"></dl>
<?php echo $this->element('projects/link-add', array('action' => 'add/', 'foreign_id'=>$logged_in_user['User']['id'], 'type'=>'profile')); ?>	

</fieldset>

<?php echo $form->create('Scientist', array( 'url' => '/users/edit_science', 'enctype' => 'multipart/form-data')); ?>

<fieldset>
<legend>Academic Info</legend>

<dl>
<?= $form->input('Scientist.university') ?>
</dl>

<dl>
<?= $form->input('Scientist.city') ?> 
</dl>
<dl>
<?= $form->label('Scientist.state', 'State').$form->select('Scientist.state', $geography->stateList(), $this->data['Scientist']['state'], array()) ?>
</dl>
</fieldset>

<fieldset>
<legend>Professional Info</legend>

<dl>
<? foreach ($my_docs as $link) { ?> 
<dl>
<?php echo $this->element('documents', array('projectId' => $link['Document']['id'], 'id'=>'','link'=>$link['Document'])); ?>	
</dl>
<?  } ?>
				
<dl class="clear"></dl>
<?php echo $form->label('Document.path', 'Upload Files<br/>(DOCs and PDFs)'); ?>
<?php echo $form->file('Document.path'); ?>
For example: your CV, articles, etc.
</dl>
<dl>
<?= $form->input('Document.title', array('value'=>'Resume')); ?>
</dl>
<dl>
<?= $form->input('Document.description'); ?>
</dl>

<dl>
<div class="multi">
<? echo $form->input('Expertise', array( 'type'=>'select', 
					'multiple'=>'checkbox', 
					'options'=>$expertise, 
					'label'=>'Expertise')); ?> 
</div>
</dl>
<dl>
<?= $form->input('Scientist.details') ?>
</dl>
</fieldset>

<fieldset class="action">
<?= $form->end('Update'); ?>
</fieldset>

</div>
