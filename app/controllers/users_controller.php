<?php
class UsersController extends AppController{
  var $name='Users';
  var $uses=array('User', 'Scientist', 'Profile', 'Contact', 'Interest', 'InterestsProfile', 'Expertise', 'Link', 'Image', 'Document', 'Education');
  var $components = array( 'Email', 'Upload');
  var $helpers = array( 'Commalist' );


  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('login', 'register', 'activate', 'reset_password', 'profile');
  }

  function isAuthorized(){
    // parent::isAuthorized();
    return true;
  }

  function index(){
  }

  function login()
  {

  }

  function logout(){
    $this->Session->setFlash('You have been logged out', 'messages/success');
    $this->redirect($this->Auth->logout());
  }

  function register(){
    if (empty($this->data)){
      $this->set('success', false);      
    }
    else{
     $this->data['User']['hash']=md5(rand(1, 10000));
     $this->User->set($this->data);
      if($this->User->validates()){
	// pr( $this->data ); exit();
	$this->User->save($this->data);
	$this->sendActivationEmail($this->User->id, $this->data['User']['fname'],$this->data['User']['email'], $this->data['User']['hash']);
	$this->Session->setFlash('Thank you for registering. A confirmation email has been sent to you. Please follow the link in that email to activate your account.', 'messages/success');
	$this->set('success', true);
	$this->render('/elements/blank');
	// $this->render( '/blank' );
	return;
      }
      else{
	$this->data['User']['password'] = '';
	$this->data['User']['password_confirm'] = '';
	$this->set('success', false);
      }
    }
  }

  function activate($id, $hash){
    $correct=$this->User->find('count', array('conditions'=>array('id'=>$id, 'hash'=>$hash)));
    if(!$correct){
      $this->Session->setFlash( 'Your activation code is invalid.  Please check your email and make sure you are using the full given URL.' );
      $this->redirect('/users/login');
    }

    $this->User->id=$id;
    $this->User->updateAll(array(
				 'active'=> 1,
				 'hash'=> "''"),
			   array(
				 'id'=>$id,
				 'hash'=>$hash));
    $scientist=$this->User->find('all', array(
					      'fields'=>'User.type',
					      'conditions'=>array('id'=>$id, 'active'=>1)));
    /*
    if (empty($scientist)){
      $id=0;
      $isScientist=0;
    }
    else{
      $isScientist=($scientist[0]['User']['type']=='scientist');
    }
    $this->set('id', $id);   
    $this->set('scientist', $isScientist);
    */
    $this->Session->setFlash( 'Your account has been activated.  Please login below.', 'messages/success');
    $this->redirect('/users/login');
  }

  function sendActivationEmail($id, $name, $email, $hash){
    $this->Email->to = $email;
    $this->Email->subject = "Please confirm your new EurekaFund Account!";
    $this->Email->from = "EurekaFund <accounts@eurekafund.org>";

    $this->set('greeting', $name);
    $this->set('activation_link', HTTP_BASE."users/activate/$id/$hash" );

    $this->Email->template = 'activation';
    $this->Email->sendAs = 'text'; 
    $this->Email->send();

 
  }

  function profile($id=0){
    if (!$id){
      $id=$this->Auth->user('id');
      $check=$this->User->findById($id);
      //      pr($check);
    }

    $user=$this->Profile->find('first', array(
					      'conditions'=>array(
								  'Profile.id'=>$id),
					      'recursive' => 3));
    if (empty($user))
      $user=$this->User->find('first', array(
						'conditions'=>array(
								    'User.id'=>$id)));
    if (empty($user)){
      $this->Session->setFlash('User could not be found.');
      $this->render('/errors/error404');
      return;
    }
    else{
      $scientist=$this->Scientist->find('first', array(
						     'conditions'=>array(
									 'Scientist.id'=>$id),
						     'recursive'=>2));
       $this->set('logged', $this->Auth->user());
       $this->set('user', $user);
       $this->set('scientist', $scientist);
       $this->set('user_dne', false);
    }
  }

  function edit($tab = 1, $user_id = null){
    //if not an admin
    if(!$this->Auth->user('privileges') || $user_id == null )
      $user_id = $this->Auth->user('id'); 

    // should check here to make sure regular user isn't trying to edit scientist detail
    $this->set( 'tab', $tab );
    
    $this->set( 'user_id', $user_id );

    // Do this stuff no matter where we're coming from
    $this->helpers[] = 'Geography';

    // Get HM and HABTM things for select boxes, checkboxes, and file/image/link/etc elements

    // first the easy stuff
    $this->set('interests', $this->Interest->find('list'));
    $this->set('education', array("Select")+$this->Education->find('list'));
    $this->set('expertise', $this->Expertise->find('list'));
    $this->set('photo', $this->Image->find('all', array(
							  'fields'=>array('id', 'path'),
							  'conditions'=>array(
									      'foreign_id'=>$this->Auth->user('id'),
									      'type'=>'profile',
									      'active'=>"1"))));


    // now the harder stuff -- links and docs
    // could we get these using proper model usage and hm linkage?
    // get links
    $links=$this->Link->find('all', array(
					  'conditions'=>array(
							      'Link.foreign_id'=>$user_id,
							      'Link.type'=>'profile')));
    $this->set('my_links', (empty($links) ? array() : $links));

    // get docs
    $docs=$this->Document->find('all', array(
					  'conditions'=>array(
							      'Document.foreign_id'=>$user_id,
							      'Document.type'=>'scientist_doc')));
    // pr( $docs ); exit();
    $this->set('my_docs', (empty($docs) ? array() : $docs));


    // check and see if we posted or if we just got here
    if (!empty($this->data)) {
      // we posted the form so we'll use $this->data from the post

      // hm, there should be a better way to do this
      // hidden fields on the view?
      // actually, i'd really like to unify all this shit into one array...
      // so that we only have to do one validate() and one save().... thoughts?
      $this->data['User']['id'] = $user_id;
      $this->data['Profile']['id'] = $user_id;
      $this->data['Contact']['id'] = $user_id;
      $this->data['Contact']['id'] = $user_id;
      $this->data['Scientist']['id'] = $user_id;
      $this->data['Scientist']['user_id'] = $user_id;
      
      // set and validate
      $this->User->set( $this->data );
      $this->Profile->set($this->data);
      $this->Contact->set($this->data);
      $this->Scientist->set($this->data);
      // pr( $this->Scientist ); exit();
      //image stuff
      if( isset($this->data['Image']) && !$this->data['Image']['path']['error']){
	$this->data['Image']['foreign_id']=$user_id;
	$destination = realpath('../../app/webroot/img/profiles/') . '/';      
	$file = $this->data['Image']['path'];
	$this->Upload->upload($file, $destination, null, array('type' => 'resizecrop', 'size' => array('400', '300'), 'output' => 'jpg'));
	$this->data['Image']['path'] = 'profiles/'.$this->Upload->result;
      }
      // pr( $this->User );
      if ( ! $this->User->validates() ||
	   ! $this->Profile->validates() || 
	   ! $this->Contact->validates() || 
	   ! $this->Scientist->validates() ) {
	// something didn't validate...
	$this->Session->setFlash('Please correct the problems below.');
      } else {
	// we validated!  hooray!  save everything and let the user know the update was made
	$this->User->save($this->data);
	$this->Profile->save($this->data);
	$this->Contact->save($this->data);
	if(!empty($this->Upload->result)){
	  $this->Image->deactivate_pics($this->Auth->user('id'));
	  $this->Image->save($this->data);
	}
	// pr( $this->data ); exit();
	// $this->Scientist->save($this->data['User']['Scientist']);
	$this->Scientist->save($this->data);

	$this->Session->setFlash('Your profile has been updated!', 'messages/success' );
	$this->redirect( $this->referer() );
      }
    } else {
      // we just got here (no post yet) so we'll get $this->data from the db rather than from what was just submitted
      $user=$this->Profile->find('first', array('conditions'=>array('Profile.id'=>$user_id), 'recursive' => 2 ) );
      if (empty($user))
	$user=$this->User->find('first', array('conditions'=>array('User.id'=>$user_id), 'recursive' => 2 ) );
      // pr( $user );
      // pr( $user_id );
      $this->data=$user;
    }
  }

  function edit_password(){
    if(empty($this->data)){

    }
    else{
      $correct=$this->User->find('count', array(
						'conditions'=>array(
								    'User.password'=>$this->Auth->password($this->data['User']['password']),
								    'User.id'=>$this->Auth->user('id'))));
      if($correct){
	$this->User->id=$this->Auth->user('id');
	$this->User->saveField('password', $this->Auth->password($this->data['User']['new_password']));
	$this->User->saveField('hash', '');

	$this->Session->setFlash('Your password has been changed.', '/messages/success');
	$this->redirect('/users/profile');
      }
      else
	$this->Session->setFlash('Your old password was incorrect');
    }
  }

	function reset_password($id=0, $hash=0){
    //if following email link
    if($hash && $id && strlen($hash)==32){
    	//$can_be=array('eureka', 'donate', 'science_rules', 'earth');
      //$password=$can_be[rand(0, sizeof($can_be)-1)]; 
      $password = $this->randPassword();
      $correct=$this->User->find('count', array(
						'conditions'=>array(
								    'User.hash'=>$hash)));
      if($correct){
				$this->User->id=$id;

				//leaving the hash as is. if hash is not blank on login, we redirect to change password page
				$this->User->saveField('hash', '');
				//echo $this->Auth->password($password);
				
				//pr($this->User->saveField('password', $this->Auth->password($password)));
				$this->User->saveField('password', $this->Auth->password($password));
				$this->Session->setFlash("Your password has been reset to: $password . Please login and change your password.", '/messages/success');
				$this->render('/users/login');
      }
      else{
				$this->Session->setFlash('This password reset request has already been filled');
      }
    }
    //if following incorrect email link
    else if(strlen($hash)!=32 && ($id || $hash)){
      $this->Session->setFlash('Your reset password link is malformed. Please ensure it is correct and try again');
    }
    else{
      //send email
      if(!empty($this->data)){
				$user=$this->User->find('first', array('conditions'=>array('User.email'=>$this->data['User']['email'], 'User.active'=>1)));
				if(!empty($user)){
				  $hash=md5(rand(1, 1000));
				  $this->User->id=$user['User']['id'];
				  $this->User->saveField('hash', $hash);
				  $this->sendResetPasswordEmail($user['User']['id'], $user['User']['fname'], $user['User']['email'], $hash);
				  $this->Session->setFlash('An email has been sent to you. Please follow the link in the message to verify your password reset', '/messages/success');
				}
				else{
	  			$this->Session->setFlash('A user with that email address could not be found. Please check it and try again');
				}
      }     
    }
  }
  
  
	function randPassword()
	{
	   
		$n = 6; // length of generated password
	  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; // characters that can be used in password
	  $randPassword = '';
	  srand((double)microtime()*1000000);
	  $m = strlen($characters);
	  while($n--)
	  {
	    $randPassword .= substr($characters,rand()%$m,1);
	  }
	  return $randPassword;
	}


  function sendResetPasswordEmail($id, $name, $email, $hash){
    $this->Email->to = $email;
    $this->Email->subject = "EurekaFund Password Reset";
    $this->Email->from = "EurekaFund <accounts@eurekafund.org>";

    $this->set('greeting', $name);
    $this->set('reset_link', HTTP_BASE."users/reset_password/$id/$hash");

    $this->Email->template = 'password_reset';
    $this->Email->sendAs = 'text'; 
    $this->Email->send();
  }


  /*
  function edit_science(){
    // it'd be nice if admin could edit any user
    // but first let's make it work when users edit themselves.
    // if(!$this->Auth->user('privileges'))
    $user_id=$this->Auth->user('id');

    $this->helpers[] = 'Geography';
    $this->set('expertise', $this->Expertise->find('list'));

    if (empty($this->data)){
      $this->data=$this->Scientist->find('first', array(
							'conditions'=>array(
									    'Scientist.id'=>$user_id)));				
    }
    else{
      if( $this->data['Document']['path']['name'] ) { // if user upload a doc 
	if ( !$this->data['Document']['path']['error'] ) { // there wasn't an error
	  $this->data['Document']['foreign_id']=$user_id;
	  $destination = realpath('../../app/webroot/files/cv/') . '/';      
	  $file = $this->data['Document']['path'];
	  $result = $this->Upload->upload($file, $destination);
	  if (!empty($this->Upload->result)){
	    $this->data['Document']['path'] = 'files/cv/'.$this->Upload->result;
	    $this->data['Document']['type']='scientist_cv';
	    $this->Document->save($this->data);
	    $this->Upload->result;
	  }
	  else{
	    $this->Session->setFlash('CVs must be DOC or PDF file');
	  }
	}
      }
      $this->data['Scientist']['id']=$user_id;
      $this->data['Scientist']['user_id']=$user_id;
      $this->Scientist->save($this->data);
      $this->Session->setFlash( "Profile Updated!" );
      $this->redirect( '/users/profile' );
    }
    $links=$this->Link->find('all', array(
					  'conditions'=>array(
							      'Link.foreign_id'=>$user_id,
							      'Link.type'=>'profile')));
    $this->set('my_links', (empty($links) ? array() : $links));

    $docs=$this->Document->find('all', array(
					  'conditions'=>array(
							      'Document.foreign_id'=>$user_id,
							      'Document.type'=>'scientist_cv')));
    $this->set('my_docs', (empty($docs) ? array() : $docs));

  }
  */

  function image(){
    $user=$this->Profile->find('first', array(
					      'conditions'=>array(
								  'Profile.id'=>2)));
    pr($user);
  }

  function myfile(){
    $scientist=$this->Scientist->find('first', array(
						     'conditions'=>array(
									 'Scientist.user_id'=>2)));
    pr($scientist);
  }

}
?>