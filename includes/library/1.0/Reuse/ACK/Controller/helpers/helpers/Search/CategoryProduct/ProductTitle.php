<?php
	/**
	 * procura por categoria
	 */
	class Reuse_ACK_Controller_helpers_Search_CategoryProduct_ProductTitle extends System_Search_Searchable_Abstract
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

			$where = array();
			$where["visivel"] = 1;
			$where["status"] = 1;

			$whereProduct = array('LOWER(titulo_'.System_Language::current().') LIKE '=>'%'.$key.'%');


			dg($where);

			$category = new Reuse_ACK_Model_Category;
			$resultCategory = $category->getProductChild($where,
												array('module'=>self::MODULE,
													'categoryModule'=>self::CATEGORY_MODULE,
													'whereProduct'=>$whereProduct)
												,null);


			
			$result = array();
			foreach($resultCategory as $elementId => $element) {
				$result[$element['id']] = $element;
			}	

			return $result;
		}	
	}
?>