<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Não alterar nada neste arquivo. Ele inclui o main com arquivos necessários e faz o direcionamento do que é chamado pelas URL's amigáveis
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Inclui o arquivo que chama os Controllers, Models e Helpers
require_once "includes/main.php";
//Variável recebida pela URL do .htaccess
$urlRecebida = $_GET["v1"];
$application = new application ($urlRecebida);
$application->bootstrap();
$application->index();
?>