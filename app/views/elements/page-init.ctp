<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="ez7qew8yGDPdWHinH3Hb68kvuTW3DpXq79qnjxIHlqI=" />
<?php echo $this->element('meta-tags', array( 'title_for_layout' => $title_for_layout ) ); ?>
<link rel="icon" href="<?=HTTP_BASE ?>favicon.jpg" type="image/x-icon" />
<?php
		//echo $html->meta('icon');
		echo $html->css('wforms');
		
		echo $html->css('style');
		//echo $scripts_for_layout;

		//echo $html->css('lightbox');
		echo $javascript->link('prototype.js');
  	    echo $javascript->link('scriptaculous/scriptaculous.js');
  	       // echo $javascript->link('lightbox.js');

// for jquery fancybox
//echo $javascript->link( 'jquery-1.3.2.min.js' );
echo $javascript->link( 'jquery.tools.min.js' );
echo $javascript->link( 'jquery.fancybox-1.2.3.pack.js' );
echo $javascript->link( 'jquery.easing.1.3.js' );
echo $html->css( 'jquery.fancybox' );

        echo $javascript->link('wforms.js');
//echo $javascript->link("http://bit.ly/javascript-api.js?version=latest&login=bitlyapidemo&apiKey=".BITLY_API_KEY);
echo $javascript->link("http://bit.ly/javascript-api.js?version=latest&login=eurekafunder&apiKey=".BITLY_API_KEY);

echo $javascript->link('bitly.js');
//        echo $javascript->link('livepipe/livepipe.js');
 //       echo $javascript->link('livepipe/tabs.js');
        echo $javascript->link('eureka.js');
?>
<script>
jQuery(document).ready(function() {
	jQuery("a.fb_project_photos").fancybox({
		'hideOnContentClick': true,
		frameWidth : 300,
		frameHeight: 300
		});


});
</script>

<!--[if lte IE 8]>
<?php echo $html->css('ie-fix'); ?>
<![endif]-->

<script type="text/javascript">

	
	
    function postToWall(msg, name, href, caption, img) {
    
		if (img != '') {
			var attach = { 	'name': name, 
							'href': href, 
							'caption': caption, 
							'media': 
								[{ 	'type': 'image', 
									'src': img, 
									'href': href
								}] 
			}; 
				   		
		} else {

			var attach = { 	'name': name, 
							'href': href, 
							'caption': caption, 
			}; 
		
		}
        
		FB.Connect.streamPublish(msg, attach, null, null, 'Tell your friends!');
    }


function imageLite (x) {
	var img = document['icon'+x];
	img.src='<?=HTTP_BASE?>img/icon-'+x+'-lite.png';	
}


function imageReg (x) {
var HTTP_BASE = 'http://eureka.localhost:8888/';

	var img = document['icon'+x];
	img.src='<?=HTTP_BASE?>img/icon-'+x+'.png';	
}
</script>


</head>

<body>
