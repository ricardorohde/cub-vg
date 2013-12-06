
<?php

/**
 * classe em singleton
 */
class RetrieveHighlight implements System_Helper_Interface
{
	const MAX_CATEGORYS_VISIBLE = 3;

	public static function run(array $params)
	{
		if(isset($params['class'])) {

			if($params['class'] == 'product') {

				$className = "Reuse_ACK_Model_".ucfirst(strtolower($params['class']));
				$product = new $className ;
				$result = $product->getChildAndParents(array('destaque'=>1,'visivel'=>'1',"status"=>'1'),array('module'=>8));

				/**
				 * exclui as categorias acima de 3 
				 */
				foreach($result as $highlightId => $highlight) {

					$counter =0;
					foreach($highlight['categorys'] as $categoryId => $category) {
						
						if($counter >= self::MAX_CATEGORYS_VISIBLE) {
							unset($result[$highlightId]['categorys'][$categoryId]);
						}

						$counter++;
					}

				}

			} else {

				$className = "Reuse_ACK_Model_".ucfirst(strtolower($params['class']));
				$product = new $className ;
				$result = $product->getTree(array('destaque'=>1,'visivel'=>'1'),array('module'=>8));
			}

		}

		return $result;
	}
}

?>