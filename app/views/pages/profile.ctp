		<?php echo $this->renderElement('header-simple'); ?>	
		<?php echo $this->renderElement('header-end'); ?>

<?php
$scientist=array(
	       "name"=>"Jack Luxton",
	       "dob"=>"August 29, 1923",
	       "email"=>"jluxtion@piako.gov",
	       "address"=>"123 Main St.",
	       "city"=>"Toon Town",
	       "state"=>"California",
	       "phone"=>"(415)555-5555",
	       "description"=>'John Finlay "Jack" Luxton, QSO (1923 - 29 August 2005) was a dairy farmer and New Zealand politician. He entered Parliament in 1966 as the National Party member for Piako and then, after boundary changes, Matamata. He represented the predominantly rural electorate for 21 years, to 1987. Luxton was a dairy farmer in Waitoa, between Morrinsville and Te Aroha. He grew up in the area and knew it well, becoming prominent in the Waikato branch of Federated Farmers and serving as dominion councillor before his election to Parliament. He also continued a family involvement with the Tatua Dairy Company as a director, for several years. Parliamentary duties included becoming Deputy Speaker and Chairman of Committees in 1976, positions he held until National\'s defeat in 1984. He was particularly interested in Pacific Island affairs, and in 1976 led a Government-sponsored tour of eight Pacific nations to investigate local industries, with a view to increasing New Zealand involvement there. On his retirement from politics in 1987, Luxton took an active part in his family\'s horticulture block in Katikati. His seat of Matamata (later Karapiro was retained for National by his son John Luxton from 1987 to 1999. Luxton was a companion of the Queen\'s Service Order. He died, aged 82, in Morrinsville. He is survived by his wife, Margaret, sons Rodney, Bruce, & John, daughter Barbara and their families.',
	       "photo"=>HTTP_BASE."img/profiles/jlux.jpg",
	       "job"=>"New Zealand Congressman",
	       "interest"=>array("Solar", "Transportation"),
	       "isScientist"=>1,
	       "school"=>"Univ of California, Santa Barbara",
	       "position"=>"Associate Professor",
	       "expertise"=>array("Energy", "EcoSystems"),
	       "details"=>"Worked on  bunch of green projets in the NZ",
	       "links"=>array("Yahoo!"=>"http://www.yahoo.com", "UCSB"=>"http://www.ucsb.edu"),
	       "projects"=>array("Border Green Energy Team"=>"http://www.bget.org/", "AmeriCorp"=>"http://www.americorps.gov/", "AWEA"=>"http://www.awea.org/"));

$rich_guy=array(
	       "name"=>"Bill Gates",
	       "dob"=>"October 28, 1955",
	       "email"=>"bgates@microsoft.com",
	       "address"=>"1 Big Balla Palace Dr.",
	       "city"=>"Redmond",
	       "state"=>"Washington",
	       "phone"=>"(302)555-5555",
	       "description"=>'William Henry "Bill" Gates III (born October 28, 1955)[2] is an American business magnate, philanthropist, author, and chairman[3] of Microsoft, the software company he founded with Paul Allen. He is ranked consistently one of the world\'s wealthiest people and the wealthiest overall as of 2009.[1] During his career at Microsoft, Gates held the positions of CEO and chief software architect, and remains the largest individual shareholder with more than 8 percent of the common stock.[5] He has also authored or co-authored several books. Gates is one of the best-known entrepreneurs of the personal computer revolution. Although he is admired by many, a number of industry insiders criticize his business tactics, which they consider anti-competitive, an opinion which has in some cases been upheld by the courts.[6][7] In the later stages of his career, Gates has pursued a number of philanthropic endeavors, donating large amounts of money to various charitable organizations and scientific research programs through the Bill & Melinda Gates Foundation, established in 2000.',
	       "photo"=>"profiles/bgates.jpg",
	       "job"=>"Gates Foundation CEO",
	       "interest"=>array("Education", "Transportation"),
	       "isScientist"=>0,
	       "links"=>array("Gates Foundation"=>"http://www.gatesfoundation.org"));

$who=0;
if($who==0)
     $profile=$scientist;
     else
     $profile=$rich_guy;


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

?>

<style type="text/css">
li label{width: 100px; float: left;}
li a{color: white}
</style>
</head>

<div style="float: left; margin: 30px 0 0 25px;">
<fieldset>

<legend>Profile <a href="<?= HTTP_BASE ?>edit_user">edit</a></legend>

<div style="float: left; width: 200px; height:200px; margin: 5px;">
<img src="<?= $profile['photo'] ?>" width=200 />

<? if ($profile['isScientist']) { ?>
<h2 style="margin-bottom:0; padding-bottom: 0;">Scientist Profile</h2>
<a href="<? HTTP_BASE ?>edit_scientist">edit</a>
<ul style="list-style:none; background-color: #0282e2; color: black; padding: 5px;">
<li><b>University</b></li>
<li><?= $profile['school'] ?></li>
<li><b>Expertise</b></li>
<li>
<? interests($profile["expertise"]); ?>
</li>
<li><b>Research Details</b></li>
<li><?= $profile['details'] ?></li>
<li><b>Links</b></li>
<? links($profile['links']); ?>
</ul>
<? } ?>

<? if (sizeof($profile['projects'])) { ?>
<h2>Projects</h2>
<ul style="list-style:none; background-color: #0282e2; color: black; padding: 5px;">
<?= links($profile['projects']) ?>
</ul>
<? } ?>

</div>

<ul style="float: left; width: 50%; margin: 5px; list-style:none;">
<li><label>Name</label><?= $profile['name'] ?></li>
<li><label>Email</label><?= $profile['email'] ?></li>
<li><label>Phone</label><?= $profile['phone'] ?></li>
<li><label>Location</label><?= $profile['city'].', '.$profile['state'] ?></li>
<li><label>Profession</label><?= $profile['job'] ?></li>
<li>
<label>Interests</label>
<? interests($profile['interest']); ?>
</li>
<li><label>About</label><br>
<?= $profile['description'] ?></li>
</ul>
</fieldset>
</div>

<div style="float: left; margin: 30px 0 0 10px">
<fieldset style="width: 290px">
<legend>Projects</legend>
Projects am working on
<ul style="list-style:none; padding: 0;">
	<li><a href="<?= HTTP_BASE ?>pages/project"><img src="http://mfi.sc.exygy.com/img/monkey.jpg" width=100/><label>Putting Monkeys on Bikes</label></a></li>
<div class="clear"></div>
Projects I have donated to
<ul style="list-style:none; padding: 0;">
	<li><a href="<?= HTTP_BASE ?>pages/project"><img src="http://mfi.sc.exygy.com/img/monkey.jpg" width=100/><label>Putting Monkeys on Bikes</label></a></li>
</fieldset>
</div>


