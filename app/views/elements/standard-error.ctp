<div class="body-section">
<div class="error-message">
Eggads!  You've encountered a problem!
</div>
<center>
<?=$html->image('/img/oil-barrels.jpg')?>
<br/>
<br/>
Please go back and try again!
<br/>
<br/>
<br/>
<?=isset($error_details)?'Error Details: '.$error_details:''?>
</div>