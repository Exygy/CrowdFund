<?php
class ProjectsController extends AppController {
	var $uses = array('Project', 'ProjectCategory', 'LineItem', 'LineItemCategory', 'Donation', 'Users', 'Profile');
	var $helpers = array('Paginator');
  // var $components = array('AuthorizeNet', 'Email', 'Security'); 
  var $components = array('AuthorizeNet', 'Email' ); 
    
    var $paginate = array(
        'limit' => 6,        
        'order' => array(
            'Project.timestamp' => 'desc'
        )
    );
  
  function beforeFilter() {
    $this->ssl_required_actions = array( 'donate' );
    parent::beforeFilter();
    $this->Auth->allow('feature', 'category', 'view', 'search', 'donate', 'details', 'financialDetails', 'home');
    if ($this->action=="loginDonate")
      $this->Auth->authError='Please login below.';
  }

  


  function admin_index() {
    $this->set( 'new_projects', $this->Project->findAllByStatus( 'NEW' ) );
    $this->set( 'pending_projects', $this->Project->findAllByStatus( 'PENDING' ) );
    $this->set( 'approved_projects', $this->Project->findAllByStatus( 'APPROVED' ) );
    $this->set( 'inactive_projects', $this->Project->findAllByStatus( 'INACTIVE' ) );
    $this->set( 'project_status_list', array( 'NEW' => 'NEW',
						'PENDING' => 'PENDING',
						'APPROVED' => 'APPROVED',
						'INACTIVE' => 'INACTIVE' ) );

  }

  function admin_bulk_update() {
    foreach( $this->data['Project'] as $project_id => $project ) {
      $this->Project->id = $project_id;
      $this->Project->saveField( 'status', $project['status'] );
    }
    $this->redirect( $this->referer() );
  }

    function index($filterid = null) {
   
   		$this->redirect('/projects/category/');
   		 
       	$this->layout = 'browse';

        //grab all projects and pass it to the view:
        //$projects = $this->Project->find('all');
        
        
        /*
        if ($filterid) {
        	$conditions = array('Project.status' => 'APPROVED', 'Project.project_category_id' => $filterid);
        } else {    
	        $conditions = array('Project.status' => 'APPROVED');
        }
        */
        
        
        
        $projects = $this->Project->find('all', array(
        	//'conditions' => $conditions,
			'order' => array('Project.timestamp DESC'), //string or array defining order
			'recursive' => 2, //int
        	)
        ); 
    	$this->set('projects', $projects); 	
        //pr($projects);
    }
    
    
    //VIEW PROJECTS IN CATEGORY, IF NO FILTER ID THEN VIEW ALL
    function category($filterid = null, $filter_only_live = null ) {
    
    	$this->layout = 'browse';
    	
 		//grab all projects and pass it to the view:
        //$projects = $this->Project->find('all');
		$this->set('projectCategories', $this->ProjectCategory->find('list'));			
        $this->helpers[] = 'Time';
        
	if ($filterid) {
        	$conditions = array('Project.status' => 'APPROVED', 'Project.project_category_id' => $filterid);
        } else {    
	        $conditions = array('Project.status' => 'APPROVED');
        }
        

	if ( $filter_only_live ) {
	  $conditions['Project.is_demo'] = '0';
	}

        /*
        $projects = $this->Project->find('all', array(
        	'conditions' => $conditions,
			'order' => array('Project.timestamp DESC'), //string or array defining order
        	)
        );
        */
        
        $projects = $this->paginate('Project', $conditions);
 
    	$this->set('projects', $projects); 	

        //pr($projects);
    
    }
    
