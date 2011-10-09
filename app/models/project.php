<?php

class Project extends AppModel {
    var $name = 'Project';
    var $belongsTo = array(
        'User' => array(
            'className'  => 'User'
      	),
         'ProjectCategory' => array(
            'className'  => 'ProjectCategory'
      	)

    );
    //var $hasMany = 'LineItem';

    var $actsAs = array( 'Sluggable' => array( 'label' => 'title', 
					       'slug' => 'slug' ) );
    
    var $hasMany = array(
        'LineItem' => array(
            'className'  => 'LineItem'
      	),
      	'Collaborator' => array(
            'className'  => 'Collaborator'
      	),
      	'OutsideFundingSource' => array(
            'className'  => 'OutsideFundingSource'
      	),
      	'Donation' => array(
      		'className'	=> 'Donation'
      	),      	
	    'Image'=>array(
			   'className'=>'Image',
			   'foreignKey'=>'foreign_id',
			   'conditions'=>array(
					       'Image.type'=>'project')
      	),
		'Link'=>array(
			   'className'=>'Link',
			   'foreignKey'=>'foreign_id',
			   'conditions'=>array(
					       'Link.type'=>'project')
      	),
		'EmbeddedVideo'=>array(
			   'className'=>'EmbeddedVideo',
			   'foreignKey'=>'foreign_id',
			   'conditions'=>array(
					       'EmbeddedVideo.type'=>'project')
      	),
		'Document'=>array(
			   'className'=>'Document',
			   'foreignKey'=>'foreign_id',
			   'conditions'=>array(
					       'Document.type'=>'project_doc')
      	)      	
      	
      	      	
    );
    
      var $validate = array(
  					  'title' => array(
						  'alphaNumeric' => array(
									  'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
									  'required' => true,
									  'message' => EUREKA_ERROR_ALPHA_EN
									  ),
						  'between' => array(
								     'rule' => array('between', 2, 50),
								     'message' => EUREKA_ERROR_PROJECT_TITLE_BETWEEN_EN
								     )
						  ),
					  'abstract' => array(
						  'notEmpty' => array(
									  'rule' => 'notEmpty',
									  'required' => true,
									  'message' => EUREKA_ERROR_EMPTY_EN
									  )
					  ),
					  'background' => array(
						  'notEmpty' => array(
									  'rule' => 'notEmpty',
									  'required' => true,
									  'message' => EUREKA_ERROR_EMPTY_EN
									  )
					  ),
					'homepage' => array(
						  'URL' => array(
						  		  'rule' => 'URL',
						  		  'required' => false,
						  		  'allowEmpty' => true,
								  'message' => EUREKA_ERROR_URL_VALID_EN 						  
						  		  )
					 )
		);
		

/**
 * Overridden paginate method
 */
function paginateAnswer($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {

	$projects = array();
	$projectIds = array();
		
	$fields=null;		
	
	//grab searchstr	
	if (!empty($conditions['searchstr'])) {
		$searchstr = $conditions['searchstr'];
		
		//now rebuild conditions
		$approved = array('Project.status' => 'APPROVED');
		
		
		//FIND BY TITLE -- EXACT
		$conditions = array_merge($approved, array('Project.title LIKE' => $searchstr));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
	
		//FIND BY TITLE -- BEGINS WITH
		$conditions = array_merge($approved, array('Project.title LIKE' => $searchstr.'%'));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
	
		//FIND BY TITLE -- MATCH
		$conditions = array_merge($approved, array('Project.title LIKE' => '%'.$searchstr.'%'));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
		
		//FIND BY ABSTRACT
		$conditions = array_merge($approved, array('Project.abstract LIKE' => '%'.$searchstr.'%'));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
		
		//FIND BY USER FNAME
		$conditions = array_merge($approved, array('User.fname LIKE' => '%'.$searchstr.'%'));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
		
		//FIND BY USER LNAME
		$conditions = array_merge($approved, array('User.lname LIKE' => '%'.$searchstr.'%'));
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
		
		//FIND BY PROJECT BACKGROUND
		$conditions = array_merge($approved, array('Project.background LIKE' => '%'.$searchstr.'%'));
		pr($conditions);
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
	
		foreach($found as $project) {
			if (!in_array($project['Project']['id'], $projectIds)) {
				$projectIds[] = $project['Project']['id'];
				$projects[] = $project;
			}
		}
	} else {
		//USE SUPPLIED CONDITIONS
		$found = $this->find('all', compact('conditions', 'fields', 'order'));
		$projects = $found;
		//pr($projects);
		
	}
	
	
	return $projects;
}


function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {

	$result = $this->paginateAnswer($conditions, $fields, $order, $limit, $page, $recursive, $extra);
	
	$offset = ($page-1)*$limit;

	return array_slice($result, $offset, $limit);
}


/**
 * Overridden paginateCount method
 */
function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
	return count($this->paginateAnswer($conditions, $recursive, null, null));
}


  function afterFind( $results ) {
    if ( is_array( $results ) && ! isset( $results[ 'id' ] ) ) {
      // we found more than one project
      foreach ( $results as &$result ) {
	if ( isset( $result[ 'Image' ] ) ) { $this->_sortImages( $result['Image'] ); }
	if ( isset( $result[ 'LineItem' ] ) ) { $this->_groupAndTotalLineItemsAndDonations( $result ); }
      }
    } else {
      // we found just one project
      if ( isset( $results[ 'Image' ] ) ) { $this->_sortImages( $results['Image'] ); }
      if ( isset( $results[ 'LineItem' ] ) ) { $this->_groupAndTotalLineItemsAndDonations( $results ); }
    }

    return $results;
  }

  function _sortImages( &$image_array ) {
	usort($image_array, array( $this , '_orderCmp') ); 
  }

  function _groupAndTotalLineItemsAndDonations( &$project ) {
    $lineItemCategories = array();
    $goal = 0;
    foreach ($project['LineItem'] as $lineItem) {
      if ( isset( $lineItem['LineItemCategory'] ) ) {
	if (!in_array($lineItem['LineItemCategory']['title'], $lineItemCategories)) {
	  $lineItemCategories[$lineItem['LineItemCategory']['title']] = $lineItem['amount'];
	} else {
	  $lineItemCategories[$lineItem['LineItemCategory']['title']] += $lineItem['amount'];
	}
      }
      $goal += $lineItem['amount'];
    } 

    $donations_total = 0;
    if ( isset( $project['Donation'] ) ) {
      foreach ( $project['Donation'] as $donation ) {
	$donations_total += $donation['project_donation_amt'];
      }
    }

    $project['goal']['by_line_item'] = $lineItemCategories;
    $project['goal']['total'] = $goal;
    $project['goal']['raised'] = $donations_total;

    $ratio = ( $goal != 0 ) ? min($donations_total/$goal, 1) : 0;
    $thermoFill = (1-$ratio)*136;
    $thermoMove = 56+136-$thermoFill;

    $project['goal']['ratio'] = $ratio;
    $project['goal']['thermoFill'] = $thermoFill;
    $project['goal']['thermoMove'] = $thermoMove;
  }

  /* used for comparing order of images */
  function _orderCmp($im1, $im2)
  {
    $a = $im1['order'];
    $b = $im2['order'];
    if ($a == $b) {
      return 0;
    }
    return ($a < $b) ? -1 : 1;
  }




}

?>
