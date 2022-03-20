<?php
	
	namespace ClassesMVC\Controllers;
	
	class RegistrarController{

		public function index(){

			if(isset($_POST['registrar'])){
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];

				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					\ClassesMVC\Utilidades::alerta('E-mail Inválido.');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(strlen($senha) < 6){
					\ClassesMVC\Utilidades::alerta('Sua senha é muito curta.');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else if(\ClassesMVC\Models\UsuariosModel::emailExists($email)){
					\ClassesMVC\Utilidades::alerta('Este E-mail já está sendo usado.');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'registrar');
				}else{
					$senha = \ClassesMVC\Bcrypt::hash($senha);
					$registro = \ClassesMVC\Mysql::connect()->prepare("INSERT INTO usuarios VALUES (null, ?, ?, ?, null)");
					$registro->execute(array($nome, $email, $senha));

					\ClassesMVC\Utilidades::alerta('Registrado com sucesso.');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
				}
			}

			\ClassesMVC\Views\MainView::render('registrar');
		}
	}

?>