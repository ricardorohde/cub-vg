<?php
    /**
     * classe de categorias
     */
    class Reuse_ACK_Model_Product extends System_DB_Table
    {
        protected $_name = 'produtos';
        const MODULE = 8;

        /**
         * seta as tabelas dependentes de um produto
         * @var array
         */
        protected $_dependentTables = array('Reuse_ACK_Model_Image','Reuse_ACK_Model_Video','Reuse_ACK_Model_Annex');

        public function getTree(array $array,$params=null,$columns=null)
        {
            $result = parent::getTree($array,$params,$columns);

            $arr['result'] = &$result;
            $arr['params'] = $params;

            $result = System_Helper_ChildSelector::run($arr);

            foreach ($result as $elementId => $element) {

                foreach ($element['image'] as $fotoId => $foto) {
                    if ($foto['status'] != 1 || $foto['visivel_'.System_Language::current()] != 1 || $foto["modulo"] != self::MODULE) {
                        unset($result[$elementId]['image'][$fotoId]);
                    }
                }

                foreach ($element['annex'] as $anexoId => $anexo) {
                    if ($anexo['status'] != 1 || $anexo['visivel_'.System_Language::current()] != 1 || $anexo["modulo"] != self::MODULE) {
                        unset($result[$elementId]['annex'][$anexoId]);
                    }
                }

                foreach ($element['video'] as $anexoId => $anexo) {
                    if ($anexo['status'] != 1 || $anexo['visivel_'.System_Language::current()] != 1 || $anexo["modulo"] != self::MODULE) {
                        unset($result[$elementId]['video'][$anexoId]);
                    }
                }
            }

            return $result;
        }

        /**
         * retorna todos os filhos e as categorias a que esse produto pertence
         * @param  array  $array   [description]
         * @param  [type] $params  [description]
         * @param  [type] $columns [description]
         * @return [type]          [description]
         */
        public function getChildAndParents(array $array,$params=null,$columns=null)
        {
            /** @var pega os filhos */
            $result = parent::getTree($array,$params,$columns);

            $arr['result'] = &$result;
            $arr['params'] = $params;

            $result = System_Helper_ChildSelector::run($arr);

            $category = new Reuse_ACK_Model_Category;

            foreach ($result as $elementId => $element) {
                $categoryArray = (unserialize($element['categorias']));

                foreach ($categoryArray as $categoryElementId => $categoryElement) {
                    $tmp = $category->get(array('id'=>$categoryElementId));
                    $result[$elementId]['categorys'][] = $tmp[0];
                }
            }

            foreach ($result as $elementId => $element) {

                foreach ($element['image'] as $fotoId => $foto) {
                    if ($foto['status'] != 1 || $foto['visivel_'.System_Language::current()] != 1 || $foto["modulo"] != self::MODULE) {
                        unset($result[$elementId]['image'][$fotoId]);
                    }
                }

                foreach ($element['annex'] as $anexoId => $anexo) {
                    if ($anexo['status'] != 1 || $anexo['visivel_'.System_Language::current()] != 1 || $anexo["modulo"] != self::MODULE) {
                        unset($result[$elementId]['annex'][$anexoId]);
                    }
                }

                foreach ($element['video'] as $anexoId => $anexo) {
                    if ($anexo['status'] != 1 || $anexo['visivel_'.System_Language::current()] != 1 || $anexo["modulo"] != self::MODULE) {
                        unset($result[$elementId]['video'][$anexoId]);
                    }
                }
            }

            return $result;
        }
    }
