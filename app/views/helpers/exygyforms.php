<?php
class ExygyformHelper extends AppHelper {

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

function interests($interests){
  echo "<ul style=\"float:left\">";
  foreach ($interests as $interest){
    echo "<li>$interest</li>";
  }
  echo "</ul>";
  echo "<div style=\"clear: both\">";
}

function links($links){
  while ($name=key($links)){
    $url=current($links);
    echo "<li><a href=\"$url\" target=\"_blank\">$name</a>";
    next($links);
  }
}

function research_areas(){
  $jobs=array(
	      "Solar",
	      "Engineering",
	      "Transportation",
	      "Energy",
	      "Biology",
	      "Agriculture");
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
}

?>