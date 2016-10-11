<?php

require( "config/config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

/* include( "templates/include/header.php"); */

 
switch ( $action ) {
  case 'viewRegistrant':
    viewRegistrant();
    break;
  case 'editRegistrantPublic';
	editRegistrantPublic();
	break;
  case 'newRegistrantPublic';
	newRegistrantPublic();
	break;	
  case 'begin';
	begin();
	break;
  default:
    homepage();
}

/* include( "templates/include/footer.php"); */
 
function viewRegistrant() {
  if ( !isset($_GET["registrantId"]) || !$_GET["registrantId"] ) {
    homepage();
    return;
  }
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "registrationEdited" ) $results['statusMessage'] = "Your registration information has been updated";
    if ( $_GET['status'] == "registrationAdded" ) $results['statusMessage'] = "Thank you for registering!";
  }   
  $results = array();
  $results['registrants'] = Registrants::getById( (int)$_GET["registrantId"] );
  $team_data = Teams::getAllTeams();
  $results['scores'] = $team_data['team_results'];		
  $results['pageTitle'] = $results['registrants']->f_name . " " . $results['registrants']->l_name . "'s registration";
  require( TEMPLATE_PATH . "/viewRegistrant.php" );
}
 
function homepage() {
  $results['pageTitle'] = "Gayatri Gyan Mandir - Bal Sanskar Kendra";
  
  require( TEMPLATE_PATH . "/homepage.php" );
}

function begin() {
	$full_name = isset( $_POST['full_name'] ) ? $_POST['full_name'] : "";
	$birthdate = isset( $_POST['birthdate'] ) ? $_POST['birthdate'] : "";
	$names = explode(" ",$full_name);
		
	$results = array();
	$results['registrants'] = Registrants::startRegistration($names[0], $names[1], $birthdate);
	$results['who'] = $results['registrants']->id;

	if (!isset($results['who']) || !$results['who']) {
		
		$redirect = "index.php?action=newRegistrantPublic&first=" . $names[0] . "&last=" . $names[1] . "&birthdate=" . $birthdate;

		header("Location: ".$redirect);
		return;
	}else {
		$redirect = "index.php?action=viewRegistrant&registrantId=" . $results['who'];
		header("Location: ".$redirect);
	}

}
 
function editRegistrantPublic() {
  $results = array();
  $results['formAction'] = "editRegistrantPublic";
  $team_data = Teams::getAllTeams();
  $results['scores'] = $team_data['team_results'];	  
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the registrant edit form: save the registrant changes
 
    if ( !$registrants = Registrants::getById( (int)$_POST['registrantId'] ) ) {
      header( "Location: index.php?error=registrantNotFound" );
      return;
    }
 
    $registrants->storeFormValues( $_POST );
    $registrants->update();
	$results['who'] = $_POST['registrantId'];
	$redirect = "action=viewRegistrant&registrantId=" . $results['who'];
	$redirect2 = $redirect . "&status=registrationEdited";
    header( "Location: index.php?".$redirect2 );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to homepage
    header( "Location: index.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['registrants'] = Registrants::getById( (int)$_GET['registrantId'] );
	$results['pageTitle'] = "Edit registration for " . $results['registrants']->f_name . " " . $results['registrants']->l_name;	  
    require( TEMPLATE_PATH . "/editRegistrantPublic.php" );
  }
} 

function newRegistrantPublic() {
 
  $results = array();
  $results['pageTitle'] = "New Registration";
  $results['formAction'] = "newRegistrantPublic";
  
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the registrant edit form: save the new registrant
    $registrants = new Registrants;
    $registrants->storeFormValues( $_POST );
    $registrants->insert();
    header( "Location: index.php?status=registrationAdded" ); 
	  
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the Registrant list
    header( "Location: index.php" );
  } else {
 
    // User has not posted the registrant edit form yet: display the form
    $results['registrants'] = new Registrants;
    require( TEMPLATE_PATH . "/editRegistrantPublic.php" );
  }
 
}

?>