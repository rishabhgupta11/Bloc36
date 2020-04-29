<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once '../vendor_google/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('300163088462-dlck6e0r99as8opq5f0n9bi2snn1omvd.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('xM8Wy2PXYmUCmQGV1IGkuHxM');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/BLOC36/includes/google_signin.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
    if(!isset($_SESSION)) 
    { 
        session_start();
    }

?>