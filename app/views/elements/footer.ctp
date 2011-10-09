	<div class="clear"></div>
<div id="footer">

<div id="footer-left">
&copy;<? echo Date('Y') ?> EurekaFund, Inc.
</div>


<div id="footer-center">
<?php echo $html->link('About Us', '/pages/about'); ?> | <?php echo $html->link('Privacy Policy', '/pages/privacy'); ?> | <?php echo $html->link('Terms of Service', '/pages/terms'); ?>
<br/><br/>
EurekaFund is a U.S. 501(c)3 non-profit organization.  
</div>

<div id="footer-right"><a href="http://exygy.com/eurekafund"?>powered by exygy</a></div>

</div>	<!-- footer -->

</div> <!-- wrap -->

<script type="text/javascript">
// prevent jQuery from appending cache busting string to the end of the FeatureLoader URL 
var cache = jQuery.ajaxSettings.cache; 
jQuery.ajaxSettings.cache = true;

// Load FeatureLoader asynchronously. Once loaded, execute Facebook init 

jQuery.getScript('http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US', function() {
	FB_RequireFeatures(["XFBML"], function(){ 
		FB.Facebook.init("<?=FB_APIKEY?>", "/xd_receiver.htm"); 
	}); 
});

// Restore jQuery caching setting
jQuery.ajaxSettings.cache = cache;
</script>



<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9790868-2");
pageTracker._trackPageview();
} catch(err) {}</script>


</body>
</html>
