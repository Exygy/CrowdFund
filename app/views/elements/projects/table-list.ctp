<h3><?=$projects_type?></h3>
<table >
<tr>
<th>Title</th>
<th>Category</th>
<th>Scientist</th>
<th>Completed Step</th>
<th>Status</th>
<th>Action</th>
</tr>
<? foreach ( $projects as $project ) : ?>
<tr>
<td><?=$project['Project']['title']?></td>
<td><?=$project['ProjectCategory']['title']?></td>
<td><?=$project['User']['fname']?> <?=$project['User']['lname']?></td>
<td><?=$project['Project']['completed_steps']?></td>
<td>
<?= $form->input( 'Project.'.$project['Project']['id'].'.id', array( 'type' => 'hidden', 'value' => $project['Project']['id'] ) ) ?>
<?= $form->select( 'Project.'.$project['Project']['id'].'.status', $project_status_list, $project['Project']['status']) ?>
</td>
<td>
<?=$html->link( 'View', '/projects/view/' . $project['Project']['slug'])?> &middot;
<?=$html->link( 'Edit', '/projects/edit/1/' . $project['Project']['id'])?>
</td>
</tr>
<? endforeach; ?>
</table>