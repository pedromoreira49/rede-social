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
	}
?>