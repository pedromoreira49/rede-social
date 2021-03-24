<?php
	
	namespace ClassesMVC\Controllers;

	class HomeController{


		public function index(){

			if(isset($_SESSION['login'])){
				//Renderiza a home do usuário.
				\ClassesMVC\Views\MainView::render('home');
			}else{
				//Renderiza para criar conta.
				\ClassesMVC\Views\MainView::render('registrar');
			}

		}
	}

?>