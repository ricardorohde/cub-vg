<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include_once('_header.php'); ?>

            <div id="breadcrumbs">
                <ul>
                    <li><span><em>Dados gerais</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->

            <div id="descricaoPagina">
                <h2>Dados gerais</h2>
                <p>
                    <?php
                        $modelTextos=new ACKtextos_Model();
                        echo $modelTextos->carregaTexto("6");
                    ?>
                </p>
            </div><!-- END descricaoPagina -->

            <div class="parentFull">
                <input type="hidden" class="dadosPagina" id="dadosGerais" value="" />

                <div id="sistema" class="modulo infoSistema">
                    <div class="head">
                        <button class="btnAB fechado"><em>Informações do sistema</em></button>
                        <p>
                            <?php
                                echo $modelTextos->carregaTexto("8");
                            ?>
                        </p>
                    </div><!-- END head -->

                    <div class="slide form" id="sistema">
                        <fieldset>
                            <legend><em>Publicado</em> <button title="O que é isso?" class="ajuda" id="p_10"><span>O que é isso?</span></button></legend>

                            <div class="select publicado">
                            <select <?php if ($nivelSistema["nivel"]=="2") { ?>name="publicado"<?php } else { ?>disabled="disabled"<?php } ?>>
                                <option value="1"<?php if ($dadosSite["publicado"]=="1") {?> selected="selected"<?php } ?>>Sim</option>
                                <option value="0"<?php if ($dadosSite["publicado"]=="0") {?> selected="selected"<?php } ?>>Não</option>
                            </select>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><em>E-mail principal</em> <button title="O que é isso?" class="ajuda" id="p_11"><span>O que é isso?</span></button></legend>
                            <input type="email" <?php if ($nivelSistema["nivel"]=="2") { ?>name="email"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosSite["email"]; ?>" />
                            <input type="hidden" <?php if ($nivelSistema["nivel"]=="2") { ?>name="id"<?php } else { ?>disabled="disabled"<?php } ?> value="1" />
                        </fieldset>

                        <fieldset>
                            <legend><em>Web Property ID - Google Analytics</em> <button title="O que é isso?" class="ajuda" id="p_12"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelSistema["nivel"]=="2") { ?>name="ga"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosSite["ga"]; ?>" />
                        </fieldset>

                        <fieldset>
                            <legend><em>Resultados por página nas listas do ACK</em> <button title="O que é isso?" class="ajuda" id="p_13"><span>O que é isso?</span></button></legend>
                            <div class="select numeroLinhas">
                            <select <?php if ($nivelSistema["nivel"]=="2") { ?>name="itens_pagina"<?php } else { ?>disabled="disabled"<?php } ?>>
                                <option value="10"<?php if ($dadosSite["itens_pagina"]=="10") {?> selected="selected"<?php } ?>>10</option>
                                <option value="50"<?php if ($dadosSite["itens_pagina"]=="50") {?> selected="selected"<?php } ?>>50</option>
                                <option value="100"<?php if ($dadosSite["itens_pagina"]=="100") {?> selected="selected"<?php } ?>>100</option>
                                <option value="150"<?php if ($dadosSite["itens_pagina"]=="150") {?> selected="selected"<?php } ?>>150</option>
                                <option value="200"<?php if ($dadosSite["itens_pagina"]=="200") {?> selected="selected"<?php } ?>>200</option>
                                <option value="500"<?php if ($dadosSite["itens_pagina"]=="500") {?> selected="selected"<?php } ?>>500</option>
                            </select>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend><em>Perfil/Página Facebook</em> <button title="O que é isso?" class="ajuda" id="p_23"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelSistema["nivel"]=="2") { ?>name="facebook"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosSite["facebook"]; ?>" />
                        </fieldset>

                        <fieldset>
                            <legend><em>Twitter oficial</em> <button title="O que é isso?" class="ajuda" id="p_24"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelSistema["nivel"]=="2") { ?>name="twitter"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosSite["twitter"]; ?>" />
                        </fieldset>

                        <fieldset>
                            <legend><em>Canal no Youtube</em> <button title="O que é isso?" class="ajuda" id="p_25"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelSistema["nivel"]=="2") { ?>name="youtube"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosSite["youtube"]; ?>" />
                        </fieldset>

                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->

                <!-- • • • • -->
                <?php if ($nivelMetatags["nivel"]) { ?>
                <div id="metaTags" class="modulo <?php if ($nivelMetatags["nivel"]=="2") { ?>metaTags<?php } ?>">
                    <div class="head">
                        <button class="btnAB fechado"><em>Meta-tags</em></button>
                        <p>
                            <?php
                                echo $modelTextos->carregaTexto("14");
                            ?>
                        </p>
                    </div><!-- END head -->

                    <div class="slide form" id="metatags">
                        <fieldset>
                            <legend><em>Title - </em><small>Máximo <b>60</b> caracteres</small><button title="O que é isso?" class="ajuda" id="p_17"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="title"<?php } else { ?>disabled="disabled"<?php } ?> maxlength="60" value="<?php echo $metaTagsSite["title"]; ?>" />
                            <input type="hidden" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="id"<?php } else { ?>disabled="disabled"<?php } ?> value="1" />
                        </fieldset>

                        <fieldset>
                            <legend><em>Author - </em><small>Máximo <b>60</b> caracteres</small><button title="O que é isso?" class="ajuda" id="p_18"><span>O que é isso?</span></button></legend>
                            <input type="text" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="author"<?php } else { ?>disabled="disabled"<?php } ?> maxlength="60" value="<?php echo $metaTagsSite["author"]; ?>" />
                        </fieldset>

                        <fieldset class="textarea683x80">
                            <legend><em>Description - </em><small>Máximo <b>160</b> caracteres</small><button title="O que é isso?" class="ajuda" id="p_19"><span>O que é isso?</span></button></legend>
                            <textarea <?php if ($nivelMetatags["nivel"]=="2") { ?>name="description"<?php } else { ?>disabled="disabled"<?php } ?> rows="5" cols="50"><?php echo $metaTagsSite["description"]; ?></textarea>
                        </fieldset>

                        <fieldset class="textarea683x80">
                            <legend><em>Keywords - </em><small>Máximo <b>255</b> caracteres</small><button title="O que é isso?" class="ajuda" id="p_20"><span>O que é isso?</span></button></legend>
                            <textarea <?php if ($nivelMetatags["nivel"]=="2") { ?>name="keywords"<?php } else { ?>disabled="disabled"<?php } ?> rows="5" cols="50"><?php echo $metaTagsSite["keywords"]; ?></textarea>
                        </fieldset>

                        <fieldset id="menuRobot" class="radioGrup">
                            <legend><span>Robots</span><button title="O que é isso?" class="ajuda" id="p_21"><span>O que é isso?</span></button></legend>

                            <label>
                                <input type="radio" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="robots"<?php } else { ?>disabled="disabled"<?php } ?> value="1"<?php if ($metaTagsSite["robots"]=="1") {?> checked="checked"<?php } ?> />
                                <span><span>INDEX, FOLLOW</span> - Os robôs podem indexar a página e ainda seguir os links para outras páginas que ela contém.</span>
                            </label>

                            <label>
                                <input type="radio" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="robots"<?php } else { ?>disabled="disabled"<?php } ?> value="2"<?php if ($metaTagsSite["robots"]=="2") {?> checked="checked"<?php } ?> />
                                <span><span>INDEX, NOFOLLOW</span> - A página é indexada, mas os links não são seguidos.</span>
                            </label>

                            <label>
                                <input type="radio" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="robots"<?php } else { ?>disabled="disabled"<?php } ?> value="3"<?php if ($metaTagsSite["robots"]=="3") {?> checked="checked"<?php } ?> />
                                <span><span>NOINDEX, FOLLOW</span> - Os links podem ser seguidos, mas a página não é indexada.</span>
                            </label>

                            <label>
                                <input type="radio" <?php if ($nivelMetatags["nivel"]=="2") { ?>name="robots"<?php } else { ?>disabled="disabled"<?php } ?> value="4"<?php if ($metaTagsSite["robots"]=="4") {?> checked="checked"<?php } ?> />
                                <span><span>NOINDEX, NOFOLLOW</span> - A página não é indexada e os links não são seguidos.</span>
                            </label>
                        </fieldset><!-- END menuRobot -->

                        <fieldset>
                            <legend><em>Revisited-after</em> <button title="O que é isso?" class="ajuda" id="p_22"><span>O que é isso?</span></button></legend>
                            <div class="select diasRevisao">
                            <select <?php if ($nivelMetatags["nivel"]=="2") { ?>name="revisit"<?php } else { ?>disabled="disabled"<?php } ?>>
                                <option value="7"<?php if ($metaTagsSite["revisit"]=="7") {?> selected="selected"<?php } ?>>7 dias</option>
                                <option value="15"<?php if ($metaTagsSite["revisit"]=="15") {?> selected="selected"<?php } ?>>15 dias</option>
                                <option value="30"<?php if ($metaTagsSite["revisit"]=="30") {?> selected="selected"<?php } ?>>30 dias</option>
                                <option value="90"<?php if ($metaTagsSite["revisit"]=="90") {?> selected="selected"<?php } ?>>90 dias</option>
                            </select>
                            </div>
                        </fieldset>

                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo  -->
                <?php } ?>
                <!-- • • • • -->

                <div id="idiomas" class="modulo idiomasSite listagem">
                    <div class="head">
                        <button class="btnAB fechado"><em>Idiomas do site</em></button>
                        <p>
                            <?php
                                echo $modelTextos->carregaTexto("9");
                            ?>
                        </p>
                    </div><!-- END head -->

                    <div class="slide">
                        <div class="lista list_idiomas">

                            <div class="header">
                                <span class="borda"></span>
                                <div>
                                    <div class="idioma"><button><em>Idioma</em></button></div>
                                    <div class="apreviatura"><button><em>Abreviatura</em></button></div>
                                    <div class="visivel"><button><em>Visível</em></button></div>
                                </div>
                                <span class="borda"></span>
                            </div><!-- END header -->

                            <ol class="listaIdiomas">
                                <?php foreach ($idiomasSite as $idioma) { ?>
                                <!--  Importante o ID da <li> ser passado para o NAME do <input>  -->
                                <li id="<?php echo $idioma["id"]; ?>">
                                    <div>
                                        <span class="idioma"><?php echo $idioma["nome"]; ?></span>
                                        <span class="abreviatura"><?php echo strtoupper($idioma["abreviatura"]); ?></span>
                                        <label class="visivel <?php if ($idioma["visivel"]=="1") {?> ok<?php } ?>"><input type="checkbox" name="idiomas"<?php if ($idioma["visivel"]=="1") {?> checked="checked"<?php } ?> /></label>
                                    </div>
                                </li>
                                <?php } ?>
                            </ol><!-- END listaPermissoes -->
                        </div><!-- END lista -->

                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->

            </div><!-- END usuario -->

            <!-- • • • • -->

            <div id="footerPage">
                <button class="botao salvar" title="Salvar" name="editar" id="salvarGeral" value="dadosGerais"><span><var></var><em>Salvar</em></span><var class="borda"></var></button>
            </div><!-- END footerPage -->

        </div><!-- END wrappeACK-content -->

        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->

    <?php include_once('_footer.php'); ?>

</div><!-- END wrapper -->

</body>
</html>
