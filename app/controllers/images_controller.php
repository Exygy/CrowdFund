<?php
class ImagesController extends AppController {
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
			
			//pr($this->data);

			// set the upload destination folder
			$destination = realpath('../../app/webroot/img/uploads/') . '/';
			$thumbdestination = realpath('../../app/webroot/img/uploads/thumbs/') . '/';

			// grab the file
			$file = $this->data['Image']['filedata'];

			// upload the image using the upload component
			$result = $this->Upload->upload($file, $destination, null, array('type' => 'resize', 'size' => 660, 'output' => 'jpg'));
			

			if (!$this->Upload->errors){
				$this->data['Image']['path'] = $this->Upload->result;
				
				
				$result = $this->Upload->upload($file, $thumbdestination, null, array('type' => 'resizecrop', 'size' => array(200,150), 'output' => 'jpg'));
				if (!$this->Upload->errors){
					$this->data['Image']['thumb_path'] = $this->Upload->result;
				} else {
					//pr($this->Upload->errors);
				}
				
			//pr($this->data);	die;

			} else {
				// display error
				$errors = $this->Upload->errors;
   
				// piece together errors
				if(is_array($errors)){ $errors = implode("<br />",$errors); }
   
					$this->Session->setFlash($errors);
					$this->redirect($this->referer());
					exit();
			}
				
				
			$image = $this->Image->set($this->data);
											
			if (!$this->Image->validates()) {
				unlink($destination.$this->Upload->result);
				$invalids = $this->Image->invalidFields();
				$html_str = 'Please check the following errors: <ul>';
				foreach ($invalids as $field=>$invalid) {
					$html_str .= '<li>'.ucwords($field).': '.$invalid.'</li>';
				}
				$html_str .= '</ul>';
				$this->Session->setFlash($html_str, 'messages/error');					
			} else {
			  $this->Image->deactivate_pics($this->Auth->user('id'));
			  $this->Image->save($this->data);
			  	$this->Session->setFlash('Image has been added.', 'messages/success');
			}
			$this->redirect($this->referer());
		
		}
		
	}


    function add() {
    
		if (!empty($this->data)) {
				$this->Image->create(false);
				$image = $this->Image->save($this->data);
				$this->redirect($this->referer());
		}
	}


	function sort() {
	
		//parse_str($_POST['sort_images']);
		//pr($_GET['sort_images']);
		//pr($_POST['data']);die;
		
		//$sort_images = $_GET['sort_images'];
		parse_str($_POST['data']);
		
		//pr($sort_images);
				
		for ($i = 0; $i < count($sort_images); $i++) {
		
		// SQL Query:
		// UPDATE `table` SET `order_column` = $i WHERE `id` = $list_to_sort[$i]
			$image = $this->Image->findById($sort_images[$i]);
			$image['Image']['order'] = $i;
			$this->data = $image;
			$this->Image->save($this->data);
		
		}
	}
		
	function find($id) {
	    $image = $this->Image->find('first', array(
    		'conditions' => array('Image.foreign_id' => $id) 
			)
		);

		return $image;
	}	
	
	function delete($id) {
		//$this->layout = 'ajax';

	 	$this->Image->delete($id);
	 	
		$this->autoRender = false;
	}	

		
	function view($id) {
		$this->layout = 'ajax';
	
	
	    $image = $this->Image->find('first', array(
    		'conditions' => array('Image.id' => $id) 
			)
		);

		$this->set('image', $image);
	
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
		
  function remove_profile_pic($id){
    $this->Image->id=$id;
    $this->Image->saveField('active', 0);
    $this->autoRender=false;
  }

  function set_profile_pic($id){

    $this->Image->id=$id;
    $this->Image->saveField('active', 0);
    $this->autoRender=false;
  }
  
  
  
  

	/* create thumbnails for images that don't have any */
	function updateThumbs() {
		$destination = realpath('../../app/webroot/img/uploads/') . '/';
		$thumbdestination = realpath('../../app/webroot/img/uploads/thumbs/') . '/';
		
		$images = $this->Image->find('all');
		
		foreach ($images as $image) {
			//$file = readfile($destination.$image['Image']['path']);
			
			if (empty($image['Image']['thumb_path']) || true) {
				$file = array();
				$file['tmp_name'] = $destination.$image['Image']['path'];
				$file['filename'] = $this->Upload->uniquename($thumbdestination . $image['Image']['path']);
				
				//pr(getimagesize($file['tmp_name']));die;
				
				$result = $this->makeThumb($file, 200, 150, $thumbdestination);

				if ($result != -1){
					$this->data = $image;
					$this->data['Image']['thumb_path'] = $result;
					//pr($this->data);die;
	  			    $this->Image->save($this->data);
				}
			}

		}
	}


	/* similar to image function in Upload component */ 
	function makeThumb($file, $maxW, $maxH, $destination) {
	
			$uploadSize = getimagesize($file['tmp_name']);
			$uploadWidth  = $uploadSize[0];
			$uploadHeight = $uploadSize[1];
			$uploadType = $uploadSize[2];
			
			if ($uploadType != 1 && $uploadType != 2 && $uploadType != 3) {
				//$this->error ("File type must be GIF, PNG, or JPG to resize");
			}
			
			switch ($uploadType) {
				case 1: $srcImg = imagecreatefromgif($file['tmp_name']); break;
				case 2: $srcImg = imagecreatefromjpeg($file['tmp_name']); break;
				case 3: $srcImg = imagecreatefrompng($file['tmp_name']); break;
				//default: $this->error ("File type must be GIF, PNG, or JPG to resize");
			}
						
					// -- resize to max, then crop to center
					$ratioX = $maxW / $uploadWidth;
					$ratioY = $maxH / $uploadHeight;

					if ($ratioX < $ratioY) { 
						$newX = round(($uploadWidth - ($maxW / $ratioY))/2);
						$newY = 0;
						$uploadWidth = round($maxW / $ratioY);
						$uploadHeight = $uploadHeight;
					} else { 
						$newX = 0;
						$newY = round(($uploadHeight - ($maxH / $ratioX))/2);
						$uploadWidth = $uploadWidth;
						$uploadHeight = round($maxH / $ratioX);
					}
					
					$dstImg = imagecreatetruecolor($maxW, $maxH);
					imagecopyresampled($dstImg, $srcImg, 0, 0, $newX, $newY, $maxW, $maxH, $uploadWidth, $uploadHeight);
	
			// -- try to write
					$write = imagejpeg($dstImg, $file['filename'], 75); //quality = 75
			
			// -- clean up
			imagedestroy($dstImg);
			
			if ($write) {
				return basename($file['filename']);
			} else {
				//$this->error("Could not write " . $file['filename'] . " to " . $destination);
				//pr('error');
				return (-1);
			}

	}
	





}

?>