<?php
/*====================Váriaveis gerais do sistema=====================*/
$debug=3; //Sempre em números
$cache=false;

/*==============Dados de conexão ao baco de dados do site=============*/
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "vanessaguerra";

/*=====================Dados de Sessão e Cookie=======================*/
$nome_sessao="ack";
$diretorio_cookie="/vanessaguerra";
$servidor_cookie=".servidor";
$tempo_sessao=false; //Em segundos | Se for false, o ACK não irá expirar 

/*===============Dados para envio e leitura de arquivos===============*/
$endereco_fisico=$_SERVER["DOCUMENT_ROOT"]."/vanessaguerra";
$endereco_site="http://servidor/vanessaguerra";

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