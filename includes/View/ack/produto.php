<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
    <? include_once('_header.php'); ?>
    
            <div id="breadcrumbs">
            	<a href="<? echo $endereco_site; ?>/ack/produtos" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
            	<ul>
                	<li><a href="<? echo $endereco_site; ?>/ack/produtos" title="Institucional"><em>Projeto</em></a></li>
                    <li><span><em><? if ($tipoAcao=="incluir") { ?>Adicionar<? } ?><? if ($tipoAcao=="editar") { ?>Editar<? } ?> projeto</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            
            <div id="descricaoPagina">
            	<h2><? if ($tipoAcao=="incluir") { ?>Adicionar<? } ?><? if ($tipoAcao=="editar") { ?>Editar<? } ?> projeto</h2>
				<?
                    $modelTextos=new ACKtextos_Model();
                    echo $modelTextos->carregaTexto("60");
                ?>
            </div><!-- END descricaoPagina -->
            
            <!-- • • • • -->
            
            <div class="parentFull produto">
            	<input type="hidden" class="dadosPagina" id="produtos" <? if ($tipoAcao=="editar") { ?>value="<? echo $dadosProduto["id"]; ?>"<? } ?> />
                
                <div class="modulo produtos">
                	<div class="head">
                    	<button><em>Conteúdo</em></button>
						<?
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("61");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide colunas">
                    	<div class="collumA form">
                            <fieldset>
                                <legend><em>Nome do projeto </em><strong>[<? echo $conteudoIdiomas[0]["nome"]; ?> - <? echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <input type="text" <? if ($nivelPermissao["nivel"]=="2") { ?>name="titulo_<? echo $conteudoIdiomas[0]["abreviatura"]; ?>"<? } else { ?>disabled="disabled"<? } ?> value="<? echo $dadosProduto["titulo_".$conteudoIdiomas[0]["abreviatura"]]; ?>" />
                            </fieldset>
                            
                            <fieldset class="editorTexto textarea683x110">
                                <legend><em>Conteúdo </em><strong>[<? echo $conteudoIdiomas[0]["nome"]; ?> - <? echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <? if ($nivelPermissao["nivel"]!="2") { ?><div class="bloqueiaEditor"></div><? } ?>                                                              
                                <textarea id="editor" <? if ($nivelPermissao["nivel"]=="2") { ?>name="descricao_<? echo $conteudoIdiomas[0]["abreviatura"]; ?>"<? } ?> rows="5" cols="50"><? echo $dadosProduto["descricao_".$conteudoIdiomas[0]["abreviatura"]]; ?></textarea>
                            </fieldset>
                        </div><!-- END collumA -->
                        
                        
                        <div class="collumB">
                            <fieldset class="radioGrup checkVisivel">
                            	<legend><em>Visível</em><button class="ajuda icone" id="p_41">(?)</button></legend>
                                
                            	<label><input type="radio" <? if ($nivelPermissao["nivel"]=="2") { ?>name="visivel"<? } else { ?>disabled="disabled"<? } ?> value="1"<? if ($dadosProduto["visivel"]=="1" or !$dadosProduto) {?> checked="checked"<? } ?> /><span>Sim</span></label>
                            	<label><input type="radio" <? if ($nivelPermissao["nivel"]=="2") { ?>name="visivel"<? } else { ?>disabled="disabled"<? } ?> value="0"<? if ($dadosProduto["visivel"]=="0") {?> checked="checked"<? } ?> /><span>Não</span></label>
                            </fieldset><!-- END radioGrup -->

                            <fieldset class="radioGrup checkDestaque">
                                <legend><em>Destaque</em><button id="p_41" class="ajuda icone">(?)</button></legend>

                                <label>
                                    <input type="radio" <?php if ($dadosProduto["destaque"]=="1" or !$dadosProduto) {?> checked="checked"<? } ?> value="1" name="destaque">
                                    <span>Sim</span>
                                </label>

                                <label>
                                    <input type="radio" <?php if ($dadosProduto["destaque"]=="0") {?> checked="checked"<? } ?> value="0" name="destaque">
                                    <span>Não</span>
                                </label>
                            </fieldset>
                            
                            <? if (count($conteudoIdiomas)>1) { ?>
                            <fieldset class="menuIdiomas">
                            	<legend><em>Idioma</em><button class="ajuda icone" id="p_1">(?)</button></legend>
                                
                                <div>
                                	<span><span></span><span></span></span>
                                    <div>
                                        <?
                                        $contaIdioma=1;
                                        foreach ($conteudoIdiomas as $conteudoIdioma) {
                                            $siglaIdioma=$conteudoIdioma["abreviatura"];
                                            $nomeIdioma=$conteudoIdioma["nome"];
                                            $classIdioma=$conteudoIdioma["class"];
                                            if ($contaIdioma==1){
                                                ?>
                                                <button name="<?=$siglaIdioma;?>" title="<?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?>" class="<?=$classIdioma;?> onView"><em><?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?></em></button>
                                                <?
                                            } else {
                                                ?>
                                                <button name="<?=$siglaIdioma;?>" title="<?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?>" class="<?=$classIdioma;?>"><em><?=$nomeIdioma;?> - <?=strtoupper($siglaIdioma);?></em></button>
                                                <?
                                            }
                                            $contaIdioma++;
                                        }
                                        ?>
                                    </div>
                                    <span><span></span><span></span></span>
                                </div>
                            </fieldset><!-- END menuIdiomas -->
                            <? } ?>
                            
                        </div><!-- END collumB -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
                <!-- • • • • -->
                
                <div class="modulo categorias">
                	<div class="head">
                    	<button><em>Categorias</em></button>
						<?
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("62");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                        <div class="scrollLista">
                        	<span></span>
                            
                            <div>
                                <div class="header">
                                    <h3>Categorias de projetos</h3>
                                </div><!-- END header -->
                                
                                <!-- • • • • • -->
                                
                                <div class="lista checkGrup">
                                    <ul>
										<?
                                            if (count($categorias)>0) {
												$categoriasProduto=unserialize($dadosProduto["categorias"]);
                                                foreach ($categorias as $categoria)	{
													if (array_key_exists($categoria["id"], $categoriasProduto)) {
														?>
														<li><label><em><? echo $categoria["nome"]; ?></em> <input type="checkbox" value="<? echo $categoria["id"]; ?>" <? if ($nivelPermissao["nivel"]=="2") { ?>name="categorias"<? } else { ?>disabled="disabled"<? } ?> checked="checked" /></label></li>
														<?
													} else {
														?>
														<li><label><em><? echo $categoria["nome"]; ?></em> <input type="checkbox" value="<? echo $categoria["id"]; ?>" <? if ($nivelPermissao["nivel"]=="2") { ?>name="categorias"<? } else { ?>disabled="disabled"<? } ?> /></label></li>
                                                        <?
													}
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div><!-- END lista -->
                            </div>
                            
                            <span></span>
                        </div><!-- END scrollLista -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
                <!-- • • • • -->
                
                <?php if ($nivelPermissao["nivel"]=="2") { ?>
                <div class="modulo upMidias Wfull"<? if ($tipoAcao=="incluir") { ?> style="display:none;"<? } ?>>
                	<div class="head">
                    	<button class="btnAB"><em>Multimídia</em></button>
						<?
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("51");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                        <div class="boxAbas">
                        	<div class="menuAbas">
                            	<? if ($abaImagens) { ?>
                                <button value="abaIMAGEM" title="Imagens" class="abaView">
                                	<span></span>
                                    <em><span>Imagens</span></em>
                                    <span></span>
                                </button>
                                <? } ?>
                            	<? if ($abaVideos) { ?>
                                <button value="abaVIDEO" title="Vídeos">
                                	<span></span>
                                    <em><span>Vídeos</span></em>
                                    <span></span>
                                </button>
                                <? } ?>
                            	<? if ($abaAnexos) { ?>
                                <button value="abaANEXO" title="Anexos">
                                	<span></span>
                                    <em><span>Anexos</span></em>
                                    <span></span>
                                </button>
                                <? } ?>
                            </div><!-- END menuAbas -->
                            
                            <!-- • • • • -->
                            
                            <div class="parentAbas">
                            	<? if ($abaImagens) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba IMAGENS -->
                                <div class="contAba colunas"><!-- nao pode passar ID para estas divs com a classe contAba -->
									<?
                                        $modelTextos=new ACKtextos_Model();
                                        echo $modelTextos->carregaTexto("44");
                                    ?>                                    
                                    <input type="hidden" id="imgEdicao" <? if ($tamanhoCrop) { ?>value="1" class="<?=$tamanhoCrop;?>"<? } else { ?>value="0"<? } ?> /><!-- class=largura altura | value=1 mostra crop, 0 não mostra crop-->
                                    <div class="collumA">
                                        <div class="lista_selecionados">
                                        	<input type="file" name="imagem" id="imagem_upload" <? if (!$multiplasImagens) { ?>class="1"<? } ?>><!-- class = quantidade de arquivos -->
                                        </div><!-- END lista_selecionados -->
                                        
                                        <div style="display:none;" class="tempBox form"></div>
                                    </div><!-- END collumA -->
                                    
                                    <div class="collumB arquivosBloco">
                                    	<ol></ol>
                                    </div><!-- END collumB -->
                                    
                                    <!-- • • • • • • • • • • • EDITAR IMAGEM • • • -->
                                    <div style="display:none;" class="editArquivo edicaoIMAGEM form"></div>
                                </div><!-- END #abaIMAGENS -->
                                <? } ?>
                                <? if ($abaVideos) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba VIDEOS -->
                                <div class="contAba colunas">
									<?
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
                                <? } ?>
                                <? if ($abaAnexos) { ?>
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba ANEXOS -->
                                <div class="contAba colunas">
									<?
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
                                <? } ?>
                            </div><!-- END parentAbas -->
                            
                        </div><!-- END boxAbas -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                <? } ?>
                
                <!-- • • • • -->
                
               
                
            </div><!-- END usuario -->
            
            <!-- • • • • -->
            
            <div id="footerPage">
            	<a href="<? echo $endereco_site; ?>/ack/produtos" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
                <button class="botao salvar" id="salvarProduto" name="<? echo $tipoAcao; ?>" title="Salvar"><span><var></var><em>Salvar</em></span><var class="borda"></var></button>
            </div><!-- END footerPage -->
            
        </div><!-- END wrappeACK-content -->
        
        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->
    
    <? include_once('_footer.php'); ?>
    
</div><!-- END wrapper -->

</body>
</html>