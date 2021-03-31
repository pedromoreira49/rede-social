<?php
	
	namespace ClassesMVC\Controllers;
	
	class RegistrarController{

		public function index(){

			\ClassesMVC\Views\MainView::render('registrar');
		}
	}

?>