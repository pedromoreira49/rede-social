<?php

	namespace ClassesMVC\Models;

	class HomeModel{

		public static function postFeed($post){
			$pdo = \ClassesMVC\Mysql::connect();
			$post = strip_tags($post);

			if(preg_match('/\[imagem/', $post)){
				$post = preg_replace('/(.*?)\[imagem=(.*?)\]/', '<p>$1</p><img src="$2" />', $post);
			}else{
				$post = '<p>'.$post.'</p>';
			}

			$postFeed = $pdo->prepare("INSERT INTO `posts` (usuario_id, post, date) VALUES (?, ?, ?);");
			$postFeed->execute(array($_SESSION['id'],$post,date('Y-m-d H:i:s',time())));

			$atualizaUsuario = $pdo->prepare("UPDATE usuarios SET ultimo_post = ? WHERE id = ?");
			$atualizaUsuario->execute(array(date('Y-m-d H:i:s', time()),$_SESSION['id']));
		}

		public static function retrieveFriendsPosts(){
			$pdo = \ClassesMVC\MySql::connect();
			$amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");

			$amizades->execute(array($_SESSION['id'],$_SESSION['id']));

			$amizades = $amizades->fetchAll();

			$amigosConfirmados = array();

			foreach ($amizades as $key => $value) {

				if($value['enviou'] == $_SESSION['id']){

					$amigosConfirmados[] = $value['recebeu'];

				}else{

					$amigosConfirmados[] = $value['enviou'];

				}

			}
			$listaAmigos = array();
			foreach ($amigosConfirmados as $key => $value) {

				$listaAmigos[$key]['id'] = \ClassesMVC\Models\UsuariosModel::getUsersById($value)['id'];

				$listaAmigos[$key]['nome'] = \ClassesMVC\Models\UsuariosModel::getUsersById($value)['nome'];

				$listaAmigos[$key]['email'] = \ClassesMVC\Models\UsuariosModel::getUsersById($value)['email'];

				$listaAmigos[$key]['img'] = \ClassesMVC\Models\UsuariosModel::getUsersById($value)['img'];

				$listaAmigos[$key]['ultimo_post'] = \ClassesMVC\Models\UsuariosModel::getUsersById($value)['ultimo_post'];
			}
			$posts = array();
			foreach ($listaAmigos as $key => $value) {
				$lastPost = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = ? ORDER BY date DESC");
				$lastPost->execute(array($value['id']));
				if($lastPost->rowCount() >= 1){

					$lastPost = $lastPost->fetch();
				
					$posts[$key]['usuario'] = $value['nome'];

					$posts[$key]['img'] = $value['img'];

					$posts[$key]['data'] = $lastPost['date'];

					$posts[$key]['conteudo'] = $lastPost['post'];
					
				}
				
				
			}

			$me = $pdo->prepare("SELECT * FROM usuarios WHERE id = $_SESSION[id]");
			$me->execute();
			$me = $me->fetch();
			if(isset($posts[0])){
				if(strtotime($me['ultimo_post']) > strtotime($posts[0]['data'])  ){

					$lastPost = $pdo->prepare("SELECT * FROM posts WHERE usuario_id = $_SESSION[id] ORDER BY date DESC");

					$lastPost->execute();

					$lastPost = $lastPost->fetchAll()[0];

					array_unshift($posts, array('data'=>$lastPost['date'],'conteudo'=>$lastPost['post'],'me'=>true  ));

				}
			}
			return $posts;
		}

	}

?>