<?php
	global $endereco_site;

	class projetos_Controller extends Reuse_ACK_Controller_ProductController
	{
		/**
		 * modulo do controlador no sistema
		 */
		const MODULE = 8;
		/**
		 * modulo de categorias
		 */
		const CATEGORY_MODULE = 19;
		/**
		 * tamanho dos textos pequenos
		 */
		const MINOR_LENGHT = 443;

		/**
		 * @param  [type] $params [description]
		 * @return [type]         [description]
		 */
		public function index($params)
		{
			/**
			 * define o que será o elemento buscado
			 * @var [type]
			 */
			$key = (!empty($params['projeto'])) ? $params['projeto'] : $params["categoria"];
			$keyProject = ($params["projeto"]) ? $params["projeto"] : null;
			$keyCategory  = ($params["categoria"]) ? $params["categoria"] : null;

			$newResult = array('menu'=>array(),"itens" =>array());

			//efetua a busca
			if($params["search"]) {

				$helper = new Helper_Projetos_Busca;
				return $helper->run($this,$params);



			} else if(!empty($params['projeto'])  && !empty($params["categoria"])) {

				$helper = new Helper_Projetos_Projeto;
				return $helper->run($this,$params);

			} else if(empty($params['projeto']) && empty($params["categoria"])) {
				/**
				 * primeiro a ser chamado
				 * @var Helper_Projetos_Categorias
				 */
				$helper = new Helper_Projetos_Categorias;
				return $helper->run($this,$params);
			}

			// } else if(empty($params['projeto'])  && !empty($params["categoria"])){


			// }

			return $newResult;
		}
	}
