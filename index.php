<?php
	session_start();
	require('vendor/autoload.php');
	$app = new ClassesMVC\Application();

	$app->run();

?>