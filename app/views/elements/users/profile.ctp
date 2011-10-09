<fieldset>
<legend>Profile <? if ($user['User']['id']==$logged_in_user['User']['id'] || $logged_in_user['User']['privileges']){ ?></h2><a href="<?= HTTP_BASE.'users/edit/'.$this->data['logged_in_user']['User']['id'] ?>">edit</a><? } ?></legend>
<ul id="my_profile">
<li><label>Name</label><span><?= $user['User']['fname'].' '.$user['User']['lname'] ?></span></li>
<li><label>Email</label><span><?= $user['User']['email'] ?></span></li>

<? if (!empty($user['Contact'])){ ?>
<?= (!empty($user['Contact']['phone']) ? "<li><label>Phone</label><span>".$user['Contact']['phone']."</span></li>" : '') ?>
<?= (!empty($user['Contact']['state']) ? "<li><label>Location</label><span>".(empty($user['Contact']['city']) ? '': $user['Contact']['city'].', ').$user['Contact']['state']."</span></li>" : '') ?>
<? } ?>

<? if (!empty($user['Interest'])){ ?>
<li>
<label>Interests</label>
<? interests($user['Interest']); ?>
</li>
<? } ?>

<? if (!empty($user['Profile']['id'])){ ?>
<?= (!empty($user['Profile']['profession']) ? "<li><label>Profession</label><span>".$user['Profile']['profession']."</span></li>" : '') ?>
<?= (!empty($user['Profile']['education']) ? "<li><label>Education</label><span>".$user['Profile']['education']."</span></li>" : '') ?>
<?= (!empty($user['Profile']['description']) ? "<li><label>About</label><br><span>".$user['Profile']['description']."</span></li>" : '') ?>
<?  } ?>
</ul>
</fieldset>