    function view($project_identifier) {
      if ( is_numeric( $project_identifier ) ) {
				$projectID = $project_identifier;
      } else {
				// because we need to recurse we'll just get the project_id and then refetch the project below
    		$project = $this->Project->findBySlug( $project_identifier );
			if ( ! $project ) { $projectID = -1; }
				$projectID = $project['Project']['id'];
      }

      // for the "special" project of donating directly w/o a project
      if ( $projectID == 0 ) {
				$this->redirect( "/" );
				return;
      }

      $project = $this->Project->find('first', array(
						     'conditions' => array('Project.id' => $projectID), 
						     'recursive' => 2, //int
						     )
				      );

      if( ! $project ) {
				$this->set( 'error_details', "Project Does not exist" );
				$this->render( '/elements/standard-error' );
				return;
      }

      //if project is not approved, only the creator or admin can view it.
      if ($project['Project']['status'] != 'APPROVED') {
				$user = $this->Auth->user();
				
				if ( empty($user) ||  (($user['User']['id'] != $project['Project']['user_id']) && $user['User']['privileges'] != 1) ) {
				  $this->set( 'error_details', "Project Is Not Public" );
				  $this->render( '/elements/standard-error' );
				  return;
				}
	
      }
      usort($project['LineItem'], array('ProjectsController','cmpLineItemCat'));
      
      $lineItemCategories = array();
      $lineItemCategories[0] = '';
      $lineItemTotals = array();
      $i=0;
      foreach ($project['LineItem'] as $lineItem) {
				if (!in_array($lineItem['LineItemCategory']['title'], $lineItemCategories)) {
				  $i++;
				  $lineItemCategories[$i] = $lineItem['LineItemCategory']['title'];
				  $lineItemTotals[$i] = $lineItem['amount'];
				} else {
				  $lineItemTotals[$i] += $lineItem['amount'];
				}
      } 
      
      $this->set('project', $project['Project']);
      $this->set('goal', $project['goal']);
      $this->set('project_category', $project['ProjectCategory']);
      $this->set('images', $project['Image']);
      $this->set('videos', $project['EmbeddedVideo']);
      $this->set('documents', $project['Document']);
      $this->set('donations', $project['Donation']);	    	
      $this->set('user', $project['User']);
      $this->set('outsideFunds', $project['OutsideFundingSource']);	    	
      $this->set('lineItems', $project['LineItem']);
      $this->set('lineItemCategories', $lineItemCategories);
      $this->set('lineItemTotals', $lineItemTotals);
      $this->set('links', $project['Link']);	    	
      $this->set('collaborators', $project['Collaborator']);

      // metas
      $this->pageTitle = 'Help fund Seed Science: ' . $project['Project']['title'];
    }
        
    
    
    function details($project_identifier) {
      $this->view($project_identifier);
    }

    function financialDetails($project_identifier) {
      $this->view($project_identifier);
      $this->layout = 'stripped';
    }
    
    
    
    function add() {
		//$this->set('tab', $tab);
				
   		$this->set('projectCategories', $this->ProjectCategory->find('list'));			

		if (!empty($this->data)) {
		
			// We can save the Project data:
	 
			//$project = $this->Project->save($this->data);
	
			// If the user was saved, Now we add this information to the data
			// and save the Profile.
	      
			//if (!empty($project)) {
				// The ID of the newly created user has been set
				// as $this->User->id.
				
				$user = $this->Auth->user(); //we can assume this returns a user if they were able to get past Auth->allow ?
								
				$this->data['Project']['user_id'] = $user['User']['id'];
				$this->data['Project']['status'] = 'NEW';
				$this->data['Project']['timestamp'] = date('Y-m-d H:m:s');
				
      			$this->Project->set($this->data);		        
		        if (!$this->Project->validates()) {
					$invalids = $this->Project->invalidFields();
					$html_str = 'Please check the following errors: <ul>';
					foreach ($invalids as $field=>$invalid) {
						$html_str .= '<li>'.ucwords($field).': '.$invalid.'</li>';
					}
					$html_str .= '</ul>';
					$this->Session->setFlash($html_str, 'messages/error');					
				} else {
					//we validated! 
					$this->data['Project']['completed_steps'] = 1;

					//check if homepage is entered, if so check if it needs 'http://'
					if (!empty($this->data['Project']['homepage'])) {
						$path = ($this->data['Project']['homepage']);
						if (strpos($path, 'http://')===false) {
							$path = 'http://'.$path;
						} 
						$this->data['Project']['homepage'] = $path;
					}

					$project = $this->Project->save($this->data);
				}
	
				//pr( $project ); exit();
				if (!empty($project)) {
				
					$this->Session->setFlash(EUREKA_PROJECT_SAVE_SUCCESSFUL_EN, 'messages/success');

					//Project has been added, now let's edit the next tab
					$url = '/projects/edit/2/'.$this->Project->id;		
					$this->redirect($url);
				
				} else {
					//$this->redirect($this->referer());				
				}
			
		}
	}
    
