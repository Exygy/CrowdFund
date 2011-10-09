		<?php echo $this->renderElement('header-simple'); ?>	
		<?php echo $this->renderElement('header-end'); ?>

<?
// eventually let's move these into a helper
function cc_types(){
  $cc=array("Visa", "MasterCard", "American Express", "Discover");
  echo "<select name=\"cc_type\">";
  for($i=0; $i<sizeof($cc); $i++){
    echo "<option value=\"$i\">".$cc[$i]."</option>";
  }
  echo "</select>";
}

function cc_expr(){
  echo "<select name=\"cc_expr_month\">";
  for($i=1; $i<=12; $i++){
    echo "<option value=\"$i\">$i</option>";
  }
  echo "</select>";  
  
  echo "<select name=\"cc_expr_year\">";
  for($i=date('Y'); $i<=date('Y')+25; $i++){
    echo "<option value=\"$i\">$i</option>";
  }
  echo "</select>";
}


?>

<div style="margin: 30px 0 0 15%;">
<form action="donate_verify.php">

<fieldset>
<legend>Donation Info</legend>
<dl>
<dt><label>Amount</label></dt>
<dd>$<input type="text" name="amount" /></dd>
</dl>
<dl>
<dt><label>Project</label></dt>
<dd>Hydo-electric powered Solar Panels</dd>
</dl>
<dl>
<dt></dt>
<dd>Can your donation be used for similar research if this project is not fully funded?</dd>
<dt></dt>
<dd>Yes<input type="radio" name="donate_others" value=1> No<input type="radio" name="donate_others" value=0 /></dd>
</dl>
</fieldset>

<fieldset>
<legend>Donate to Eureka Fund</legend>
<dl>
<dt></dt>
<dd>Would you like to donate directly to the Eureka Fund?</dd>
<dt></dt>
<dd>Yes<input type="radio" onclick="document.getElementById('ef_donation_box').style.display='block';" name="donate_ef" value=1> No<input type="radio" onclick="document.getElementById('ef_donation_box').style.display='none';" name="donate_ef" value=0 /></dd>
</dl>
<dl id="ef_donation_box" style="display: none">
<dt><label>Amount</label></dt>
<dd>$<input type="text" name="amount_ef" /></dd>
</dl>
</fieldset>

<fieldset>
<legend>Payment Info</legend>
<dl>
<dt><label>CC Type</label></dt>
<dd><? cc_types(); ?></dd>
</dl>
<dl>
<dt><label>CC #</label></dt>
<dd><input type="text" name="cc_num" maxlength="16" /></dd>
</dl>
<dl>
<dt><label>Security Code</label></dt>
<dd><input type="text" name="cc_security" maxlength="4"/></dd>
</dl>
<dl>
<dt><label>Expr Date</label></dt>
<dd><? cc_expr(); ?></dd>
</dl>
<dl>
<dt><label>Billing Zip</label></dt>
<dd><input type="text" name="zip" maxlength=5 /></dd>
</dl>

</fieldset>

<fieldset class="action">
<dd><input type="button" name="submit" id="submit" style="width: 100px; height: 25px;font-weight: 5;  background: url(forms/img/button.png); background-position: 15px -5px;" src="" value="Next" /></dd>
</fieldset>

</form>
</div>
