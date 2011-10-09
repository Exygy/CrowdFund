<?php
class GoogleController extends AppController {
	
		public $uses = array('OauthUserToken', 'Project', 'ContactEmailAddress');
    public $components = array('OauthConsumer', 'Email');
   
    function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('');
  	}

  public function clear_token(){ 
    	$user = $this->Auth->user();
      $oauth_user_token = $this->OauthUserToken->find('first',array('conditions' => array('OauthUserToken.user_id' => $user['User']['id'])));
      $this->OauthUserToken->delete( $oauth_user_token );
    }
    public function index($project_id) {
    	$user = $this->Auth->user();
    	$oauth_user_token = $this->OauthUserToken->find('first',array('conditions' => array('OauthUserToken.user_id' => $user['User']['id'])));

    	if (!empty($oauth_user_token)) {    		
    		$this->redirect( '/google/show_contacts/'.$project_id );
    		
    	} else {
	      $requestToken = $this->OauthConsumer->getRequestToken('Google', 'https://www.google.com/accounts/OAuthGetRequestToken', 'GET', array( 
																		   'scope' => 'http://www.google.com/m8/feeds/',
																		   // 'scope' => 'http://www-opensocial.googleusercontent.com/api/people/',
																		   'oauth_callback' => HTTP_BASE . 'google/callback/'.$project_id ) );
				$this->Session->write('requestToken', $requestToken);
	
	  	 	$this->redirect('https://www.google.com/accounts/OAuthAuthorizeToken?oauth_token='.$requestToken->key);
			}
   	}
   	
   	public function callback($project_id) {
		  $requestToken = $this->Session->read('requestToken'); 
		  //pr($requestToken);
			$verifierToken = $this->params['url']['oauth_verifier'];

		  $accessToken = $this->OauthConsumer->getAccessToken('Google', 'https://www.google.com/accounts/OAuthGetAccessToken', $requestToken, 'GET', array(
		  																'oauth_verifier' => $verifierToken));


		  //save user's token in db
		  $user = $this->Auth->user();			  
		  $this->OauthUserToken->create();
		  $this->data['OauthUserToken']['key'] = $accessToken->key;
		  $this->data['OauthUserToken']['secret'] = $accessToken->secret;
		  $this->data['OauthUserToken']['user_id'] = $user['User']['id'];
		  $this->OauthUserToken->save($this->data);
		  //pr($this->data); exit;
		  $this->redirect( '/google/show_contacts/'.$project_id );
    }
    
    public function show_contacts($project_id) {
      $user = $this->Auth->user();
      $accessToken = $this->OauthUserToken->find('first',array('conditions' => array('OauthUserToken.user_id' => $user['User']['id'])));
      
      $data = $this->OauthConsumer->get('Google', 
					$accessToken['OauthUserToken']['key'], 
					$accessToken['OauthUserToken']['secret'], 
					'http://www.google.com/m8/feeds/contacts/default/full',
					array( 'alt' => 'json' )		
					);
      $datas = json_decode( $data, true);												

      $totalResults = $datas['feed']['openSearch$totalResults']['$t'];
      $itemsPerPage = $datas['feed']['openSearch$itemsPerPage']['$t'];
      $google_user_id = $datas['feed']['id']['$t'];
      $batches = floor( $totalResults / $itemsPerPage );

      $tab = array();
      for( $i = 0; $i < $batches; $i++ ) {
	if ($i == 50) break;
	$data = $this->OauthConsumer->get('Google', 
					  $accessToken['OauthUserToken']['key'], 
					  $accessToken['OauthUserToken']['secret'], 
					  'http://www.google.com/m8/feeds/contacts/'.urlencode($google_user_id).'/full',
					  array( 'alt' => 'json',
						 'start-index' => (($i*$itemsPerPage)+1) ,
						 'max-results' => 25 )		
					  );
	$datas = json_decode( $data, true)			;												
	foreach ($datas['feed']['entry'] as $data) {
	  if ( ! isset( $data['gd$email' ] ) ) { continue; }
	  foreach ($data['gd$email'] as $email){
	    $tab[$email['address']]= $data['title']['$t'].' ('.$email['address'].')';
	  }
	}
      }

      $this->set('contacts', $tab);
      $this->set('project_id', $project_id);
    }
    
    
    function recap() { 	
    	//pr($this->data);
			$this->set('contacts', $this->data['Google']['contact']);
			$this->set('project_id',$this->data['Google']['project_id']);
    }
    
    function message(){
    	
    	if(!empty($this->data)){
    		 
    		$contacts_decoded = explode( ',', urldecode($this->data['Google']['contacts_encoded'] ) );
    		$message = $this->data['Google']['Message'];
    		
    		$user = $this->Auth->user();
    		$user_name = $user['User']['fname'].' '.$user['User']['lname'];

    		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $this->data['Google']['project_id']) ) );
    		$project_url = HTTP_BASE."projects/view/".$project['Project']['slug'];
    		$project_title = $project['Project']['title'];

    		foreach ($contacts_decoded as $email){
		  $this->sendMail($email, $message, $user_name, $project_title, $project_url);
    			//save in db user_id, email_adress and message sent
    			$tab['ContactEmailAddress'] = array('sender_user_id' => $user['User']['id'], 'custom_text' => $message, 'email_type' => 'project', 'email_address' => $email);
    			$this->ContactEmailAddress->create();
    			$this->ContactEmailAddress->save($tab);
    	}
    		$this->redirect('/users/profile');
    	}
    }
    
    
    function  sendMail($email, $message, $user_name,$project_title, $project_url){
      $this->Email->to = "zach@exygy.com";
	    $this->Email->subject = "Check this out" ;
	    $this->Email->from = "EurekaFund <accounts@eurekafund.org>";
	
	    $this->set('message', $message);
	    $this->set('user_name', $user_name);
	    $this->set('project_name', $project_title);
	    $this->set('project_url', $project_url);
	
	    $this->Email->template = 'project_contact';
	    $this->Email->sendAs = 'text'; 
	    $this->Email->send();
  	}
  	
}

?>