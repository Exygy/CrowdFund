
// wait until page is loaded to call API                                                                                                                                                                        
BitlyClient.addPageLoadEvent(function(){
	BitlyCB.myShortenCallback = function(data) {
	    var result;
	    for (var r in data.results) {
		result = data.results[r];
		result['longUrl'] = r;
		break;
	    }
	    
	    // alert("The bit.ly URL for this page is " + result['shortUrl']);
	    tweetthis = document.getElementById( 'tweetthis' );
	    if ( tweetthis ) {
		tweetthis.href = 'http://twitter.com/home/?status=' + escape( twitterdesc + ' ' + result['shortUrl'] + ' ' + '#eurekafund' );
		tweetthis.innerHTML = 'Tweet This Project! &raquo;'
	    }
	}
	
	//on the donation page we want to bitly the project link, rather than self.location
	if (typeof(projectLocation) != 'undefined') {
		BitlyClient.shorten(projectLocation, 'BitlyCB.myShortenCallback');
	} else {
		BitlyClient.shorten(self.location, 'BitlyCB.myShortenCallback');
	
	}
	
    });
