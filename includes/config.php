<?php
/*====================V�riaveis gerais do sistema=====================*/
$debug=3; //Sempre em n�meros
$cache=false;

/*==============Dados de conex�o ao baco de dados do site=============*/
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "vanessaguerra";

/*=====================Dados de Sess�o e Cookie=======================*/
$nome_sessao="vanessag";
$diretorio_cookie="/clientes/vanessa";
$servidor_cookie=".icub.com.br";
$tempo_sessao=false; //Em segundos | Se for false, o ACK n�o ir� expirar

/*===============Dados para envio e leitura de arquivos===============*/
$endereco_fisico=$_SERVER["DOCUMENT_ROOT"]."";
$endereco_site = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$endereco_site .= "s";}
$endereco_site .= "://";
$endereco_site.= ($_SERVER["SERVER_PORT"] != "80") ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"] : $_SERVER["SERVER_NAME"];

/*==============Dados para gera��o e grava��o de imagens==============*/
$largura_definida="1920";
$altura_definida="1080";
$qualidade="85";
$tamanho_maximo="4194304";

/*=================Defini��o do idioma padr�o do site=================*/
setlocale(LC_ALL, "pt_BR", "ptb");

/*===============Caracteres para a convers�o de URL===================*/
$caracteresInvalidos = array("'", '"');
$caracteresConvertidos = array("", "");
