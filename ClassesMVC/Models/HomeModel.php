<?php

	namespace ClassesMVC\Models;

	class HomeModel{

		public static function postFeed($post){
			$pdo = \ClassesMVC\Mysql::connect();
			$post = strip_tags($post);
			$postFeed = $pdo->prepare("INSERT INTO `posts` (usuario_id, post, date) VALUES (?, ?, ?);");
			$postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

			$atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
			$atualizaUsuario->execute(array(date('Y-m-d H:i:s', time()),$_SESSION['id']));
		}

	}

?>