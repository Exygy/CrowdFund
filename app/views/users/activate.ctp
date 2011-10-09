<div style="margin: 35px; padding-bottom: 15px">
<? if ($id){ ?>
	<p>Your account has been activated!</p>

	<p>Here are some of the exciting things you can do now:</p>
	<ul>
		<li>Complete your <a href="<?= HTTP_BASE ?>users/edit/<?= $id ?>">User Profile</a> so that others can learn more about you and the research you are interested in.</li>
		<li><a href="<?= HTTP_BASE ?>pages/browse">Browse submitted project</a> proposals that are currently looking for funding</li>
	</ul>

	<? if($scientist){ ?>
	<p>As a scientist, you can now use EurekaFund to reach out and let others know about your research and secure funding from our users.</p>
	<ul>
		<li>Complete your <a href="<?= HTTP_BASE ?>users/edit_scientist/<?= $id ?>">Researcher Profile</a> so that our community can learn about your scientific endeavors and achievements.</li>
		<li><a href="<?= HTTP_BASE ?>pages/submit">Submit a project proposal</a> so your research efforts can reach a larger audience</li>
	</ul>
	<? } ?>
<? } else { ?>
	<p>Oops! It looks like the link you followed was malformed. Please chack it and try again</p>
<? } ?>
</div>
