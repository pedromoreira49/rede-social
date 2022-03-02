<?php
	
	namespace ClassesMVC\Controllers;

	class ComunidadeController{

		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\ClassesMVC\Models\UsuariosModel::solicitarAmizade($idPara)){
						\ClassesMVC\Utilidades::alerta('Amizade solicitada com sucesso!');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}else{
						\ClassesMVC\Utilidades::alerta('Ocorreu um erro ao solicitar a amizade...');
						\ClassesMVC\Utilidades::redirect(INCLUDE_PATH.'comunidade');
					}
				}

				\ClassesMVC\Views\MainView::render('comunidade');
			}else{
				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}

?>