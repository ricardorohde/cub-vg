<?php
    class escritorio_Controller extends System_Controller
    {
        /**
         * modulo do controlador no sistema
         */
        const MODULE = 7;

        public function index()
        {
            $institucional = new Reuse_ACK_Model_Institutional;
            $resultInstitucional = $institucional->getTree(array("visivel"=>1,"status"=>1),array('order'=>'ordem ASC'));

            $sizes = array(
                                0=>"&w=380&h=363&zc=0",
                                1=>"&w=230&h=220&zc=0"
                            );

            $result['escritorio'] = array();
            $counter = 0;
            foreach ($resultInstitucional as $elementId => $element) {

                if ($element["visivel"] != 1 || $element["status"] != 1) {
                    continue;
                }

                $imagens = array();
                foreach ($element['image'] as $foto) {

                    //para cada imagem, testa se a mesma tem algum crop, caso o tenha então são concatenados os
                    //paramestros de crop

                    $imagens[] = formThumbImage($foto['arquivo'],$foto['id'],$sizes[$counter]);
                }

                $videos = array();
                foreach ($element['video'] as $video) {
                    $videos[] = System_Object_Video::getIdentificator($video['arquivo']);
                }

                $result['escritorio'][] = array('titulo'=>$element['titulo_'.System_Language::current()],
                                                'texto'=>$element['conteudo_'.System_Language::current()],
                                                'imagens'=>$imagens,
                                                'videos' => $videos);

                $counter++;
            }

            return $result;
        }

    }
