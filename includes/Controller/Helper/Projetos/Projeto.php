<?php
	class Helper_Projetos_Projeto
	{
		protected $class;

		public function run(projetos_Controller $class, $params)
		{

			$key = (!empty($params['projeto'])) ? $params['projeto'] : $params["categoria"];
			$keyProject = ($params["projeto"]) ? $params["projeto"] : null;
			$keyCategory  = ($params["categoria"]) ? $params["categoria"] : null;

			/**
			 * entra em um projeto
			 */
				$category = new Reuse_ACK_Model_Category;
				$result = $category->getProductChild(null,
													array('module'=>projetos_Controller::MODULE,
														'categoryModule'=>projetos_Controller::CATEGORY_MODULE,
														'whereProduct'=>array('id' => $keyProject))
													,null);


				if(!empty($result)) {
					foreach($result as $elementId => $element) {

						if($element["id"] == $keyCategory) {
								$result =($result[$elementId]);
						}
					}
				}

				$result = reset($result);

				global $endereco_site;

				foreach($result["product"]  as $product) {

					$imagens = array();
					$videos = array();

					foreach($product["image"] as $image) {
						$imagens[] = array(
											"foto"=>clearformThumbImage($image["arquivo"],$image["id"],"&w=944&h=580",80,"666666"),
											"thumb"=>formThumbImage($image["arquivo"],$image["id"],"&w=140&h=86"),
											"legenda"=>$image["titulo_pt"]
										 );
					}

					System_Autoloader::setVersion("1.5");

					foreach($product["video"] as $video) {
						$videos[] = array("video"=> ($video["tipo"] == 1) ? "http://www.youtube.com/v/".System_Object_Video::getIdentificator($video["arquivo"]) : $video["arquivo"],
										  "thumb" => ($video["tipo"] == 1)  ? youtubeThumb($video["arquivo"]) : vimeoThumb($video["arquivo"]),
										"legenda"=>$video["titulo_pt"]);
					}
					System_Autoloader::setVersion("default");

					$newResult["item"]  = array(
									'id'=>$product["id"],
									'titulo'=>$product["titulo_pt"],
									'texto_menor'=>substr($product["descricao_pt"], 0, projetos_Controller::MINOR_LENGHT),
									'texto'=>$product["descricao_pt"],
									'furl'=> formaUrl($product["titulo_pt"]),
									"categoria"=>array(
														'id'=>$result["id"],
														'titulo'=>$result["titulo_pt"],
														'furl'=>formaUrl($result["titulo_pt"])
														),
									'fotos'=>$imagens,
									'videos'=>$videos,
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