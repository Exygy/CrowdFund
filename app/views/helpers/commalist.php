<?
class CommalistHelper extends AppHelper {
  var $helpers = array('Html');
  function makelist( $arr, $options ) {
    $title = 'title';
    $link = false;
    foreach( array( 'title', 'link' ) as $option ) {
      if ( isset( $options[ $option ] ) ) { 
	eval( '$' . $option . ' = $options[ $option ];' ); 
      }
    }
    $n = count( $arr );
    $ans = '';
    $i = 0;
    foreach( $arr as $a ) {
      $i++;
      if ( $link ) {
	$ans .= $this->Html->link( $a[$title], $a[$link] );
      } else {
	$ans .= $a[$title];
      }
      if ( $i < $n ) { $ans .= ', '; }
    }
    return $ans;
  }
}
?>