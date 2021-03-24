<?php
	session_start();
	require('vendor/autoload.php');

	define('INCLUDE_PATH_STATIC', 'http://localhost/redeSocial/ClassesMVC/Views/pages/');

	$app = new ClassesMVC\Application();

	$app->run();

?>