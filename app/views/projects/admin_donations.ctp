<div class="body-section admin">
<?= $this->element( 'admin-nav' )?>
<h1>Donation Admin</h1>

<table>

<tr>
<th>Projects</th>
<th>Donors</th>
<th>Progress</th>
<th>EurekaFund Donations</th>
<th>Totals</th>
</tr>

<? foreach ($projects as $project) { 
  $project_amt=0;
  $ef_amt=0;
  $donor_count=0;
?>
<tr>

<td><a href="<?= HTTP_BASE ?>projects/view/<?= $project['Project']['id'] ?>"><?= $project['Project']['title'] ?></a></td>				     

<td>
<? foreach ($project['Donation'] as $donation) { 
  $donor_count++;
  $project_amt+=$donation['project_donation_amt'];
  $ef_amt+=$donation['eureka_donation_amt'];
}
?>
<?= ($donor_count ? "<a href=\"donors/".$project['Project']['id']."\">$donor_count</a>" : $donor_count) ?>
</td>

<td>
<?= '$'.$project_amt ?>
</td>

<td>
<?= '$'.$ef_amt ?>
</td>

<td>
<?= '$'.($project_amt+$ef_amt) ?>
</td>

</tr>
<? } ?>

</table>
</div>
