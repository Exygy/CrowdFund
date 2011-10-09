<div class="body-section admin">
<?= $this->element( 'admin-nav' )?>
<h1>Donations Admin</h1>
<table>
<tr>
<th>Name</th>
<th>Email</th>
<th>Project Donation</th>
<th>EurekaFund Donation</th>
<th>Flexible</th>
</tr>

<? foreach ($donors as $donor) { 
$donor=$donor['Donation'];
?>

<tr>

<td>
<?= ($donor['user_id'] ? "<a href=\"".HTTP_BASE."users/profile/".$donor['user_id']."\">" : '') ?>
<?= $donor['fname'].' '.$donor['lname'] ?>
<?= ($donor['user_id'] ? "</a>" : '') ?>
</td>
<td><?= $donor['email'] ?></td>
<td><?= $donor['project_donation_amt'] ?></td>
<td><?= $donor['eureka_donation_amt'] ?></td>
<td><?= ($donor['flexible_donation'] ? 'Yes' : 'No') ?></td>

</tr>
<? } ?>

</table>
</div>
