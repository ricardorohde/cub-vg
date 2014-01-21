<?php
	class RetrieveModules extends Reuse_ACK_View_helpers_Retrieve_Modules
	{
		protected function __construct() 
		{
        	$this->_module = new Reuse_ACK_Model_Module;
		}

		/**
	     * pega todos os módulos do banco de dados
	     * (mudanças específicas a essa aplicacao)
	     * @return [type] [description]
	     */
	    public function getFromFront() 
	    {
	        $result = $this->_module->get(array('ack'=>'0','status'=>'1'),array('order'=>"ordem ASC"));

	        foreach($result as $elementId => $element) {

	            if($element['modulo'] == 'contatos') {

	                $result[$elementId]['modulo'] = 'contato';

	            } else if ($element['modulo'] == 'produtos') {

	            	$result[$elementId]['modulo'] = 'projetos';
	            }
	        }


	        return $result;
	    }
	}
?>