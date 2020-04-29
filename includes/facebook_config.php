<?php

require_once '../vendor_facebook/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '849451008895702',
  'app_secret'     => '4f23281aaf01eaaf70626fa29e9cea7d',
  'default_graph_version'  => 'v2.10'
]);

?>