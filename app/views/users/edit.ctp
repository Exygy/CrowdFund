<div class="body-section">
  
<div id="edit-form">
<h1>My Profile</h1>
<strong>About Me:</strong> 
<?=$html->link( "Basic Info", '/users/edit/1/'.$user_id )?> 
   &middot;
<?=$html->link( "Details", '/users/edit/2/'.$user_id )?> 
<br/>
<? if ($logged_in_user['User']['type']=='scientist') : ?>
<strong>About My Research:</strong> 
<?=$html->link( "Basic Info about my work", '/users/edit/3/'.$user_id )?> 
   &middot;
<?=$html->link( "Links to my work", '/users/edit/4/'.$user_id )?> 
   &middot;
<?=$html->link( "Uploaded work materials", '/users/edit/5/'.$user_id )?> 
<? endif; ?>

<?=$this->element( 'users/edit/tab'.$tab )?>

<?=$form->end( 'Update Profile' );?>

</div>

</div><!--body-section-->
