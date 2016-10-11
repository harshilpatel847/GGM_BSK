<?php
 
require( "config/config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}
 
switch ( $action ) {
	case 'roster':
		roster();
		break;
	case 'login':
		login();
		break;
	case 'logout':
		logout();
		break;
	case 'newRegistrant':
		newRegistrant();
		break;
	case 'editRegistrant':
		editRegistrant();
		break;
	case 'deleteRegistrant':
		deleteRegistrant();
		break;
	case 'listRegistrants':
		listRegistrants();
		break;
	case 'customList':
		customList();
		break;	
	default:
		adminMain();
}

 
function login() {
  $results = array();
  $results['pageTitle'] = "Administration Login";
  if ( isset( $_POST['login'] ) ) {
    // User has posted the login form: attempt to log the user in
    if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );
    } else {
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }
  } else {
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
}
 
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: index.php" );
}
 
 
function newRegistrant() {
  $results = array();
  $results['pageTitle'] = "New Registration Form";
  $results['formAction'] = "newRegistrant";
  if ( isset( $_POST['saveChanges'] ) ) {
    // User has posted the registrant edit form: save the new registrant
    $registrants = new Registrants;
    $registrants->storeFormValues( $_POST );
    $registrants->insert();
    header( "Location: admin.php?status=changesSaved" );
  } elseif ( isset( $_POST['cancel'] ) ) {
    // User has cancelled their edits: return to the Registrant list
    header( "Location: admin.php" );
  } else {
    // User has not posted the registrant edit form yet: display the form
    $results['registrants'] = new Registrants;
    require( TEMPLATE_PATH . "/admin/editRegistrant.php" );
  }
}
 
 
function checkDBRow() {
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$currLevel = $conn->lastInsertId();
	return $currLevel;
}

function editRegistrant() {
  $results = array();
  $team_data = Teams::getAllTeams();
  $results['scores'] = $team_data['team_results'];	
  $results['formAction'] = "editRegistrant";
  if ( isset( $_POST['saveChanges'] ) ) {
    // User has posted the registrant edit form: save the registrant changes
    if ( !$registrants = Registrants::getById( (int)$_POST['registrantId'] ) ) {
      header( "Location: admin.php?error=registrantNotFound" );
      return;
    }
    $registrants->storeFormValues( $_POST );
    $registrants->update();
    header( "Location: admin.php?status=changesSaved" );
  } elseif ( isset( $_POST['cancel'] ) ) {
    // User has cancelled their edits: return to the registrant list
    header( "Location: admin.php" );
  } else {
    // User has not posted the article edit form yet: display the form
    $results['registrants'] = Registrants::getById( (int)$_GET['registrantId'] );
  	$results['pageTitle'] = "Administration for " . $results['registrants']->f_name . " " . $results['registrants']->l_name;	  
    require( TEMPLATE_PATH . "/admin/editRegistrant.php" );
  }
}

function roster() {
    $results = array();
	$team_data = Teams::getAllTeams();
	$results['scores'] = $team_data['team_results'];
	$data = Registrants::getList("*", "reg_type='s' AND enrollment_status='1' AND age_group = '" . $_GET['ageGroup'] . "'", "f_name ASC");
    $results['registrants'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Roster for Group " . $_GET['ageGroup'];
    $results['classDay'] = "Sunday";
	$results['formAction'] = "roster";
	if ( isset( $_POST['takeAttendance'] ) ) {
		$attendance = new Attendance;
		$attendance->insert( $_POST['attendance'] );
		header( "Location: admin.php?status=attendanceTaken" );
	}elseif ( isset( $_POST['checkinHomework'] ) ) {
		$homework = new Homework;
		$homework->insert( $_POST['homework'] );
		header( "Location: admin.php?status=homeworkTaken" );
	}elseif ( isset( $_POST['points'] ) ) {
		$team = new Teams;
		$team->points( $_POST['points'] );
		header( "Location: admin.php?action=roster&ageGroup=" . $_POST['points'][ageGroup] );
	}else {
		$results['attendance'] = new Attendance;
	    require( TEMPLATE_PATH . "/admin/roster.php" );
	}
}
 
function listRegistrants() {
  $results = array();
  $data = Registrants::getList( "*", "id>'0'", ( $_GET['ordering'] ?: "id") . " ASC" );
  $results['registrants'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Registration List - Main (" . $results['totalRows'] . " registrant" . ( $results['totalRows'] != 1  ? 's' : '') . ")";
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "registrantsNotFound" ) $results['errorMessage'] = "Error: Registrant not found.";
  }
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "registrantDeleted" ) $results['statusMessage'] = "Registration deleted.";
  }
  require( TEMPLATE_PATH . "/admin/listRegistrants.php" );
}

function customList() {
  $results = array();
  $data = Registrants::getList( "*", "enrollment_status = 1", ( $_GET['ordering'] ?: "id") . " ASC" );  	  
  $results['registrants'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Active Registrations (" . $results['totalRows'] . " row" . ( $results['totalRows'] != 1  ? 's' : '') . ")";
  require( TEMPLATE_PATH . "/admin/customList.php" );
}

function adminMain() {
	$team_data = Teams::getAllTeams();
	$results['scores'] = $team_data['team_results'];
	$results['pageTitle'] = "Administration Home";
	if ( isset( $_GET['error'] ) ) {
		if ( $_GET['error'] == "registrantsNotFound" ) $results['errorMessage'] = "Error: Registrant not found.";
	}
	if ( isset( $_GET['status'] ) ) {
		if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
		if ( $_GET['status'] == "registrantDeleted" ) $results['statusMessage'] = "Registration deleted.";
		if ( $_GET['status'] == "attendanceTaken" ) $results['statusMessage'] = "Attendance has been submitted.";
		if ( $_GET['status'] == "homeworkTaken" ) $results['statusMessage'] = "Homework score has been submitted.";	  
	}
	require( TEMPLATE_PATH . "/admin/adminMain.php" );
}

function deleteRegistrant() {
  if ( !$registrants = Registrants::getById( (int)$_GET['registrantId'] ) ) {
    header( "Location: admin.php?error=registrantNotFound" );
    return;
  }
  $registrants->delete();
  header( "Location: admin.php?status=registrantDeleted" );
} 

?>