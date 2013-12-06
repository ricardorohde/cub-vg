<?php
	class Helper_Projetos_Categorias
	{
		protected $class;
		public function run(projetos_Controller $class,$params)
		{
			$key = (!empty($params['projeto'])) ? $params['projeto'] : $params["categoria"];
			$keyProject = ($params["projeto"]) ? $params["projeto"] : null;
			$keyCategory  = ($params["categoria"]) ? $params["categoria"] : null;

			/**
			 * lista as categorias
			 * @var Reuse_ACK_Controller_helpers_Search_CategoryProduct
			 */
				$category = new Reuse_ACK_Model_Category;
				$where = array();
				$where["visivel"] = '1';
				$where["status"] = '1';

				$result = $category->getProductChild($where,
													array('module'=>projetos_Controller::MODULE,
														'categoryModule'=>projetos_Controller::CATEGORY_MODULE,
														"order"=>"titulo_pt ASC"),null);

				foreach($result  as $project) {
					$newResult["menu"][]  = array("id"=>$project["id"],
									"titulo"=>$project["titulo_pt"],
									"furl"=> formaUrl($project["titulo_pt"])."/page/1"
							);

					$image = reset($project["image"]);

					$newResult["categorias"][]  = array(
									'id'=>$project["id"],
									'titulo'=>$project["titulo_pt"],
									'furl'=>formaUrl($project["titulo_pt"]),
									'imagem'=> formThumbImage($image["arquivo"],$image['id'],"&w=295&h=165&zc=0")
									);
				}

			return $newResult;
		}
	}


?>