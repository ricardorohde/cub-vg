<?php
// Seta uma interface que vai definir os método obrigatórios da classe
interface bootstrapInterface
{
    public function index($application);
}

// Classe do bootstrap, implementando a interface definida anteriormente
class bootstrap implements bootstrapInterface
{
    public function index($application)
    {
            $this->_initSystemLib($application->url);
    }

    /**
     * inicializa a aplicacao
     * @return [type] [description]
     */
    private function _initSystemLib($url)
    {
        set_include_path(PATH_SEPARATOR . 'includes/View'
            .PATH_SEPARATOR . 'includes/View/helpers'
            .PATH_SEPARATOR . 'includes/Controller'
            .PATH_SEPARATOR . 'includes/Controller/ack'
            .PATH_SEPARATOR . 'includes/Controller/helpers'
            .PATH_SEPARATOR . 'includes/Model'
            .PATH_SEPARATOR . 'includes/Model/ack'
            .PATH_SEPARATOR . 'includes/library'
            .PATH_SEPARATOR . 'includes/library/Zend'
            .PATH_SEPARATOR . 'includes/library/1.0'
            .PATH_SEPARATOR . get_include_path());

        require_once 'includes/library/1.0/System/Application.php';

        $app = new System_Application("development",
                                      "includes/configs/application.ini",
                                      "1.0",
                                      "includes/library/"
                                      );
        $app->setURL($url);
        $this->_initDB();

        /**
         * roda a aplicacao
         */
        $app->run();
    }

    private function _initDB()
    {
        global $db_host;
        global $db_user;
        global $db_pass;
        global $db_name;

        $dbIkro = Zend_Db::factory('Mysqli',array('host' => $db_host,
                                              'username' => $db_user,
                                              'password' => $db_pass,
                                              'dbname' => $db_name));

        $registry = Zend_Registry::getInstance();
        $registry->set('db',$dbIkro);

        Zend_Db_Table::setDefaultAdapter($dbIkro);
    }
}
