<?php
class LineItemsController extends AppController {
  var $uses=array('LineItem');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
    function add() {
    
		if (!empty($this->data)) {
				$this->LineItem->create(false);
				$lineItem = $this->LineItem->save($this->data);
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $lineItem = $this->LineItem->find('first', array(
    		'conditions' => array('LineItem.project_id' => $id) 
			)
		);

		return $lineItem;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';
		
	    $lineItem = $this->LineItem->find('first', array(
    		'conditions' => array('LineItem.id' => $id) 
			)
		);
		
		if (!empty($lineItem)) {
			$projectId = $lineItem['LineItem']['project_id'];
		    $lineItems = $this->LineItem->find('all', array(
	    		'conditions' => array('LineItem.project_id' => $projectId) 
				)
			);
			
			if (count($lineItems) > 1) {
			 	$this->LineItem->delete($id);
				$this->Session->setFlash('Line item successfully deleted', 'messages/success');
			} else {
				$this->Session->setFlash('You must have at least one line item in your budget. Please add another item before attempting to delete this one.', 'messages/error');			
			}

		} else {
				$this->Session->setFlash('Line item id not found', 'messages/error');
		}
	 	
	 	$this->redirect($this->referer());
	 	
		//$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $lineItem = $this->LineItem->find('first', array(
    		'conditions' => array('LineItem.id' => $id) 
			)
		);

		$this->set('lineItem', $lineItem);
		//pr($lineItem);
	
	}	

	
}

?>