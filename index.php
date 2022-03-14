<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('vendor/autoload.php');

	define('INCLUDE_PATH_STATIC', 'http://localhost/redeSocial/ClassesMVC/Views/pages/');
	define('INCLUDE_PATH', 'http://localhost/redeSocial/');

	$app = new ClassesMVC\Application();

	$app->run();

?>