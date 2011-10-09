<?php
App::import('Vendor', 'facebook/facebook');


class AppController extends Controller {
  var $uses = array('User');
  var $helpers = array('Html', 'Javascript', 'Ajax');
  var $components = array( 'RequestHandler', 'Auth', 'Ssl' );
  var $ssl_required_actions = array();
	var $facebook;
	var $__fbApiKey = FB_APIKEY;
	var $__fbSecret = FB_SECRET;


	function __construct() {
		parent::__construct();

		// Prevent the 'Undefined index: facebook_config' notice from being thrown.
		$GLOBALS['facebook_config']['debug'] = NULL;

		// Create a Facebook client API object.
		$this->facebook = new Facebook($this->__fbApiKey, $this->__fbSecret);
	}



  function checkAdminSession() {
    // if the admin session hasn't been set
    $user = $this->Auth->user();
    if ( ! $user || $user['User']['privileges'] == 0 ) {
      // set flash message and redirect
      // pr( $user['User']['privileges'] );
      // pr( $user ); 
      // exit();
      $this->Session->setFlash( "You don't have permission to access this page." );
      $this->redirect('/users/login/');
      exit();
    }
  }

  function setMetas() {
    // $title_for_laout is set elsewhere?
    $this->set( 'meta_description', "Eureka Fund is a place to fund the scientific research in clean technology that you want to see realized.  Browse research proposals that need your support.  Find a project that inspires.  Get directly involved!" );
    $this->set( 'meta_keywords', "Open Science, Science Microfinance, Eureka, Eureka Fund, EurekaFund, Scientific Philanthropy, Science Philanthropy, Fund Science, Fund Research, Scientific Funding, Science Funding, Jason Blue-Smith, Zach Berke, Dan Kammen, Spencer Wells" );
  }

  function beforeFilter(){
    Security::setHash('md5');
    $this->Auth->fields=array('username'=>'email', 'password'=>'password');
    $this->Auth->loginError='Please login below';
    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'profile');
    $this->Auth->authorize = 'controller';
    $this->Auth->userScope = array('User.active' => '1');
    $this->set('logged_in_user', $this->Auth->user());
    if($this->RequestHandler->isAjax()) {
      Configure::write('debug', 0);
      //  these came along with the code block we found... might want to use them later?
      //$this->RequestHandler->setContent('javascript', 'text/javascript');
      //$this->RequestHandler->respondAs('javascript');
      $this->layout = 'ajax';
    }

    // if admin pages are being requested
    if(isset($this->params['admin'])) {
      // check the admin is logged in
      // this method is in the app_controller.php file
      $this->checkAdminSession();
    }
    
    if(($this->action!='edit_password' && $this->action!='logout') && $this->checkResetPassword())
      if($this->action!='logout')
	$this->redirect('/users/edit_password');

    // force some actions to ssl
    if( in_array( $this->params['action'] , $this->ssl_required_actions ) ){
      $this->Ssl->force();
    }else{
      $this->Ssl->unforce();
    }

    $this->setMetas();
    
    //check facebook logged in status
    $fbid = $this->facebook->get_loggedin_user();
    $this->set('fbid', $fbid);
    
    
  }

  
  function isAuthorized() {
    return true;
  }
  
  function checkResetPassword(){
    return $this->User->checkHash($this->Auth->user('id'));
  }

}


?>
