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

				if(isset($_GET['recusarAmizade'])){
					$idEnviou = (int) $_GET['recusarAmizade'];
					\ClassesMVC\Models\UsuariosModel::updateFriendRequest($idEnviou,0);
					\ClassesMVC\Utilidades::alerta('Amizade recusada! :(');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
				}else if(isset($_GET['aceitarAmizade'])){
					$idEnviou = (int) $_GET['aceitarAmizade'];
					if(\ClassesMVC\Models\UsuariosModel::updateFriendRequest($idEnviou,1)){
						\ClassesMVC\Utilidades::alerta('Amizade aceita! :D');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
					} else{
						\ClassesMVC\Utilidades::alerta('Um erro ocorreu!');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
					}
				}

				if(isset($_POST['post_feed'])){

					if($_POST['postBody'] == ''){
						\ClassesMVC\Utilidades::alerta('Você não pode fazer um post vazio :(');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
					}
					\ClassesMVC\Models\HomeModel::postFeed($_POST['postBody']);
					\ClassesMVC\Utilidades::alerta('Post feito com sucesso! :D');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
				}

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
							$_SESSION['id'] = $dados['id'];
							$_SESSION['nome'] = explode(' ', $dados['nome'])[0];
							$_SESSION['img'] = $dados['img'];
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