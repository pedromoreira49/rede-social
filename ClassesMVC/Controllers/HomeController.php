<?php
	
	namespace ClassesMVC\Controllers;

	class HomeController{


		public function index(){

			if(isset($_GET['loggout'])){
				session_unset();
				session_destroy();

				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);	
			}

			if(isset($_SESSION['login'])){
				//Renderiza a home do usuário.
				\ClassesMVC\Views\MainView::render('home');
			}else{
				//Renderiza para criar conta.

				if(isset($_POST['login'])){
					$login = $_POST['email'];
					$senha = $_POST['senha'];

					$verifica = \ClassesMVC\Mysql::connect()->prepare("SELECT * FROM usuarios WHERE email = ?");
					$verifica->execute(array($login));

					if($verifica->rowCount() == 0){

						\ClassesMVC\Utilidades::alerta('Não existe nenhum usuário com este e-mail...');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
					}else{
						$dados = $verifica->fetch();
						$password = $dados['senha'];
						if(\ClassesMVC\Bcrypt::check($senha, $password)){
							$_SESSION['login'] = $dados['email'];
							$_SESSION['nome'] = explode(' ', $dados['nome'])[0];
							\ClassesMVC\Utilidades::alerta('Logado com sucesso!');
							\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);	
						}else{
							\ClassesMVC\Utilidades::alerta('Senha incorreta...');
							\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);						}
					}
				}

				\ClassesMVC\Views\MainView::render('login');
			}

		}
	}

?>