<?php
	
	namespace ClassesMVC\Controllers;

	class ProfileController{

		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_POST['update'])){
					$pdo = \ClassesMVC\Mysql::connect();
					$nome = strip_tags($_POST['nome']);
					$senha = $_POST['senha'];

					if($nome == '' || strlen($nome) < 3){
						\ClassesMVC\Utilidades::alerta('Por favor, insira um nome válido...');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'profile');
					}

					if($senha != ''){
						$senha = \ClassesMVC\Bcrypt::hash($senha);
						$atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE id = ?");
						$atualizar->execute(array($nome, $senha, $_SESSION['id']));
						$_SESSION['nome'] = $nome;
						
					}else{
						$atualizar = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
						$atualizar->execute(array($nome, $_SESSION['id']));
						$_SESSION['nome'] = $nome;
					
					}

					if($_FILES['file']['tmp_name'] != ''){
						$file = $_FILES['file'];
						$fileExt = explode('.',$file['name']);
						$fileExt = $fileExt[count($fileExt) -1];
						if($fileExt == 'png' || $fileExt == 'jpg' || $fileExt == 'jpeg'){
							$size = intval($file['size'] / 1024);
							if($size <= 300){
								$uniqueId = uniqid().'.'.$fileExt;
								$atualizaImagem = $pdo->prepare("UPDATE usuarios SET img = ? WHERE id = ?");
								$atualizaImagem->execute(array($uniqueId, $_SESSION['id']));
								$_SESSION['img'] = $uniqueId;
								move_uploaded_file($file['tmp_name'], 'c:/xampp/htdocs/redeSocial/uploads/'.$uniqueId);
								\ClassesMVC\Utilidades::alerta('Perfil atualizado com sucesso! :D');
								\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'profile');
							}else{
								\ClassesMVC\Utilidades::alerta('Imagem muito grande');
								\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'profile');
							}
						}else{
							\ClassesMVC\Utilidades::alerta('Formato de arquivo não permitido');
							\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'profile');
						}
					}
					\ClassesMVC\Utilidades::alerta('Perfil atualizado com sucesso! :D');
					\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'profile');
				}

				\ClassesMVC\Views\MainView::render('profile');
			}else{
				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}

?>