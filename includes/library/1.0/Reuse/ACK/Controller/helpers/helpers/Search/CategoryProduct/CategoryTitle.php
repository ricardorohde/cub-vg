<?php
	/**
	 * procura por categoria
	 */
	class Reuse_ACK_Controller_helpers_Search_CategoryProduct_CategoryTitle extends System_Search_Searchable_Abstract
	{
		/**
		 * modulo do controlador no sistema
		 */
		const MODULE = 8;
		/**
		 * modulo de categorias de produtos
		 */
		const CATEGORY_MODULE = 19;
		

		public function getValues(str $key) 
		{

			$key = strtolower($key);

			$where=null;
			if(!empty($key)) {
				$where = array('LOWER(titulo_'.System_Language::current().') LIKE ' => '%'.$key.'%');
				$where["visivel"] = 1;
				$where["status"] = 1;
			}

			dg($where);

			$category = new Reuse_ACK_Model_Category;
			$resultCategory = $category->getProductChild($where,array('module'=>self::MODULE,'categoryModule'=>self::CATEGORY_MODULE),null);

			$result = array();
			foreach($resultCategory as $elementId => $element) {
				$result[$element['id']] = $element;
			}


			return $result;		
		}	
	}
?>