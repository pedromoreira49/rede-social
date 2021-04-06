<?php
	
	namespace ClassesMVC\Controllers;

	class ComunidadeController{

		public function index(){
			if(isset($_SESSION['login'])){
				\ClassesMVC\Views\MainView::render('comunidade');
			}else{
				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}

?>