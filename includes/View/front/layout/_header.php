<?php
	global $endereco_site;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?= Reuse_ACK_View_helpers_Show_Meta::run() ?>
    
    <link rel="apple-touch-icon" href="<?= $endereco_site ?>/imagens/site/ipadIcon.jpg" />
    <link type="image/ico" rel="Shortcut Icon" href="<?= $endereco_site ?>/favicon.ico" />
    <link type="text/css" rel="stylesheet" href="<?= $endereco_site ?>/css/site/style.vanessa_guerra.css" />
    <!--[if IE 7]> <link type="text/css" rel="stylesheet" href="<?= $endereco_site ?>/css/site/style.vanessa_guerra_IE7.css" /> <![endif]-->
    <!--[if IE 8]> <link type="text/css" rel="stylesheet" href="<?= $endereco_site ?>/css/site/style.vanessa_guerra_IE8.css" /> <![endif]-->
    <!--[if IE 9]> <link type="text/css" rel="stylesheet" href="<?= $endereco_site ?>/css/site/style.vanessa_guerra_IE9.css" /> <![endif]-->
    
    <!-- Biblioteca essenciais -->
    <script type="text/javascript" src="<?= $endereco_site ?>/js/site/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?= $endereco_site ?>/js/json2.js"></script>
    <!-- Plugins adicionais -->
    <script type="text/javascript" src="<?= $endereco_site ?>/js/site/jquery.hashchange.js"></script>
    <script type="text/javascript" src="<?= $endereco_site ?>/js/site/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="<?= $endereco_site ?>/js/site/swipe.js"></script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>
    <!-- Ações personalizadas -->
    <script type="text/javascript" src="<?= $endereco_site ?>/js/site/script.vanessa_guerra.js"></script>
    
    <script>
        site.url = "<?= $endereco_site ?>";
    </script>
    
    <?= Reuse_ACK_View_helpers_Show_GoogleAnalytics::run(); ?>
</head>
