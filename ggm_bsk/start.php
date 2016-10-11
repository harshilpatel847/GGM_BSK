<?php

require( "config/config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

include( "templates/include/header.php");

?>

<div id="start">

<?php 

switch ( $action ) {
  case 'begin':
    begin();
    break;
  default:
    homepage();

?> </div>

<?php 

include( "templates/include/footer.php");

session_start();
$full_name = isset( $_SESSION['registrant_name'] ) ? $_SESSION['registrant_name'] : "";
$birthday = isset( $_SESSION['registrant_birthday'] ) ? $_SESSION['registrant_birthday'] : "";

function begin() {
	echo $fullname . $birthday;
	$something = array();
	$something['entry'] = Registrants::start_registration();
	
	if ($full_name . $birthday == $something['entry']->full_name_start){
		echo "success!"
	}
	
	
}

?>