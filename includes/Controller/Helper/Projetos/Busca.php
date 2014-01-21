<?php

	class Helper_Projetos_Busca
	{
		protected $class;
		public function run(projetos_Controller $class,$params)
		{
			/**
			 * busca projetos
			 * @var Reuse_ACK_Controller_helpers_Search_CategoryProduct
			 */
				$search = new Reuse_ACK_Controller_helpers_Search_CategoryProduct;
				$result = $search->search($params["termo"]);

				$result = reset($result);

				$newResult["projetos"] = array();

				foreach($result["product"] as $product) {

					$image = reset($product["image"]);

					$newResult["projetos"][]  = array(
									'id'=>$product["id"],
									'titulo'=>$product["titulo_pt"],
									'furl'=>formaUrl($product["titulo_pt"]),
									'imagem'=>formThumbImage($image["arquivo"],$image["id"],"&w=295&h=165&zc=0"),
									"categoria"=>array(
														'id'=>$result["id"],
														'titulo'=>$result["titulo_pt"],
														'furl'=>formaUrl($result["titulo_pt"])
														)

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
					$newResult["menu"][] = array(
													"id" => $category["id"],
													"titulo" => $category["titulo_pt"],
													"furl" => formaUrl($category["titulo_pt"])
												);
				}

			return $newResult;
		}
	}


?>