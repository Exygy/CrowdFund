<?php
class DocumentsController extends AppController {
	var $helpers = array('Html', 'Form');
	var $components = array('Upload');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
	
	function upload() {

		if (empty($this->data)) {
			$this->render();
		} else {
			//$this->cleanUpFields();
		  
			// pr($this->data);

			// set the upload destination folder
			$destination = realpath('../../app/webroot/files/uploaded/') . '/';

			// grab the file
			$file = $this->data['Document']['filedata'];

			// upload the document using the upload component
			$result = $this->Upload->upload($file, $destination, null, null, array( 'pdf', 'doc' ) );

			if (!$this->Upload->errors){
				$this->data['Document']['path'] = $this->Upload->result;
			} else {
				// display error
				$errors = $this->Upload->errors;
				// piece together errors
				if(is_array($errors)){ $errors = implode("<br />",$errors); }
   
					$this->Session->setFlash($errors);
					$this->redirect($this->referer());
					exit();
				}
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('Document has been added.', 'messages/success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Please correct errors below.');
				unlink($destination.$this->Upload->result);
			}
		
		}
		
	}


    function add() {
    
		if (!empty($this->data)) {
				$this->Document->create(false);
				$document = $this->Document->save($this->data);
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $document = $this->Document->find('first', array(
    		'conditions' => array('Document.foreign_id' => $id) 
			)
		);

		return $document;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->Document->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $document = $this->Document->find('first', array(
    		'conditions' => array('Document.id' => $id) 
			)
		);

		$this->set('document', $document);
	
	}
	
	// Based on comment 8 from: http://bakery.cakephp.org/articles/view/improved-advance-validation-with-parameters

	function isUploadedFile($params){
		$val = array_shift($params);
		if ((isset($val['error']) && $val['error'] == 0) ||
		(!empty($val['tmp_name']) && $val['tmp_name'] != 'none')) 
		{
			return is_uploaded_file($val['tmp_name']);
		} else {
			return false;
		}
	} 
		

	
}

?>