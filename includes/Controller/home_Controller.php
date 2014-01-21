<?php

	class home_Controller extends System_Controller
	{
		const CONTROLLER_PREFIX = "includes/Controller/";
		public function index ()
		{
			loadView('front/home/index',$data);
		}

		public function ajax()
		{
		/**
		 * CONVERSAO E NOMES PARA A NOVA VERSAO
		 */
			/**
			 * a parte de contato vem como acao
			 */
			$this->ajax["modulo"] = $this->ajax["sessao"];
			if($this->ajax["modulo"] == "busca") {
				$this->ajax["modulo"] = "projetos";
				$this->ajax["search"] = true;
			}

			if($this->ajax["acao"] == "enviaContato")
				$this->ajax["modulo"] = "contato";


		/**
		 * FIM DA CONVERSAO
		 */

			$front = $this->_frontController= System_FrontController::getInstance();

			$className = $this->ajax['modulo'].'_Controller';


			// System_Autoloader::setVersion("1.5");

			// if(sstream_resolve_include_path(self::CONTROLLER_PREFIX.$className))
			// {
			// 	dg("existe");
			// }


			// System_Autoloader::setVersion("default");


			$controller = new $className;

			unset($this->ajax['modulo']);
			/**
			 * carrega o controlador
			 */
			$params = array_merge($this->ajax,$front->getUrlParameters());


			$result = $controller->load($controller,'index',$params);

			echo json_encode($result);
			die;
		}

		public function preDispatch()
		{
			/**
			 * desabilita o plugin de numeros de acesso para o home ja qe
			 * o mesmo serve somente para carregar outras classes
			 */
			$this->_accessNumber->disable();
		}
	}