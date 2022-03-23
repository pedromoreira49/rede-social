<?php
	
	namespace ClassesMVC\Controllers;

	class ProfileController{

		public function index(){
			if(isset($_SESSION['login'])){

				\ClassesMVC\Views\MainView::render('profile');
			}else{
				\ClassesMVC\Utilidades::redirect(INCLUDE_PATH);
			}
		}
	}

?>