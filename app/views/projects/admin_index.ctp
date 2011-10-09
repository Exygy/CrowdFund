<div class="body-section admin">
<?= $this->element( 'admin-nav' )?>
<h1>Project Admin</h1>
    <?= $form->create( 'Project', array( 'action' => 'bulk_update' ) ); ?>
<?= $this->element( '/projects/table-list',
		   array( 'projects' => $new_projects,
			  'projects_type' => "Incomplete Projects" ) ); ?>

<?= $this->element( '/projects/table-list',
		   array( 'projects' => $pending_projects,
			  'projects_type' => "Pending Projects" ) ); ?>

<?= $this->element( '/projects/table-list',
		   array( 'projects' => $approved_projects,
			  'projects_type' => "Approved Projects" ) ); ?>

<?= $this->element( '/projects/table-list',
		   array( 'projects' => $inactive_projects,
			  'projects_type' => "Inactive Projects" ) ); ?>
<br/>

<?= $form->end( 'Update All Project Statuses' ) ?>
<br/><br/>
</div>