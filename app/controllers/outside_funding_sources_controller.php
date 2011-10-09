<?php
class OutsideFundingSourcesController extends AppController {
  
  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
    function add() {
    
		if (!empty($this->data)) {
      			
				$this->OutsideFundingSource->create(false);
				$outsideFund = $this->OutsideFundingSource->save($this->data);
				
				if (!empty($outsideFund)) {
					$this->Session->setFlash('Outside funding information added', 'messages/success');
				} else {
					$this->Session->setFlash('Invalid input for Outside Funding Source', 'messages/error');				
				}
			//pr($this->data);
			
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $outsideFund = $this->OutsideFundingSource->find('first', array(
    		'conditions' => array('OutsideFundingSource.project_id' => $id) 
			)
		);

		return $outsideFund;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->OutsideFundingSource->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $outsideFund = $this->OutsideFundingSource->find('first', array(
    		'conditions' => array('OutsideFundingSource.id' => $id) 
			)
		);

		$this->set('outsideFund', $outsideFund);
		//pr(outsideFund);
	
	}	

	
}

?>