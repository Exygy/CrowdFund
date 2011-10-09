<?php
class LinksController extends AppController {


  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
    function add() {
    
		if (!empty($this->data)) {
				$this->Link->create(false);
				$link = $this->Link->set($this->data);
												
				if (!$this->Link->validates()) {
					$invalids = $this->Link->invalidFields();
					$html_str = 'Please check the following errors: <ul>';
					foreach ($invalids as $field=>$invalid) {
						$html_str .= '<li>'.ucwords($field).': '.$invalid.'</li>';
					}
					$html_str .= '</ul>';
					$this->Session->setFlash($html_str, 'messages/error');					
				} else {
					$path = ($this->data['Link']['path']);
					if (strpos($path, 'http://')===false) {
						$path = 'http://'.$path;
					} 
					$this->data['Link']['path'] = $path;
					$this->Link->save($this->data);
				}
							
				
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $link = $this->Link->find('first', array(
    		'conditions' => array('Link.foreign_id' => $id) 
			)
		);

		return $link;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->Link->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $link = $this->Link->find('first', array(
    		'conditions' => array('Link.id' => $id) 
			)
		);

		$this->set('link', $link);
		//pr($link);
	
	}	

	
}

?>