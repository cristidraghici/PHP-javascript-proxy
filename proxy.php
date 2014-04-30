<?php
/*
 Init the script
*/
require_once( 'http.class.php' );
require_once( 'proxy.class.php' );

/*
 Run the script
*/
$proxy = new proxy();
$proxy->init();
?>