<?php

	class Helper_Projetos_ProjetosDentroDeCategoria
	{
		protected $class;
		public function run(projetos_Controller $class,$params)
		{

			$key = (!empty($params['projeto'])) ? $params['projeto'] : $params["categoria"];
			$keyProject = ($params["projeto"]) ? $params["projeto"] : null;
			$keyCategory  = ($params["categoria"]) ? $params["categoria"] : null;

		/**
		 * lista os projetos dentro da categoria
		 * @var Reuse_ACK_Model_Category
		 */
			$category = new Reuse_ACK_Model_Category;

			$where = array("id"=>$key);
			$where["visivel"] = '1';
			$where["status"] = '1';
			$result = $category->getProductChild($where,
													array(
															'module'=>projetos_Controller::MODULE,
															'categoryModule'=>projetos_Controller::CATEGORY_MODULE,
															"order"=>"titulo_pt ASC"
														 ),
													null
													);

			$result = reset($result);

			foreach($result["product"] as $product) {

				$image = reset($product["image"]);

				$newResult["projetos"][]  = array(
								'id'=>$product["id"],
								'titulo'=>$product["titulo_pt"],
								'furl'=>formaUrl($product["titulo_pt"]),
								'imagem'=>formThumbImage($image["arquivo"],$image["id"],"&w=295&h=165&zc=0"),
								"categoria" => array("id"=>$params["categoria"],"titulo"=>$result["titulo_pt"],"furl"=>formaUrl($result["titulo_pt"]))
								);
			}

			/**
			 * pega as categorias
			 * @var [type]
			 */
			$search = new Reuse_ACK_Controller_helpers_Search_CategoryProduct;
			$categorys = $search->search("");
			$newResult["menu"] = array();
			foreach($categorys as $categoryId => $category) {
				$newResult["menu"][] = array("id" => $category["id"],
											"titulo" => $category["titulo_pt"],
											"furl" => formaUrl($category["titulo_pt"]));
			}

			return $newResult;
		}
	}


?>