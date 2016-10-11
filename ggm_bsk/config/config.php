<?php
ini_set( "display_errors", true );
date_default_timezone_set( "America/Chicago" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=harshilp_ggm_bsk" );
define( "DB_USERNAME", "harshilp_ggm" );
define( "DB_PASSWORD", "gayatri@#$234" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_REGISTRANTS", 10 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "mypass" );
require( CLASS_PATH . "/registrants.php" );
require( CLASS_PATH . "/attendance.php" );
require( CLASS_PATH . "/homework.php" );
require( CLASS_PATH . "/teams.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please contact ggmbsk@gmail.com for assistance";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>