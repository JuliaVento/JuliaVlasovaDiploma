<?php
ini_set( "display_errors", false ); //сделать false!!!
date_default_timezone_set( "Europe/Minsk" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=cms" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "root" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 7 );
define( "HOMEPAGE_NUM_NEWS", 7 ); 

require( CLASS_PATH . "/Article.php" );
require( CLASS_PATH . "/News.php" );




function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}

set_exception_handler( 'handleException' );
?>
