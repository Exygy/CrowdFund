<div class="body-section admin">
<?= $this->element( 'admin-nav' )?>


<h1>Feature Admin</h1>

<?= $form->create('Project', array( 'action' => 'admin_feature' )); ?>

<label>Featured Projects: </label>
<?= $form->select( 'Project.id', $projects, $project_featured) ?>

<br/><br/>

<label>Featured Scientists: </label>
<?= $form->select( 'User.id', $scientists, $scientist_featured); ?>

<br/><br/>
<?= $form->end( 'Submit' ) ?>
<br/><br/>
</div>