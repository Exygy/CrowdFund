<fieldset>
<legend>Scientist Profile
<? if ($user['User']['id']==$logged_in_user['User']['id'] || $logged_in_user['User']['privileges'] > 0){ ?>
<a href="<?= HTTP_BASE ?>users/edit_science">edit</a>
<? } ?>
</legend>
<? if(!empty($scientist)){ ?>
<ul style="list-style:none; color: black; padding: 5px;">

<? if (!empty($scientist['Scientist']['university'])) { ?>
<li><b>University</b></li>
<li><?= $scientist['Scientist']['university'] ?></li>
<? } ?>

<? if (!empty($scientist['Scientist']['Expertise'])) { ?>
<li><b>Expertise</b></li>
<li>
<?= expertises($scientist["Expertise"]) ?>
</li>
<? } ?>

<? if (!empty($scientist['Scientist']['details'])) { ?>
<li><b>Research Details</b></li>
<li><?= $scientist['Scientist']['details'] ?></li>
<? } ?>

<? if (!empty($scientist['Link'])) { ?>
<li><b>Links</b></li>
<? links($scientist['Link']); ?>
<? } ?>

<? if (!empty($scientist['Document'])) { ?>
<li><b>Files</b></li>
<? docs($scientist['Document']); ?>
<? } ?>

</ul>
<? } else { ?>
<a href="<?= HTTP_BASE ?>users/edit_science">Tell us about yourself</a>
<? } ?>
</fieldset>