	function edit($tab = null, $project_identifier = null) {

		 //Configure::write('debug', '1');

	      if ( is_numeric( $project_identifier ) ) {
			$id = $project_identifier;
	      } else {
			// because we need to recurse we'll just get the project_id and then refetch the project below
	    	$project = $this->Project->findBySlug( $project_identifier );
			if ( ! $project ) { $id = -1; }
			$id = $project['Project']['id'];
	      }
	      
	
		$user = $this->Auth->user(); //we can assume this returns a user if they were able to get past Auth->allow ?

		$thisProject = $this->Project->findById($id);
			
		if (empty($thisProject)) {
			$this->Session->setFlash('Project not found.', 'messages/error');		
			$this->redirect(HTTP_BASE.'projects/category');
		}
		
		//kick out users who are not the project owner or admin
		if (($user['User']['id'] != $thisProject['Project']['user_id']) && $user['User']['privileges'] != 1) {
			$this->Session->setFlash('You must be logged in as the proposal creator to continue editing.', 'messages/error');
			$this->redirect(HTTP_BASE.'users/login');
			//$this->log('hi');
		}
		
		$completed = $thisProject['Project']['completed_steps'];
		//don't let users edit tabs they can't access yet
		if ($completed < ($tab-1)) {
			$this->Session->setFlash('Please check the incomplete areas of your submission before proceeding.', 'messages/error');
			$this->redirect(HTTP_BASE.'projects/edit/'.($completed+1).'/'.$id);			
		}
		
		//kick out non-admins who try to edit a non-NEW project
		if ($user['User']['privileges']!=1 && $thisProject['Project']['status']!='NEW') {
			$this->Session->setFlash('Your project is currently locked from further editing.', 'messages/error');
			$this->redirect(HTTP_BASE.'projects/view/'.$id);					
		}
		
		$this->set('completed_steps', $completed);			
	
	
		$this->set('tab', $tab);
		$this->set('lineItemCategories', $this->LineItemCategory->find('list'));			
		$this->set('projectCategories', $this->ProjectCategory->find('list'));			
     	$this->set('projectId', $id);			
		
		switch ($tab) {
				case 1:
		        //preserve line breaks... or not.
		        //$this->data['Project']['abstract'] = nl2br($this->data['Project']['abstract']);       	
	       		$this->set('tabtitle', 'Project Basics');
	       		break;

				case 2:
	       		$this->set('tabtitle', 'Financial Details');
	       		break;

				case 3:
	       		$this->set('tabtitle', 'Collaborators');
	       		break;

				case 4:
	       		$this->set('tabtitle', 'Project Details');
	       		break;
	       		
				case 5:
	       		$this->set('tabtitle', 'Submit for Approval');
	       		break;

		}	
			       

		if (empty($this->data)) {
			//grab existing data so we can edit it
			$this->data = $thisProject;
       		
		} else if(!empty($this->data)) {
	        //Otherwise, we have submitted...      
	        //LATER -- have to check if user is logged in, and set their user id here;
            $this->data['Project']['user_id'] = $user['User']['id'];
			$this->data['Project']['id'] = $id;
			
			//make sure NOT to save over the original user_id (if we are editing as admin) 
			if ($this->data['Project']['user_id'] != $thisProject['Project']['user_id']) {
				$this->data['Project']['user_id'] = $thisProject['Project']['user_id'];
			}
						
			switch ($tab) {
				case 1:
		        //preserve line breaks... or not.
		        //$this->data['Project']['abstract'] = nl2br($this->data['Project']['abstract']);
		        
      			$this->Project->set($this->data);		        
		        if (!$this->Project->validates()) {
					$invalids = $this->Project->invalidFields();
					$html_str = 'Please check the following errors: <ul>';
					foreach ($invalids as $field=>$invalid) {
						$html_str .= '<li>'.ucwords($field).': '.$invalid.'</li>';
					}
					$html_str .= '</ul>';
					$this->Session->setFlash($html_str, 'messages/error');					
				} else {
					//we validated!
					//check if homepage is entered, if so check if it needs 'http://'
					if (!empty($this->data['Project']['homepage'])) {
						$path = ($this->data['Project']['homepage']);
						if (strpos($path, 'http://')===false) {
							$path = 'http://'.$path;
						} 
						$this->data['Project']['homepage'] = $path;
					}
					$project = $this->Project->save($this->data);
				}
		        
		              
	       		break;
	       		
				case 2:
				//$thisProject = $this->Project->findById($id);
				if (empty($thisProject['LineItem'])) {
	           		$this->Session->setFlash("You must add at least one line item before proceeding.", 'messages/error');
				} else {
					if ($thisProject['Project']['completed_steps'] < $tab) {
						$thisProject['Project']['completed_steps'] = $tab; //as long as we've reached this tab, it's 'completed'
					}
					$project = $this->Project->save($thisProject);
				}
								
				break;
	       		
	       		default: 
				//$thisProject = $this->Project->findById($id);
				if ($thisProject['Project']['completed_steps'] < $tab) {
					$thisProject['Project']['completed_steps'] = $tab; //as long as we've reached this tab, it's 'completed'
					$project = $this->Project->save($thisProject);
				} else {
					$project = $thisProject;
				}
	       		
	       		break; 
			}
			
			if (!empty($project)) {

			    if (!empty($this->data['form_action'])) {
	        		$action = $this->data['form_action'];
	        		if (!empty($action['save'])) {
   		   				$this->Session->setFlash(EUREKA_PROJECT_SAVE_SUCCESSFUL_EN, 'messages/success');	            			
	        			$url = $this->referer();
	        		} else if (!empty($action['preview'])) {
	            		$url = '/projects/view/'.$id;
	        		}
	        	} else {
		            $newtab = $tab+1;
		            if ($tab < 4) {
						$url = '/projects/edit/'.$newtab.'/'.$id;		
		            } else {
	        			//$url = $this->referer();
	            		$url = '/projects/view/'.$id;

		            }
	        	
	        	}
	        	
   				$this->redirect($url);

	        } else {
	        	//there are some validation errors -- don't redirect?
				
   				//$this->Session->setFlash("There was an error, please try again", , 'messages/error');	       
   				//$this->redirect($this->referer());
   				     
	        }
			
			//pr($this->data); exit;
			

	    }

	}
	
	
	
	
	function submit($id) {
		$user = $this->Auth->user(); //we can assume this returns a user if they were able to get past Auth->allow ?

		$thisProject = $this->Project->findById($id);
			
		if (empty($thisProject)) {
			$this->Session->setFlash('Project not found.', 'messages/error');		
			$this->redirect(HTTP_BASE.'projects/category');
		}
		
		//kick out users who are not the project owner or admin
		if (($user['User']['id'] != $thisProject['Project']['user_id']) && $user['User']['privileges'] != 1) {
			$this->Session->setFlash('You must be logged in as the proposal creator to submit this project.', 'messages/error');
			$this->redirect(HTTP_BASE.'users/login');
			//$this->log('hi');
		}
		
		$completed = $thisProject['Project']['completed_steps'];
		//don't let users submit if they're not done
		if ($completed < (4)) {
			$this->Session->setFlash('Please check the incomplete areas of your submission before proceeding.', 'messages/error');
			$this->redirect(HTTP_BASE.'projects/edit/'.($completed+1).'/'.$id);			
		}
		
		//kick out non-admins who try to submit a non-NEW project
		if ($user['User']['privileges']!=1 && $thisProject['Project']['status']!='NEW') {
			$this->Session->setFlash('Your project has already been submitted.', 'messages/error');
			$this->redirect(HTTP_BASE.'projects/view/'.$id);					
		}

		$thisProject['Project']['status'] = 'PENDING'; //update its status
		$project = $this->Project->save($thisProject);
	
		if (!empty($project)) {	
			$this->Session->setFlash('Thanks! Your project has been submitted. EurekaFund will contact you regarding its approval status.', 'messages/success');
			//send email
			$this->sendEmail($id);
			
			$link = "<a href=\"".HTTP_BASE."users/profile\">scientist profile</a>"; 		
			$message = "Thanks! Your project has been submitted. EurekaFund will contact you regarding its approval status.<br/><br/> Have you updated your ".$link."?<br /> Did you know that visitors will be able to get to your ".$link." page with one click from your project? <br />Projects with completed ".$link." pages are 80% more likely to get donated to! <br /><a href=\"".HTTP_BASE."users/edit\">Update your profile now!</a>";
			$this->Session->setFlash($message, 'messages/success');
		} else {
		}
		$this->redirect(HTTP_BASE);

	}
	
