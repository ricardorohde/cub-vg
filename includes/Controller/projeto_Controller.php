<?php

	global $endereco_site;

	class projeto_Controller extends Reuse_ACK_Controller_ProductController
	{
		/**
		 * @param  [type] $params [description]
		 * @return [type]         [description]
		 */
		public function index($params)
		{
			$helper = new Helper_Projetos_Projeto;
			return $helper->run($this,$params);
		}
	}