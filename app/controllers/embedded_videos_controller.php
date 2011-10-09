<?php
class EmbeddedVideosController extends AppController {

  var $components = array('Php5tube');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('*');
  }
  
    function add() {
    
		if (!empty($this->data)) {
				$vidInfo = $this->Php5tube->VideoInfo($this->data['EmbeddedVideo']['path']);
				if($vidInfo){
					$embedInfo = $vidInfo['object_tag'];
					$embedInfo = str_replace('width="425"', 'width="213"', $embedInfo);
					$embedInfo = str_replace('height="350"', 'height="175"', $embedInfo);
					
					$this->data['EmbeddedVideo']['embed'] =  $embedInfo;
					$this->EmbeddedVideo->create(false);
					$video = $this->EmbeddedVideo->set($this->data);
																		
					if (!$this->EmbeddedVideo->validates()) {
						$invalids = $this->EmbeddedVideo->invalidFields();
						$html_str = 'Please check the following errors: <ul>';
						foreach ($invalids as $field=>$invalid) {
							$html_str .= '<li>'.ucwords($field).': '.$invalid.'</li>';
						}
						$html_str .= '</ul>';
						$this->Session->setFlash($html_str, 'messages/error');					
					} else {
						$this->EmbeddedVideo->save($this->data);
						$this->Session->setFlash("Your video has been added", 'messages/success');											
					}
				}
				$this->redirect($this->referer());
		}
	}

		
	function find($id) {
	    $video = $this->EmbeddedVideo->find('first', array(
    		'conditions' => array('EmbeddedVideo.foreign_id' => $id) 
			)
		);

		return $video;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->EmbeddedVideo->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $video = $this->EmbeddedVideo->find('first', array(
    		'conditions' => array('EmbeddedVideo.id' => $id) 
			)
		);

		$this->set('embeddedvideo', $video);
		//pr($link);
	
	}	

	
}

?>