  function sendEmail($id){
    $project=$this->Project->findById($id);
    $admins=$this->Users->find('all', array(
				       'conditions'=> array(
							    'privileges'=> 1)));

    //email user
    $this->Email->to = $project['User']['email'];
    $fname= $project['User']['fname'];
    $this->Email->subject = "Your EurekaFund proposal has been submitted";
    $this->Email->from = "EurekaFund <projects@eurekafund.org>";

    $msg="Hi $fname, \n
Your project has been submitted for approval. It is now locked and an administrator will be reviewing the project.";

    $this->Email->send( $msg ); 


    //email admin
    foreach($admins as $user){
      $this->Email->to = $user['Users']['email'];
      $fname= $user['Users']['fname'];
      $this->Email->subject = "A EurekaFund proposal has been submitted";
      $this->Email->from = "EurekaFund <projects@eurekafund.org>";

      $msg="Hi $fname, \n
A project has been submitted for approval. Please review it at: \n".
HTTP_BASE."projects/view/".$id;

      $this->Email->send( $msg ); 
    }

  }
	
		
  function loginDonate( $project_id = 0, $project_donation_amt = null){
    $this->redirect("/projects/donate/$project_id/$project_donation_amt");
    exit();
  }

  function switch2ssl(){
    if(!$this->RequestHandler->isSSL()) {
      $this->redirect('https://'.$_SERVER['SERVER_NAME'].$this->here);
    }
  }

