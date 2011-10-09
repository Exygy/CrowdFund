<? 
$step_title = array(
	'',
	'Basics',
	'Financials',
	'Collaborators',
	'Details',
	'Complete',
);

for ($i=1;$i<=5;$i++) { 

	if ($i==$tab) {
		$step_status = 'current';
	} else if ($i <= $completed_steps) {
		$step_status = 'blue';
	} else {
		$step_status = 'gray';
	}
	
	if (($completed_steps >= 4) && ($i==5) && ($i!=$tab)) {
		$step_status = 'green';
	}
	
?>

<div class="step <?=$step_status?>">
	<? if ($step_status == 'blue') echo '<a href="/projects/edit/'.$i.'/'.$projectId.'">'; ?>
	<? if ($step_status == 'green') echo '<a href="/projects/view/'.$projectId.'">'; ?>
	<div class="ball"><?=$i?></div>
	<div class="text"><?=$step_title[$i]?></div>
	<? if ($step_status == 'blue' || $step_status == 'green') echo '</a>'; ?>	
</div>

	
<? } ?>

<div class="clear"></div>