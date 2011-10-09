<?php
	define('IMG_UPLOAD_DIR', HTTP_BASE.'img/uploads/');
	define('IMG_UPLOAD_THUMBS_DIR', HTTP_BASE.'img/uploads/thumbs/');
	define('DOC_UPLOAD_DIR', HTTP_BASE.'files/uploaded/');	


// AUTHORIZE.NET

// set AUTHORIZE_NET_ACCOUNT_TYPE to 'live' for live and 'development' for development
// define( 'AUTHORIZE_NET_ACCOUNT_TYPE', 'development' );
define( 'AUTHORIZE_NET_ACCOUNT_TYPE', 'live' );

if ( AUTHORIZE_NET_ACCOUNT_TYPE == 'development' ) {
  define( 'EUREKA_AUTHORIZE_NET_LOGIN_ID', '' );
  define( 'EUREKA_AUTHORIZE_NET_TX_KEY', '' );
  define( 'EUREKA_AUTHORIZE_NET_LIVE', true );
 } else if ( AUTHORIZE_NET_ACCOUNT_TYPE == 'live' ) {
  define( 'EUREKA_AUTHORIZE_NET_LOGIN_ID', '' );
  define( 'EUREKA_AUTHORIZE_NET_TX_KEY', '' );
  define( 'EUREKA_AUTHORIZE_NET_LIVE', true );
 }

/* bit.ly API */
// define( 'BITLY_API_KEY', '' ); 

// not sure who's api key this was... the user account was set to bitlyapidemo ??
//define( 'BITLY_API_KEY', '' ); 

//user = eurekafunder  (bit.ly pw= eureka123) 
define( 'BITLY_API_KEY', '' ); 


 
  function orderCmp($im1, $im2)
  {
    $a = $im1['order'];
    $b = $im2['order'];
    if ($a == $b) {
      return 0;
    }
    return ($a < $b) ? -1 : 1;
  }


?>