	function donate( $project_id = 0, $project_donation_amt = null ) {
	  $this->switch2ssl();
	  if (!empty($this->data)) {
	    // try and process donation
	    $this->Donation->set( $this->data );
	    
	    // validate data
	    if ( $this->Donation->validates() ) {
	      if(empty($this->data['Donation']['eureka_donation_amt'])){
		$this->data['Donation']['eureka_donation_amt']='0.00';
	      }

	      // strip out non numerics from donations
	      $this->data['Donation']['project_donation_amt'] = ereg_replace( '[^0-9\.]+', '', $this->data['Donation']['project_donation_amt']  );
	      $this->data['Donation']['eureka_donation_amt'] = ereg_replace( '[^0-9\.]+', '', $this->data['Donation']['eureka_donation_amt']  );

	      // process card
	      
	      $billinginfo = array( 'fname' => $this->data['Donation']['fname'],
				    'lname' => $this->data['Donation']['lname'],
				    'address' => '',
				    'city' => '',
				    'state' => '',
				    'country' => '',
				    'zip' => $this->data['Donation']['card_zip']
				    );
	      $shippinginfo = array( 'fname' => $this->data['Donation']['fname'],
				     'lname' => $this->data['Donation']['lname'],
				     'address' => '',
				     'city' => '',
				     'state' => '',
				     'country' => '',
				     'zip' => '',
				     );
	      $project = $this->Project->find('first', array(
							     'conditions' => array('Project.id' => $project_id), 
							     'recursive' => 0, //int
							     )
					      );
	      $total_donation_amt = $this->data['Donation']['project_donation_amt'] + $this->data['Donation']['eureka_donation_amt'];
	      $description = "Donation to project \"" . $project['Project']['title'] . "\".  $" . $this->data['Donation']['project_donation_amt'] . " for project, $" . $this->data['Donation']['eureka_donation_amt'] . " for Eureka.";
	      $email = $this->data['Donation']['email'];
	      $phone = "";
	      $response = $this->AuthorizeNet->chargeCard( 
							  EUREKA_AUTHORIZE_NET_LOGIN_ID, 
							  EUREKA_AUTHORIZE_NET_TX_KEY, 
							  $this->data['Donation']['card_num'], 
							  $this->data['Donation']['card_expiry']['month'], 
							  $this->data['Donation']['card_expiry']['year'], 
							  $this->data['Donation']['card_cvv'], 
							  EUREKA_AUTHORIZE_NET_LIVE,
							  $total_donation_amt,
							  0, 
							  0, 
							  $description,
							  $billinginfo, 
							  $email,
							  $phone,
							  $shippinginfo);

	      if ( $response[1] != 1 ) {
		$error_message = 'There was an error with your transaction';
		if ( isset( $response[4] ) ) { 
		  $error_message .= ': ' . $response[4];
		}
		$this->Session->setFlash( $error_message );
	      } else {

		// create record of donation

		// because we only ask for YM for expiry, we need to add a day or SQL statement doesn't get properly constructed
		$this->data['Donation']['card_expiry']['day'] = '01';

		if($this->Auth->user())
		  $this->data['Donation']['user_id']=$this->Auth->user('id');
		$this->data['Donation']['card_num']=substr($this->data['Donation']['card_num'],-4);
		// $this->data['Donation']['id'] = 0;
		// pr( $this->data );
		$this->Donation->save($this->data, false);
		
		// thank user
		$this->set('id', $project['Project']['id']);
		$this->set('project', $project['Project']);
		$this->Session->setFlash('Donation Success! Thank you for your contribution.  You should receive a receipt in your email shortly. 	<p>	These projects need to be fully funded before they can be carried out, and it will only be possible with the help from people like you! Now that you\'ve donated, please spread the word!</p>', 'messages/success');
		$this->sendReceipt($this->data['Donation']['email'], $this->data['Donation']['fname'], $this->data['Donation']['lname'], $this->data['Donation']['project_id'], $total_donation_amt);
		$this->render( '/projects/donation_complete');
		
		return;
	      }
	    }
	  }
	  $project = $this->Project->find('first', array(
							 'conditions' => array('Project.id' => $project_id), 
							 'recursive' => 0, //int
							 )
					  );
	  if ( ! $project ) { $this->redirect('/'); }
	  $this->data['Project'] = $project['Project'];
	  if ( isset( $project_donation_amt ) ) { $this->data['Donation']['project_donation_amt'] = $project_donation_amt . ".00"; }

	  $this->set('amt', $project_donation_amt);
	  $this->set('projectCategories', $this->ProjectCategory->find('list'));			
	}

