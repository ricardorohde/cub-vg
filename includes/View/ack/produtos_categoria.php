<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once('_header.php'); ?>

            <div id="breadcrumbs">
                <a href="<?php echo $endereco_site; ?>/ack/produtos/categorias" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
                <ul>
                    <li><a href="<?php echo $endereco_site; ?>/ack/produtos" title="Institucional"><em>Produtos</em></a></li>
                    <li><a href="<?php echo $endereco_site; ?>/ack/produtos/categorias" title="Institucional"><em>Categorias de produtos</em></a></li>
                    <li><span><em><?php if ($tipoAcao=="incluir") { ?>Adicionar<?php } ?><?php if ($tipoAcao=="editar") { ?>Editar<?php } ?> categoria</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->

            <!-- • • • • -->

            <div id="descricaoPagina">
                <h2><?php if ($tipoAcao=="incluir") { ?>Adicionar<?php } ?><?php if ($tipoAcao=="editar") { ?>Editar<?php } ?> categoria</h2>
                <?php
                    $modelTextos=new ACKtextos_Model();
                    echo $modelTextos->carregaTexto("56");
                ?>
            </div><!-- END descricaoPagina -->

            <!-- • • • • -->

            <div class="parentFull categoria">
                <input type="hidden" class="dadosPagina" id="categorias" <?php if ($tipoAcao=="editar") { ?>value="<?php echo $dadosCategoria["id"]; ?>"<?php } ?> />

                <div class="modulo" id="categorias">
                    <div class="head">
                        <button class="btnAB "><em>Informações da categoria</em></button>
                        <?php
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("57");
                        ?>
                    </div><!-- END head -->

                    <div class="slide colunas">
                        <div class="collumA form">
                            <fieldset style="display:none">
                                <legend><em>Sub-categoria de:</em></legend>
                                <div class="select">
                                    <select <?php if ($nivelPermissao["nivel"]=="2") { ?>name="relacao_id"<?php } else { ?>disabled="disabled"<?php } ?>>
                                        <option class="tab0" selected="selected" value="0">Nível principal</option>
                                        <?php
                                        // foreach ($categoriasSelect as $categoria) {
                                        // 	if ($categoria["id"]!=$dadosCategoria["id"]) {
                                        // 		if ($categoria["id"]==$dadosCategoria["relacao_id"]) {
                                        // 			echo "<option value=\"".$categoria["id"]."\" class=\"tab".$categoria["nivel"]."\" selected=\"selected\">".$categoria["nome"]."</option>\n";
                                        // 		} else {
                                        // 			echo "<option value=\"".$categoria["id"]."\" class=\"tab".$categoria["nivel"]."\">".$categoria["nome"]."</option>\n";
                                        // 		}
                                        // 	} else {
                                        // 		echo "<option value=\"".$categoria["id"]."\" class=\"tab".$categoria["nivel"]."\" disabled=\"disabled\">".$categoria["nome"]."</option>\n";
                                        // 	}
                                        // }
                                        ?>
                                    </select>
                                    <?php if ($tipoAcao=="editar") { ?><input type="hidden" <?php if ($nivelPermissao["nivel"]=="2") { ?>name="relacao_idAtual"<?php } else { ?>disabled="disabled"<?php } ?> value="<?=$dadosCategoria["relacao_id"]?>" /><?php } ?>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend><em>Título da categoria </em><strong>[<?php echo $conteudoIdiomas[0]["nome"]; ?> - <?php echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <input type="text" <?php if ($nivelPermissao["nivel"]=="2") { ?>name="titulo_<?php echo $conteudoIdiomas[0]["abreviatura"]; ?>"<?php } else { ?>disabled="disabled"<?php } ?> value="<?php echo $dadosCategoria["titulo_".$conteudoIdiomas[0]["abreviatura"]]; ?>" />
                            </fieldset>

                            <fieldset style="display:none" class="editorTexto textarea683x110 ">
                                <legend><em>Conteúdo </em><strong>[<?php echo $conteudoIdiomas[0]["nome"]; ?> - <?php echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <?php if ($nivelPermissao["nivel"]!="2") { ?><div class="bloqueiaEditor"></div><?php } ?>
                                <textarea id="editor" <?php if ($nivelPermissao["nivel"]=="2") { ?>name="descricao_<?php echo $conteudoIdiomas[0]["abreviatura"]; ?>"<?php } ?> rows="5" cols="50"><?php echo $dadosCategoria["descricao_".$conteudoIdiomas[0]["abreviatura"]]; ?></textarea>
                            </fieldset>
                        </div><!-- END collumA -->

                        <!-- • • • • -->

                        <div class="collumB">
                            <fieldset class="radioGrup checkVisivel">
                                <legend><em>Visível</em><button class="ajuda icone" id="p_41">(?)</button></legend>

                                <label><input type="radio" <?php if ($nivelPermissao["nivel"]=="2") { ?>name="visivel"<?php } else { ?>disabled="disabled"<?php } ?> value="1"<?php if ($dadosCategoria["visivel"]=="1" or !$dadosCategoria) { ?> checked="checked"<?php } ?> /><span>Sim</span></label>
                                <label><input type="radio" <?php if ($nivelPermissao["nivel"]=="2") { ?>name="visivel"<?php } else { ?>disabled="disabled"<?php } ?> value="0"<?php if ($dadosCategoria["visivel"]=="0") { ?> checked="checked"<?php } ?> /><span>Não</span></label>
                            </fieldset><!-- END radioGrup -->

                            <!-- • • • • -->

                            <?php if (count($conteudoIdiomas)>1) { ?>
                            <fieldset class="menuIdiomas">
                                <legend><em>Idioma</em><button class="ajuda icone" id="p_1">(?)</button></legend>

                                <div>
                                    <span><span></span><span></span></span>
                                    <div>
                                        <?php
                                        $contaIdioma=1;
                                        foreach ($conteudoIdiomas as $conteudoIdioma) {
                                            $siglaIdioma=$conteudoIdioma["abreviatura"];
                                            $nomeIdioma=$conteudoIdioma["nome"];
                                            $classIdioma=$conteudoIdioma["class"];
                                            if ($contaIdioma==1) {
                                                ?>
                                                <button name="<?=$siglaIdioma;?>" title="<?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?>" class="<?=$classIdioma;?> onView"><em><?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?></em></button>
                                                <?php
                                            } else {
                                                ?>
                                                <button name="<?=$siglaIdioma;?>" title="<?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?>" class="<?=$classIdioma;?>"><em><?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?></em></button>
                                                <?php
                                            }
                                            $contaIdioma++;
                                        }
                                        ?>
                                    </div>
                                    <span><span></span><span></span></span>
                                </div>
                            </fieldset><!-- END menuIdiomas -->
                            <?php } ?>
                        </div><!-- END collumB -->

                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->

                <!-- • • • • -->
                <?php if ($nivelPermissao["nivel"]=="2") { ?>
                <div class="modulo upMidias Wfull"<?php if ($tipoAcao=="incluir") { ?> style="display:none;"<?php } ?>>
                    <div class="head">
                        <button class="btnAB"><em>Multimídia</em></button>
                        <?php
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("51");
                        ?>
                    </div><!-- END head -->

                    <div class="slide">

                        <div class="boxAbas">
                            <div class="menuAbas">
                                <?php if ($abaImagens) { ?>
                                <button value="abaIMAGEM" title="Imagens" class="abaView">
                                    <span></span>
                                    <em><span>Imagens</span></em>
                                    <span></span>
                                </button>
                                <?php } ?>
                                <?php if ($abaVideos) { ?>
                                <button value="abaVIDEO" title="Vídeos">
                                    <span></span>
                                    <em><span>Vídeos</span></em>
                                    <span></span>
                                </button>
                                <?php } ?>
                                <?php if ($abaAnexos) { ?>
                                <button value="abaANEXO" title="Anexos">
                                    <span></span>
                                    <em><span>Anexos</span></em>
                                    <span></span>
                                </button>
                                <?php } ?>
                            </div><!-- END menuAbas -->

                            <!-- • • • • -->

                            <div class="parentAbas">
                                <?php if ($abaImagens) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba IMAGENS -->
                                <div class="contAba colunas"><!-- nao pode passar ID para estas divs com a classe contAba -->
                                    <?php
                                        $modelTextos=new ACKtextos_Model();
                                        echo $modelTextos->carregaTexto("44");
                                    ?>
                                    <input type="hidden" id="imgEdicao" <?php if ($tamanhoCrop) { ?>value="1" class="<?=$tamanhoCrop;?>"<?php } else { ?>value="0"<?php } ?> /><!-- class=largura altura | value=1 mostra crop, 0 não mostra crop-->
                                    <div class="collumA">
                                        <div class="lista_selecionados">
                                            <input type="file" name="imagem" id="imagem_upload" <?php if (!$multiplasImagens) { ?>class="1"<?php } ?>><!-- class = quantidade de arquivos -->
                                        </div><!-- END lista_selecionados -->

                                        <div style="display:none;" class="tempBox form"></div>
                                    </div><!-- END collumA -->

                                    <div class="collumB arquivosBloco">
                                        <ol></ol>
                                    </div><!-- END collumB -->

                                    <!-- • • • • • • • • • • • EDITAR IMAGEM • • • -->
                                    <div style="display:none;" class="editArquivo edicaoIMAGEM form"></div>
                                </div><!-- END #abaIMAGENS -->
                                <?php } ?>
                                <?php if ($abaVideos) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba VIDEOS -->
                                <div class="contAba colunas">
                                    <?php
                                        $modelTextos=new ACKtextos_Model();
                                        echo $modelTextos->carregaTexto("52");
                                    ?>
                                    <div class="collumA">
                                        <div class="lista_selecionados">
                                            <button value="youtube" class="includeURLvideo" id="btn_UpYoutube">Clique aqui para incluir um vídeo do YouTube.</button>
                                            <button value="vimeo" class="includeURLvideo" id="btn_UpVimeo">Clique aqui para incluir um vídeo do Vimeo.</button>
                                            <input type="file" name="video" id="video_upload">
                                        </div><!-- END btn_incluir -->

                                        <div style="display:none;" class="tempBox form"></div>
                                    </div><!-- END collumA -->

                                    <div class="collumB arquivosBloco">
                                        <ol></ol>
                                    </div><!-- END collumB -->

                                    <!-- • • • • • • • • • • • EDITAR VIDEO • • • -->
                                    <div style="display:none;" class="editArquivo edicaoVIDEO form"></div>
                                </div><!-- END #abaVIDEOS -->
                                <?php } ?>
                                <?php if ($abaAnexos) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba ANEXOS -->
                                <div class="contAba colunas">
                                    <?php
                                        $modelTextos=new ACKtextos_Model();
                                        echo $modelTextos->carregaTexto("53");
                                    ?>
                                    <div class="collumA">
                                        <div class="lista_selecionados">
                                            <input type="file" name="anexo" id="anexo_upload">
                                        </div><!-- END btn_incluir -->

                                        <div style="display:none;" class="tempBox form"></div>
                                    </div><!-- END collumA -->

                                    <div class="collumB arquivosLista">
                                        <ol></ol>
                                    </div><!-- END collumB -->

                                    <!-- • • • • • • • • • • • EDITAR ANEXO • • • -->
                                    <div style="display:none;" class="editArquivo edicaoANEXO form"></div>
                                </div><!-- END #abaANEXOS -->
                                <?php } ?>
                            </div><!-- END parentAbas -->

                        </div><!-- END boxAbas -->

                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                <?php } ?>
                <!-- • • • • -->

            </div><!-- END usuario -->

            <!-- • • • • -->

            <div id="footerPage">
                <a href="<?php echo $endereco_site; ?>/ack/produtos/categorias" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
                <button class="botao salvar" id="salvarCategorias" name="<?php echo $tipoAcao; ?>" title="Salvar"><span><var></var><em>Salvar</em></span><var class="borda"></var></button>
            </div><!-- END footerPage -->

        </div><!-- END wrappeACK-content -->

        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->

    <?php include_once('_footer.php'); ?>

</div><!-- END wrapper -->

</body>
</html>
