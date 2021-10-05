<?php
	
	namespace ClassesMVC\Controllers;

	class ComunidadeController{

		public function index(){
			if(isset($_SESSION['login'])){

				if(isset($_GET['solicitarAmizade'])){
					$idPara = (int) $_GET['solicitarAmizade'];
					if(\ClassesMVC\Models\UsuariosModel::solicitarAmizade($idPara)){
						
					}
				}

				\ClassesMVC\Views\MainView::render('comunidade');
			}else{
				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}

?>