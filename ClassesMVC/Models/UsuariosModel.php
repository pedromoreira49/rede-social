<?php

	namespace ClassesMVC\Models;

	class UsuariosModel {

		public static function emailExists($email){
			$pdo = \ClassesMVC\Mysql::connect();
			$verificar = $pdo->prepare("SELECT email FROM usuarios WHERE email = ?");
			$verificar->execute(array($email));

			if($verificar->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}

		public static function listarComunidade(){
			$pdo = \ClassesMVC\Mysql::connect();

			$comunidade = $pdo->prepare("SELECT * FROM usuarios");

			$comunidade->execute();

			return $comunidade->fetchAll();
		}

		public static function solicitarAmizade($idPara){
			$pdo = \ClassesMVC\Mysql::connect();

			$verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

			$verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

			if($verificaAmizade->rowCount() == 1){
				return false;
			}else{
				$insertion = $pdo->prepare("INSERT INTO amizades VALUES (null,?,?,0)");
				if($insertion->execute(array($_SESSION['id'],$idPara))){
					return true;
				}
			}

			return true;
		}

		public static function requestsPendentes(){

			$pdo = \ClassesMVC\Mysql::connect();

			$pendentes = $pdo->prepare("SELECT * FROM amizades WHERE recebeu = ? AND status = 0");

			$pendentes->execute(array($_SESSION['id']));

			return $pendentes->fetchAll();
		}

		public static function getUsersById($id){
			$pdo = \ClassesMVC\Mysql::connect();
			$users = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
			$users->execute(array($id));
			return $users->fetch();
		}

		public static function exiteFriendRequest($idPara){
			$pdo = \ClassesMVC\Mysql::connect();

			$verificaAmizade = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ?) OR (enviou = ? AND recebeu = ?)");

			$verificaAmizade->execute(array($_SESSION['id'],$idPara,$idPara,$_SESSION['id']));

			if($verificaAmizade->rowCount() == 1){
				return false;
			}else{
				return true;
			}
		}

		public static function updateFriendRequest($send, $status){
			$pdo = \ClassesMVC\Mysql::connect();

			if($status == 0){
				$del = $pdo->prepare("DELETE FROM amizades WHERE enviou = ? AND recebeu = ? AND status = 0");
				$del->execute(array($send,$_SESSION['id']));
			}else if($status == 1){
				$accept = $pdo->prepare("UPDATE amizades SET status = 1 WHERE enviou = ? AND recebeu = ?");
				$accept->execute(array($send,$_SESSION['id']));

				if($accept->rowCount() == 1){
					return true;
				}else{
					return false;
				}

			}
		}

		public static function listarAmigos(){
			$pdo = \ClassesMVC\Mysql::connect();

			$amizades = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND status = 1) OR (recebeu = ? AND status = 1)");

			$amizades->execute(array($_SESSION['id'], $_SESSION['id']));
			$amizades = $amizades->fetchAll();
			$amigosConfirmados = array();

			foreach($amizades as $key => $value){
				if($value['enviou'] == $_SESSION['id']){
					$amigosConfirmados[] = $value['recebeu'];
				}else{
					$amigosConfirmados[] = $value['enviou'];
				}
			}

			$listaAmigos = array();

			foreach($amigosConfirmados as $key => $value){
				$listaAmigos[$key]['nome'] = self::getUsersById($value)['nome'];
				$listaAmigos[$key]['email'] = self::getUsersById($value)['email'];
				$listaAmigos[$key]['img'] = self::getUsersById($value)['img'];
			}

			return $listaAmigos;

		}
	}
?>