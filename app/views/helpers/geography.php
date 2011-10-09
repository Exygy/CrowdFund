<?php 

/**
 * Geography Helper
 *
 * Code by Mike O'Toole
 * with inspiration from Jesse Kochis
 *
 *
 * @version        0.1
 * @author        Mike O'Toole <mike.otoole at gmail dot com>
 * @copyright        Copyright 2006, Mike O'Toole
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License
 * @created        01.11.2006
 * @updated        01.11.2006
 * @note		   country list, in terms of countries included, spellings, and abbreviations used is still under review, feedback is appreciated
 */ 

class GeographyHelper extends Helper {
/**
 * Associative array of state abbreviations and state names
 *
 * @var array
 * @access public
 */ 
	var $states = array('AL'=>"Alabama", 'AK'=>"Alaska", 'AZ'=>"Arizona", 'AR'=>"Arkansas", 'CA'=>"California", 'CO'=>"Colorado", 'CT'=>"Connecticut", 'DE'=>"Delaware", 'DC'=>"District Of Columbia", 'FL'=>"Florida", 'GA'=>"Georgia", 'HI'=>"Hawaii", 'ID'=>"Idaho", 'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa", 'KS'=>"Kansas", 'KY'=>"Kentucky", 'LA'=>"Louisiana", 'ME'=>"Maine", 'MD'=>"Maryland", 'MA'=>"Massachusetts", 'MI'=>"Michigan", 'MN'=>"Minnesota", 'MS'=>"Mississippi", 'MO'=>"Missouri", 'MT'=>"Montana", 'NE'=>"Nebraska", 'NV'=>"Nevada", 'NH'=>"New Hampshire", 'NJ'=>"New Jersey", 'NM'=>"New Mexico", 'NY'=>"New York", 'NC'=>"North Carolina", 'ND'=>"North Dakota", 'OH'=>"Ohio", 'OK'=>"Oklahoma", 'OR'=>"Oregon", 'PA'=>"Pennsylvania", 'RI'=>"Rhode Island", 'SC'=>"South Carolina", 'SD'=>"South Dakota", 'TN'=>"Tennessee", 'TX'=>"Texas", 'UT'=>"Utah", 'VT'=>"Vermont", 'VA'=>"Virginia", 'WA'=>"Washington", 'WV'=>"West Virginia", 'WI'=>"Wisconsin", 'WY'=>"Wyoming");
/**
 * Associative array of 2-letter country abbreviations and country names
 *
 * @var array
 * @access public
 */ 
	var $countries = array(
						'AC'=>'Ascension Island',
						'AD'=>'Andorra',
						'AE'=>'United Arab Emirates',
						'AF'=>'Afghanistan',
						'AG'=>'Antigua and Barbuda',
						'AI'=>'Anguilla',
						'AL'=>'Albania',
						'AM'=>'Armenia',
						'AN'=>'Netherland Antilles',
						'AO'=>'Angola',
						'AQ'=>'Antarctica',
						'AR'=>'Argentina',
						'AS'=>'American Samoa',
						'AT'=>'Austria',
						'AU'=>'Australia',
						'AW'=>'Aruba',
						'AZ'=>'Azerbaidjan',
						'BA'=>'Bosnia-Herzegovina',
						'BB'=>'Barbados',
						'BD'=>'Bangladesh',
						'BE'=>'Belgium',
						'BF'=>'Burkina Faso',
						'BG'=>'Bulgaria',
						'BH'=>'Bahrain',
						'BI'=>'Burundi',
						'BJ'=>'Benin',
						'BM'=>'Bermuda',
						'BN'=>'Brunei Darussalam',
						'BO'=>'Bolivia',
						'BR'=>'Brazil',
						'BS'=>'Bahamas',
						'BT'=>'Buthan',
						'BV'=>'Bouvet Island',
						'BW'=>'Botswana',
						'BY'=>'Belarus',
						'BZ'=>'Belize',
						'CA'=>'Canada',
						'CC'=>'Cocos (Keeling) Islands',
						'CD'=>'Congo, The Democratic Republic of the',
						'CF'=>'Central African Rep.',
						'CG'=>'Congo, Republic of',
						'CH'=>'Switzerland',
						'CI'=>'Ivory Coast',
						'CK'=>'Cook Islands',
						'CL'=>'Chile',
						'CM'=>'Cameroon',
						'CN'=>'China',
						'CO'=>'Colombia',
						'CR'=>'Costa Rica',
						'CS'=>'Serbia and Montenegro',
						'CU'=>'Cuba',
						'CV'=>'Cape Verde',
						'CX'=>'Christmas Island',
						'CY'=>'Cyprus',
						'CZ'=>'Czech Republic',
						'DE'=>'Germany',
						'DJ'=>'Djibouti',
						'DK'=>'Denmark',
						'DM'=>'Dominica',
						'DO'=>'Dominican Republic',
						'DZ'=>'Algeria',
						'EC'=>'Ecuador',
						'EE'=>'Estonia',
						'EG'=>'Egypt',
						'EH'=>'Western Sahara',
						'ER'=>'Eritrea',
						'ES'=>'Spain',
						'ET'=>'Ethiopia',
						'FI'=>'Finland',
						'FJ'=>'Fiji',
						'FK'=>'Falkland Islands (Malvinas)',
						'FM'=>'Micronesia',
						'FO'=>'Faroe Islands',
						'FR'=>'France',
						'GA'=>'Gabon',
						'GB'=>'Great Britain (UK)',
						'GD'=>'Grenada',
						'GE'=>'Georgia',
						'GF'=>'Guyana (Fr.)',
						'GG'=>'Guernsey',
						'GH'=>'Ghana',
						'GI'=>'Gibraltar',
						'GL'=>'Greenland',
						'GM'=>'Gambia',
						'GN'=>'Guinea',
						'GP'=>'Guadeloupe (Fr.)',
						'GQ'=>'Equatorial Guinea',
						'GR'=>'Greece',
						'GS'=>'South Georgia and the South Sandwich Islands',
						'GT'=>'Guatemala',
						'GU'=>'Guam (US)',
						'GW'=>'Guinea Bissau',
						'GY'=>'Guyana',
						'HK'=>'Hong Kong',
						'HM'=>'Heard and McDonald Islands',
						'HN'=>'Honduras',
						'HR'=>'Croatia',
						'HT'=>'Haiti',
						'HU'=>'Hungary',
						'ID'=>'Indonesia',
						'IE'=>'Ireland',
						'IL'=>'Israel',
						'IM'=>'Isle of Man',
						'IN'=>'India',
						'IO'=>'British Indian O. Terr.',
						'IQ'=>'Iraq',
						'IR'=>'Iran',
						'IS'=>'Iceland',
						'IT'=>'Italy',
						'JM'=>'Jamaica',
						'JO'=>'Jordan',
						'JP'=>'Japan',
						'KE'=>'Kenya',
						'KG'=>'Kirgistan',
						'KH'=>'Cambodia',
						'KI'=>'Kiribati',
						'KM'=>'Comoros',
						'KN'=>'SaintKitts Nevis Anguilla',
						'KP'=>'Korea (North)',
						'KR'=>'Korea (South)',
						'KW'=>'Kuwait',
						'KY'=>'Cayman Islands',
						'KZ'=>'Kazachstan',
						'LA'=>'Laos',
						'LB'=>'Lebanon',
						'LC'=>'Saint Lucia',
						'LI'=>'Liechtenstein',
						'LK'=>'Sri Lanka',
						'LR'=>'Liberia',
						'LS'=>'Lesotho',
						'LT'=>'Lithuania',
						'LU'=>'Luxembourg',
						'LV'=>'Latvia',
						'LY'=>'Libya',
						'MA'=>'Morocco',
						'MC'=>'Monaco',
						'MD'=>'Moldavia',
						'MG'=>'Madagascar',
						'MH'=>'Marshall Islands',
						'MK'=>'Macedonia, The Former Yugoslav Republic of',
						'ML'=>'Mali',
						'MM'=>'Myanmar',
						'MN'=>'Mongolia',
						'MO'=>'Macau',
						'MP'=>'Northern Mariana Islands',
						'MQ'=>'Martinique (Fr.)',
						'MR'=>'Mauritania',
						'MS'=>'Montserrat',
						'MT'=>'Malta',
						'MU'=>'Mauritius',
						'MV'=>'Maldives',
						'MW'=>'Malawi',
						'MX'=>'Mexico',
						'MY'=>'Malaysia',
						'MZ'=>'Mozambique',
						'NA'=>'Namibia',
						'NC'=>'New Caledonia (Fr.)',
						'NE'=>'Niger',
						'NF'=>'Norfolk Island',
						'NG'=>'Nigeria',
						'NI'=>'Nicaragua',
						'NL'=>'Netherlands',
						'NO'=>'Norway',
						'NP'=>'Nepal',
						'NR'=>'Nauru',
						'NU'=>'Niue',
						'NZ'=>'New Zealand',
						'OM'=>'Oman',
						'PA'=>'Panama',
						'PE'=>'Peru',
						'PF'=>'Polynesia (Fr.)',
						'PG'=>'Papua New Guinea',
						'PH'=>'Philippines',
						'PK'=>'Pakistan',
						'PL'=>'Poland',
						'PM'=>'Saint Pierre and Miquelon',
						'PN'=>'Pitcairn',
						'PR'=>'Puerto Rico (US)',
						'PT'=>'Portugal',
						'PW'=>'Palau',
						'PY'=>'Paraguay',
						'QA'=>'Qatar',
						'RE'=>'Reunion (Fr.)',
						'RO'=>'Romania',
						'RU'=>'Russian Federation',
						'RW'=>'Rwanda',
						'SA'=>'Saudi Arabia',
						'SB'=>'Solomon Islands',
						'SC'=>'Seychelles',
						'SD'=>'Sudan',
						'SE'=>'Sweden',
						'SG'=>'Singapore',
						'SH'=>'Saint Helena',
						'SI'=>'Slovenia',
						'SJ'=>'Svalbard and Jan Mayen Islands',
						'SK'=>'Slovak Republic',
						'SL'=>'Sierra Leone',
						'SM'=>'San Marino',
						'SN'=>'Senegal',
						'SO'=>'Somalia',
						'SR'=>'Suriname',
						'ST'=>'Saint Tome and Principe',
						'SV'=>'El Salvador',
						'SY'=>'Syria',
						'SZ'=>'Swaziland',
						'TC'=>'Turks and Caicos Islands',
						'TD'=>'Chad',
						'TF'=>'French Southern Territories',
						'TG'=>'Togo',
						'TH'=>'Thailand',
						'TJ'=>'Tadjikistan',
						'TK'=>'Tokelau',
						'TM'=>'Turkmenistan',
						'TN'=>'Tunisia',
						'TO'=>'Tonga',
						'TP'=>'East Timor',
						'TR'=>'Turkey',
						'TT'=>'Trinidad and Tobago',
						'TV'=>'Tuvalu',
						'TW'=>'Taiwan',
						'TZ'=>'Tanzania',
						'UA'=>'Ukraine',
						'UG'=>'Uganda',
						'UK'=>'United Kingdom',
						'UM'=>'US Minor outlying Islands',
						'US'=>'United States',
						'UY'=>'Uruguay',
						'UZ'=>'Uzbekistan',
						'VA'=>'Vatican City State',
						'VC'=>'SaintVincent and Grenadines',
						'VE'=>'Venezuela',
						'VG'=>'Virgin Islands (British)',
						'VI'=>'Virgin Islands (US)',
						'VN'=>'Vietnam',
						'VU'=>'Vanuatu',
						'WF'=>'Wallis and Futuna Islands',
						'WS'=>'Samoa',
						'YE'=>'Yemen',
						'YU'=>'Yugoslavia',
						'ZA'=>'South Africa',
						'ZM'=>'Zambia',
						'ZR'=>'Zaire',
						'ZW'=>'Zimbabwe'
						);
	
	/**
	 * Returns a string containing a two letter state name abbreviation. If no abbreviation matches the state name, the name is returned.
	 *
	 * @param int $stateName the full name of a US State
	 * @param array $customList an associative array with the abbreviations as the key and full names as the value,
	 * 				for adding, editing, or removing states
	 				ie array('QC' => 'Quebec','MA' => 'Massachusett', 'NJ' => '') would add Quebec to the return possibilities, 
	 				change Massachusetts to Massachusett, and eliminate New Jersey from the return possibilities.
	 * @return string two letter abbreviation for the given state 
	 */
	function stateAbbrev($stateName, $customList = array())
	{
		$states = $this->_array_trim(am($this->states, $customList));
		
		if($abbr = array_search($stateName, $states))
		{
			return $abbr;
		}
		return $stateName;
	}
	
	
	/**
	 * Returns a string containing a full state name. If no state matches the abbreviation, the abbreviation is returned.
	 *
	 * @param int $abbr the two letter state abbreviation
	 * @param array $customList an associative array with the abbreviations as the key and full names as the value,
	 * 				for adding, editing, or removing states
	 				ie array('QC' => 'Quebec','MA' => 'Massachusett', 'NJ' => '') would add Quebec to the return possibilities, 
	 				change Massachusetts to Massachusett, and eliminate New Jersey from the return possibilities.
	 * @return string the full name of a state
	 */
	function stateFull($abbr, $customList = array())
	{
		$states = $this->_array_trim(am($this->states, $customList));
		
		if(isset($states[$abbr]))
		{
			return $states[$abbr];
		}
		return $abbr;
	}
	
	/**
	 * Returns an associative array with state abbreviations as the key and full state names as the value
	 *		Convenient for use with the form helper select function
	 *
	 * @param array $customList an associative array with the abbreviations as the key and full names as the value,
	 * 				for adding, editing, or removing states
	 				ie array('QC' => 'Quebec','MA' => 'Massachusett', 'NJ' => '') would add Quebec to the return possibilities, 
	 				change Massachusetts to Massachusett, and eliminate New Jersey from the return possibilities.
	 * @return array key as state abbreviation, value as state name
	 */
	function stateList($customList = array()) 
	{
		$states = $this->_array_trim(am($this->states, $customList));
		ksort($states);
		return $states;
	}
	
	/**
	 * Returns an associative array with two letter country abbreviations as the key and full country names as the value
	 *		Convenient for use with the form helper select function
	 *
	 * @param array $customList an associative array with the abbreviations as the key and full names as the value,
	 * 				for adding, editing, or removing countries
	 				ie array('QC' => 'Quebec','US' => 'USA', 'AL' => '') would add Quebec to the return possibilities, 
	 				change United States of America to USA, and eliminate Albania from the return possibilities.
	 * @return array key as country abbreviation, value as country name
	 */
	function countryList($customList = array())
	{
		$countries = $this->_array_trim(am($this->countries, $customList));
		ksort($countries);
		return $countries;
	}
	
	
	/**
	 * Returns a latitude string in the format 42&deg;21'29" N
	 *
	 * @param int $val latitude in decimal form (42.358)
	 * @return string formatted latitude (42&deg;21'29" N)
	 */
	function formatLatitude($val)
	{
		$formatVal = $this->_formatLonLat($val);
	
		if($val < 0) 
		{
			$dir = "S";
		}
		else
		{
			$dir = "N";
		}
	
		return $formatVal.' '.$dir;
	}
	
	/**
	 * Returns a longitude string in the format 71&deg;03'36" W
	 *
	 * @param int $val longitude in decimal form (-71.06)
	 * @return string formatted longitude (71&deg;03'36" W)
	 */
	function formatLongitude($val)
	{
		$formatVal = $this->_formatLonLat($val);
		
		if($val < 0) {
			$dir = "W";
		}
		elseif($val > 0) {
			$dir = "E";
		}
	
		return $formatVal.' '.$dir;
	}
	
	/*Private method used to format both latitude and longitude from decimal to degrees*/
	function _formatLonLat($val)
	{
		$deg = floor(abs($val));
		$tempm = (abs($val)-$deg)*100;
		$min = $tempm*.6;
		$temps = round(($min-floor($min))*100);
		$min = floor($min);
		$sec = round(.6*$temps);
		
		if ($min < 10) 
		{
			$min = '0'.$min;
		}
		if ($sec < 10) 
		{
			$sec = '0'.$sec;
		}
		
		return "$deg&deg;$min'$sec\"";
	}
	
	/*Private method used to eliminate empty entries from the array*/
	function _array_trim($a) 
	{ 
		$b = array(); 
		foreach ($a as $key => $val) 
		{ 
			if (!empty($a[$key])) 
			{ 
				$b[$key] = $val; 
			} 
		}
		return $b; 
	}
}

?>