		<?php echo $this->renderElement('header-simple'); ?>	
		<?php echo $this->renderElement('header-end'); ?>

<?
// eventually let's move these into a helper
function research_areas(){
  $jobs=array("Wind", "Transportation", "Water", "Solar", "Energy Storage");
  for( $i=0; $i<sizeof($jobs)-1; $i++){
    echo "<input type=\"checkbox\" name=\"interest[]\" /><label>".$jobs[$i]."</label>";
  }
}

function state(){
  $states=array (
	   'AL' => 'Alabama',
	   'AK' => 'Alaska',
	   'AS' => 'American Samoa',
	   'AZ' => 'Arizona',
	   'AR' => 'Arkansas',
	   'CA' => 'California',
	   'CO' => 'Colorado',
	   'CT' => 'Connecticut',
	   'DE' => 'Delaware',
	   'DC' => 'District of Columbia',
	   'FL' => 'Florida',
	   'GA' => 'Georgia',
	   'HI' => 'Hawaii',
	   'ID' => 'Idaho',
	   'IL' => 'Illinois',
	   'IN' => 'Indiana',
	   'IA' => 'Iowa',
	   'KS' => 'Kansas',
	   'KY' => 'Kentucky',
	   'LA' => 'Louisiana',
	   'ME' => 'Maine',
	   'MD' => 'Maryland',
	   'MA' => 'Massachusetts',
	   'MI' => 'Michigan',
	   'MN' => 'Minnesota',
	   'MS' => 'Mississippi',
	   'MO' => 'Missouri',
	   'MT' => 'Montana',
	   'NE' => 'Nebraska',
	   'NV' => 'Nevada',
	   'NH' => 'New Hampshire',
	   'NJ' => 'New Jersey',
	   'NM' => 'New Mexico',
	   'NY' => 'New York',
	   'NC' => 'North Carolina',
	   'ND' => 'North Dakota',
	   'OH' => 'Ohio',
	   'OK' => 'Oklahoma',
	   'OR' => 'Oregon',
	   'PA' => 'Pennsylvania',
	   'PR' => 'Puerto Rico',
	   'RI' => 'Rhode Island',
	   'SC' => 'South Carolina',
	   'SD' => 'South Dakota',
	   'TN' => 'Tennessee',
	   'TX' => 'Texas',
	   'UT' => 'Utah',
	   'VT' => 'Vermont',
	   'VI' => 'Virgin Islands',
	   'VA' => 'Virginia',
	   'WA' => 'Washington',
	   'WV' => 'West Virginia',
	   'WI' => 'Wisconsin',
	   'WY' => 'Wyoming'
	   );
  while($state=key($states)){
    $name=current($states);
    echo "<option value=\"$state\">$name</option>";
    next($states);
  }

}
?>
<div style="margin: 30px 0 0 15%;">
<form action="<?= HTTP_BASE ?>user/update_profile" method="post">
<input type="hidden" name="id" value =2 />
<fieldset>
<legend>Personal Info</legend>
<dl>
<dt><label>First Name</label></dt>
<dd><input type="text" name="fname" /></dd>
</dl>
<dl>
<dt><label>Last Name</label></dt>
<dd><input type="text" name="lname" /></dd>
</dl>
<dl>
<dt><label>Birth Date</label></dt>
<dd><input type="text" name="dob_month" size="2" maxlength="2" value="MM"/>/<input type="text" size="2" name="dob_day" maxlength="2" value="DD"/>/<input type="text" name="dob_year" maxlength="4" size="4" value="YYYY"/></dd>
</dl>
<dl>
<dt><label>Gender</label></dt>
<dd>Male <input type="radio" name="gender" value="M"/> Female<input type="radio" name="gender" value="F"/></dd>
</dl>
</fieldset>

<fieldset>
<legend>Account Info</legend>
<dl>
<dt><label>Email</label></dt>
<dd><input type="text" name="email" /></dd>
</dl>
<dl>
<dt><label>Old Password</label></dt>
<dd><input type="password" name="old_pw" /></dd>
</dl>
<dl>
<dt><label>New Password</label></dt>
<dd><input type="password" name="new_pw" /></dd>
</dl>
</fieldset>

<fieldset>
<legend>Contact Info</legend>
<dl>
<dt><label>Street Address</label></dt>
<dd><input type="text" name="address" /></dd>
</dl>
<dl>
<dt><label>City</label></dt>
<dd><input type="text" name="city" /> <label>State </label><select name="state"><? state(); ?></select></dd>
</dl>
<dl>
<dt><label>Zip Code</label></dt>
<dd><input type="text" name="zip" maxlength=5/>
</dl>
<dl>
<dt><label>Phone Number</label></dt>
<dd><input type="text"name="phone" /></dd>
</dl>
</fieldset>

<fieldset>
<legend>About You</legend>
<dl>
<dt><label>Desciption</label><dt>
<dd><label>What is your interest in Eureka Fund?<label><br>
<textarea name="description" rows=5 cols=60 onfocus="this.innerHTML=''">e.g. Because I like science. I am a researcher.</textarea></dd>
</dl>
<dl>
<dt><label>Profile Photo</label>
<dd><input type="file" /></dd>
</dl>
<dl>
<dt><label>Profession</label></dt>
<dd><input type="text" name="profession" /></dd>
</dl>
<dl>
<dt><label>Interests</label></dt>
<dd><? research_areas(); ?></dd>
</dl>
</fieldset>

<fieldset class="action">
<dd><input type="submit" name="submit" id="submit" value="Next" /></dd>
</fieldset>
</form>

</div>
