		<?php echo $this->renderElement('header-simple'); ?>	
		<?php echo $this->renderElement('header-end'); ?>

<?
// eventually let's move these into a helper
function research_areas(){
  $jobs=array(
	      "Wind",
	      "Energy Storage",
	      "Transportation",
	      "Solar",
	      "Water",
	      "Other");
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
<p style="margin: 0 0 0 15%;">Please use this section to describe YOURSELF. The NEXT page will be about your research PROJECTS.</p>
<div style="margin: 30px 0 0 15%;">
<form action="<? HTTP_BASE ?>user/scientist_update" method="post">
<fieldset>
<legend>Academic Info</legend>
<dl>
<dt><label>Position</label></dt>
<dd><input type="text" name="position" /></dd>
</dl>
</dl>
<dl>
<dt><label>University</label></dt>
<dd><input type="text" name="school" /></dd>
</dl>
<dl>
<dt><label>City</label></dt>
<dd><input type="text" name="city" /> <label>State </label><select name="state"><? state(); ?></select></dd>
</dl>
</fieldset>

<fieldset>
<legend>Professional Info</legend>
<dl>
<dt><label>Upload CV</label></dt>
<dd><input type="file" name="cv" /></dd>
</dl>
<dl>
<dt><label>Expertise</label></dt>
<dd><? research_areas();?></dd>
</dl>
<dl>
<dt><label>Details</label></dt>
<dd><textarea rows=5 cols=60 onfocus="this.innerHTML=''">Tell others about your areas of expertise and studies.</textarea></dd>
</dl>
<dl>
<dt><label>Academic Links</label></t>
<dd>Title <input type="text" name="link_title"/> URL <input type="text" name="link_url" /></dd>
</dl>
</fieldset>

<fieldset class="action">
<dd><input type="submit" name="submit" id="submit" value="Update Profile" /></dd>
</fieldset>

</form>
</div>
