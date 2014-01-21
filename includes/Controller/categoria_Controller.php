<?php

	class categoria_Controller extends System_Controller
	{

		public function index ($params)
		{
			$helper = new Helper_Projetos_ProjetosDentroDeCategoria;
			return $helper->run($this,$params);
		}
	}
