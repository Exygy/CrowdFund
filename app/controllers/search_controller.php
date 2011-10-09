<?php
class SearchController extends AppController {
	var $uses = array('Project', 'ProjectCategory', 'LineItem', 'LineItemCategory', 'Donation');
	var $helpers = array('Paginator');
	var $components = array('AuthorizeNet'); 
	
    var $paginate = array(
        'limit' => 6,
        'order' => array(
            'Project.timestamp' => 'desc'
        )
    );
  
  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
  function index() {
  	//$this->find();
  
  }

	//for search input submitted by search box
  function input() {
	if (!empty($this->data)) {
		$searchstr = $this->data['searchstr'];
	} else {
		$searchstr=null;
	}
	
	$this->redirect(HTTP_BASE.'search/find/'.$searchstr);

  }  
  
      function find($searchstr=null) {
    	//pr($this->data);
    	
    
    	$this->layout = 'browse';
    	
		$this->set('projectCategories', $this->ProjectCategory->find('list'));			
        $this->helpers[] = 'Time';
     
	    $conditions = array('searchstr'=> $searchstr);
                
        $projects = $this->paginate('Project', $conditions);


        $this->set('searchstr', $searchstr);
    	$this->set('projects', $projects); 	    
    
    
    }


}

?>