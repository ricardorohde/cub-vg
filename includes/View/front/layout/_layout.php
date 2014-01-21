<?php
    /**
     * pega os dados da view/controller
     * @var [type]
     */
    $frontController = System_FrontController::getInstance();
    $controller = $frontController->getControllerName();
    $view = $frontController->getViewName();

    /**
     * pega todos os módulos do front
     */
   $retrieveModules = RetrieveModules::getInstance("RetrieveModules");
   $modules = $retrieveModules->getFromFront();

   $highlights = RetrieveHighlight::run(array('class'=>'product'));

?>

<body>
<div id="wrapper">

    <div class="loader"><p>Carregando...</p></div>

    <!-- • • • • • • • • • • • • • • • • • • • • -->

    <div id="project-gallery">

        <ul class="project-gallery-list">

            <?php foreach ($highlights as $highlight) {

                $image = reset($highlight['image']);
                $mainCategory = reset($highlight['categorys']);

            ?>
                <li class="project-gallery-item">
                    <img src="plugins/thumb/phpThumb.php?src=../../galeria/<?= $image['arquivo'] ?>&w=1024&h=480&zc=1" alt=""  />
                    <div class="project-gallery-info">
                        <div class="title">
                            <a href="#!/projeto/<?= $highlight['id'] ?>/<?= formaURL($highlight['titulo_'.System_Language::current()]) ?>"><?= ($highlight['titulo_'.System_Language::current()]) ?></a>
                        </div>
                        <div class="tags">
                                <?php
                                    $counter=1;
                                    foreach ($highlight['categorys'] as $category) {
                                ?>
                                        <a href="#!/categoria/<?= $category['id'] ?>/<?= formaURL($category['titulo_'.System_Language::current()]) ?>">
                                           <?= $category['titulo_'.System_Language::current()] ?>
                                        </a> <?= ($counter < (count($highlight['categorys']))) ? '-' : '' ?>
                                <?php
                                        $counter++;
                                    }
                                 ?>
                        </div>
                        <a href="#!/projeto/<?= $highlight['id'] ?>/<?= $highlight['titulo_'.System_Language::current()] ?>" title="Ver detalhes" class="project-gallery-link"></a>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div class="cycle-nav-box">
            <ul class="cycle-nav"></ul>
        </div>

    </div> <!-- fim galeria_trabalhos -->

    <!-- • • • • • • • • • • • • • • • • • • • • -->

    <div id="header">
        <div class="container">

            <h1 class="site-title"><a href="#!/home" class="site-logo">Vanessa Guerra Arquitetura</a></h1>

            <ul id="menu">

                <li class="menu-item"><a href="#!/home" class="menu-item-link home">Página Inicial</a></li>
                <li class="menu-item"><a href="#!/escritorio" class="menu-item-link escritorio">Escritório</a></li>
                <li class="menu-item"><a href="#!/projetos/page/1" class="menu-item-link categoria projetos projeto busca">Projetos</a></li>
                <li class="menu-item"><a href="#!/contato" class="menu-item-link contato">Contato</a></li>

                <?php
                /*
                    foreach ($modules as $module) {

                        $selected = false;
                        if($controller == $module['home'])
                            $selected = true;
                            <li class="menu-item">
                                <a href="#!/<?= ($module['modulo'] == "institucional" ) ? "escritorio" : $module["modulo"] ?>" class="menu-item-link <?= ($selected) ? 'selected' : '' ?> <?= ($module['modulo'] == "institucional" ) ? "escritorio" : $module["modulo"] ?>"><?=$module['titulo_pt']?></a>
                            </li>
                    }
                */
                ?>

            </ul>

        </div>
    </div> <!-- fim header -->

    <!-- • • • • • • • • • • • • • • • • • • • • -->

    <div id="conteudo"></div> <!-- fim conteudo -->

    <!-- • • • • • • • • • • • • • • • • • • • • -->

</div> <!-- fim wrapper -->

</body>
</html>
