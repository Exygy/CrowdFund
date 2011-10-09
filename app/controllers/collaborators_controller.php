<?php
class CollaboratorsController extends AppController {
  
  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
    function add() {
    
		if (!empty($this->data)) {
				$this->Collaborator->create(false);
				$collaborator = $this->Collaborator->save($this->data);
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $collaborator = $this->Collaborator->find('first', array(
    		'conditions' => array('Collaborator.project_id' => $id) 
			)
		);

		return $collaborator;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->Collaborator->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $collaborator = $this->Collaborator->find('first', array(
    		'conditions' => array('Collaborator.id' => $id) 
			)
		);

		$this->set('collaborator', $collaborator);
		//pr($collaborator);
	
	}	

	
}

?>