	function donation_complete() {
	/*
	      $project = $this->Project->find('first', array(
							     'conditions' => array('Project.id' => 6), 
							     'recursive' => 0, //int
							     )
					      );
		$this->set('project', $project['Project']);
	*/
	}
  function sendReceipt($email, $fname, $lname, $project_id, $amt){
    $this->Email->to = $email;
    $this->Email->subject = "Thank You! Your EurekaFund Receipt";
    $this->Email->from = "EurekaFund <donations@eurekafund.org>";
    $date=date('m/d/Y');
    $amt='$'.number_format($amt, 2);
    $project=$this->Project->find('list', array('conditions'=>array('id'=>$project_id)));
    $msg="Dear $fname,\n
Thank you for your donation on Eureka Fund. Below is notice of your contribution, for your records.\n 
Name:  $fname $lname \n
Donation Amount: $amt \n
Donation Date: $date \n
We encourage you to check out our current list of research projects that need funding on www.EurekaFund.org\n
Thanks again for your continued support!\n
The Eureka Fund Team


Eureka Fund, Inc.
335 Chestnut Street 
San Francisco, CA, 94133, USA
www.eurekafund.org


Eureka Fund is a registered 501(c)3 tax-exempt organization. Our EIN is 26-4351384.  
";
 
    $this->Email->send( $msg ); 
  }

  
	
    /*
     $response[1] = Response Code (1 = Approved, 2 = Declined, 3 = Error, 4 = Held for Review)
     $response[2] = Response Subcode (Code used for Internal Transaction Details)
     $response[3] = Response Reason Code (Code detailing response code)
     $response[4] = Response Reason Text (Text detailing response code and response reason code)
     $response[5] = Authorization Code (Authorization or approval code - 6 characters)
     $response[6] = AVS Response (Address Verification Service response code - A, B, E, G, N, P, R, S, U, W, X, Y, Z)
     (A, P, W, X, Y, Z are default AVS confirmation settings - Use your Authorize.net Merchant Interface to change these settings)
     (B, E, G, N, R, S, U are default AVS rejection settings - Use your Authorize.net Merchant Interface to change these settings)
     $response[7] = Transaction ID (Gateway assigned id number for the transaction)
     $response[38] = MD5 Hash (Gateway generated MD5 has used to authenticate transaction response)
     $response[39] = Card Code Response (CCV Card Code Verification response code - M = Match, N = No Match, P = No Processed, S = Should have been present, U = Issuer unable to process request)
    */


