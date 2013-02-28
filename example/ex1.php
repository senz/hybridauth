<?php
$config = dirname(__FILE__)     . "/config.php";

require_once( dirname(__FILE__) . "/../src/Hybridauth/Hybridauth.php" );

\Hybridauth\Hybridauth::registerAutoloader();

try{ 
	$hybridauth = new \Hybridauth\Hybridauth( $config );

	$adapter = $hybridauth->authenticate( "Google" );
	// $adapter = $hybridauth->authenticate( "Twitter" );
	// $adapter = $hybridauth->authenticate( "Facebook" );
	// $adapter = $hybridauth->authenticate( "OpenID", array( "openid_identifier" => "https://open.login.yahooapis.com/openid20/www.yahoo.com/xrds" ) );

	// request user profile 
	$user_profile = $adapter->getApi()->getUserProfile();

/*
	or:
		$user_profile = $hybridauth->getAdapter( "Google" )->getApi()->getUserProfile();
*/

	// user profile
	echo "<pre>" . print_r( $user_profile, true ) . "</pre>";

	echo $adapter->debug();

	// echo "Logging out.."; 
	$adapter->disconnect();
}
catch( \Hybridauth\Exception $e ){
	echo $e->debug();
}