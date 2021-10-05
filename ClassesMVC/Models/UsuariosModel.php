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
	}
?>