	//Used for sorting Line Items into categories
	function cmpLineItemCat($a, $b) {
	//pr($a);
	    if ($a['LineItemCategory']['id'] == $b['LineItemCategory']['id']) {
	        return 0;
	    }
	    return ($a['LineItemCategory']['id'] < $b['LineItemCategory']['id']) ? -1 : 1;
	}
	
  function admin_donations(){
    $projects=$this->Project->find('all', array('recursive'=>2));
    $this->set('projects', $projects);
    
      $scientist=$this->User->find('all');
    $this->set('scientist', $scientist);
	
  }

  function admin_donors($project_id){
    $donors=$this->Donation->find('all', array(
						'conditions'=>array(
								    'Donation.project_id'=>$project_id)));
    $this->set('donors', $donors);
  }
				
				
	function admin_feature(){
		$projects=$this->Project->find('list', array('conditions'=> array('status' => 'APPROVED'), 'fields' => 'title'));
	  $this->set('projects', $projects);
	  $this->set('project_featured', $this->getIdProjectFeatured());

		$scientists= $this->User->find('superlist',array('conditions' => array('type' => 'scientist','active' => 1), 'fields' => array('User.id', 'User.lname','User.fname'), 'order' => 'lname'));
		$this->set('scientists', $scientists);
		$this->set('scientist_featured', $this->getIdScientistFeatured());
		
		if(!empty($this->data)) {
			$project_id = $this->data['Project']['id'];
			$scientist_id = $this->data['User']['id'];
			
			// the old project and scientist won't be featured anymore
			$old_scientist = $this->getIdScientistFeatured();
			if (!empty($old_scientist)) {
				$this->User->create();
				$this->User->id = $old_scientist;
				$this->User->saveField( 'is_featured', '0' );
			}
				
			$old_project = $this->getIdProjectFeatured();
			if (!empty($old_project)) {
				$this->Project->create();	
				$this->Project->id = $old_project;
				$this->Project->saveField( 'is_featured', '0' );
			}

			// the project and scientist chosen will be featured
			if (!empty($project_id)) {			
				$this->Project->create();		
				$this->Project->id = $project_id;
	      $this->Project->saveField( 'is_featured', '1' );
    	}
      
			if (!empty($scientist_id))   {    
	      $this->User->create();
	     	$this->User->id = $scientist_id;
				$this->User->saveField( 'is_featured', '1' );
			}	
			$this->redirect( $this->referer() );
		}	
	}					
   
	function  getIdProjectFeatured(){
 		$project = $this->Project->find('first', array('conditions'=> array('Project.is_featured' => '1')));
 		$project_id = $project['Project']['id'];
 		return $project_id;
 	}
 	
 	function getIdScientistFeatured(){
 		$scientist = $this->User->find('first', array('conditions'=> array('User.is_featured' => '1')));
 		$scientist_id = $scientist['User']['id'];
 		return $scientist_id;
 	}
 	
 	
 	function feature() {
 		$this->layout = 'home';
 		$this->pageTitle = '';
 		
 		$project = $this->Project->find('first', array('conditions'=> array('Project.is_featured' => '1')));
 		$scientist_id = $this->getIdScientistFeatured();
 		$scientist = $this->Profile->find('first', array('conditions'=> array('Profile.id' => $scientist_id)));
 		
 		$this->set('project', $project); 	
 		$this->set('scientist', $scientist); 	
 		
 	}
 	
 	function home() {
 		$this->layout = 'home';
 		$this->pageTitle = '';
 		
 		$project = $this->Project->find('first', array('conditions'=> array('Project.is_featured' => '1')));
 		$scientist_id = $this->getIdScientistFeatured();
 		$scientist = $this->Profile->find('first', array('conditions'=> array('Profile.id' => $scientist_id)));
 		
 		$this->set('project', $project); 	
 		$this->set('scientist', $scientist); 	
 	}
}

?>