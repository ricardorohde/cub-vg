<?php
/*====================Váriaveis gerais do sistema=====================*/
$debug=3; //Sempre em números
$cache=false;

/*==============Dados de conexão ao baco de dados do site=============*/
$db_host = "127.0.0.1";
$db_user = "user_vanessa";
$db_pass = "!B=2t2,@D+{9*Kg";
$db_name = "cub_plesk_mt_vanessaguerra";

/*=====================Dados de Sessão e Cookie=======================*/
$nome_sessao="ack";
$diretorio_cookie="/vanessaguerra";
$servidor_cookie=".servidor";
$tempo_sessao=false; //Em segundos | Se for false, o ACK não irá expirar 

/*===============Dados para envio e leitura de arquivos===============*/
$endereco_fisico=$_SERVER["DOCUMENT_ROOT"]."/clientes/vanessaguerra";
$endereco_site="http://www.icub.com.br/clientes/vanessaguerra";

/*==============Dados para geração e gravação de imagens==============*/
$largura_definida="1920";
$altura_definida="1080";
$qualidade="85";
$tamanho_maximo="4194304";

/*=================Definição do idioma padrão do site=================*/
setlocale(LC_ALL, "pt_BR", "ptb");

/*===============Caracteres para a conversão de URL===================*/
$caracteresInvalidos = array("'", '"');
$caracteresConvertidos = array("", "");
?>