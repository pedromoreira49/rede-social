<?php
	
	namespace ClassesMVC;
	class Application
	{
		private $controller;

		private function setApp(){

			$loadName = 'ClassesMVC\Controllers\\';
			$url = explode('/', @$_GET['url']);

			if($url[0] == ''){
				$loadName.='Home';
			}else{
				$loadName.=ucfirst(strtolower($url[0]));
			}

			$loadName.='Controller';

			if(file_exists($loadName.'.php')){
				$this->controller = new $loadName();
			}else{
				include('views/pages/404.php');
				die();
			}

			$this->controller = new $loadName();

		}

		public function run(){
			$this->setApp();
			$this->controller->index();
		}
		
	}

?>