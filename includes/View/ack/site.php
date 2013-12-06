<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
    <? include_once('_header.php'); ?>
    
            <div id="breadcrumbs">
            	<a href="<? echo $endereco_site; ?>/ack/sites" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
            	<ul>
                	<li><a href="<? echo $endereco_site; ?>/ack/sites" title="Institucional"><em>Sites Santa Clara</em></a></li>
                    <li><span><em><? if ($tipoAcao=="incluir") { ?>Adicionar<? } ?><? if ($tipoAcao=="editar") { ?>Editar<? } ?> site</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            <!-- • • • • -->
            
            <div id="descricaoPagina">
            	<h2><? if ($tipoAcao=="incluir") { ?>Adicionar<? } ?><? if ($tipoAcao=="editar") { ?>Editar<? } ?> site</h2>
				<?
                    $modelTextos=new textos_Model();
                    echo $modelTextos->carregaTexto("77");
                ?>
            </div><!-- END descricaoPagina -->
            
            <!-- • • • • -->
            
            <div class="parentFull site">
            	<input type="hidden" class="dadosPagina" id="sites" <? if ($tipoAcao=="editar") { ?>value="<? echo $dadosSite["id"]; ?>"<? } ?>/>
                
                <div class="modulo sites">
                	<div class="head">
                    	<button class="btnAB"><em>Conteúdo</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("78");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide colunas">
                    	<div class="collumA form">
                            <fieldset>
                                <legend><em>Título do site </em><strong>[<? echo $conteudoIdiomas[0]["nome"]; ?> - <? echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <input type="text" name="titulo_<? echo $conteudoIdiomas[0]["abreviatura"]; ?>" value="<? echo $dadosSite["titulo_".$conteudoIdiomas[0]["abreviatura"]] ?>" />
                            </fieldset>
                            
                            <fieldset>
                                <legend><em>URL do site</em></legend>
                                <input type="text" name="url" value="<? echo $dadosSite["url"] ?>" />
                            </fieldset>
                            
                            <fieldset class="editorTexto textarea683x80">
                                <legend><em>Descrição </em><strong>[<? echo $conteudoIdiomas[0]["nome"]; ?> - <? echo strtoupper($conteudoIdiomas[0]["abreviatura"]); ?>]</strong></legend>
                                <textarea id="editor" name="descricao_<? echo $conteudoIdiomas[0]["abreviatura"]; ?>" rows="5" cols="50"><? echo $dadosSite["descricao_".$conteudoIdiomas[0]["abreviatura"]] ?></textarea>
                            </fieldset>
                        </div><!-- END collumA -->
                        
                        <!-- • • • • -->
                        
                        <div class="collumB">
                            <fieldset class="radioGrup checkVisivel">
                            	<legend><em>Visível</em><button class="ajuda icone" id="p_41">(?)</button></legend>
                                
                            	<label><input type="radio" name="visivel" value="1"<? if ($dadosSite["visivel"]=="1" or !$dadosSite) {?> checked="checked"<? } ?> /><span>Sim</span></label>
                            	<label><input type="radio" name="visivel" value="0"<? if ($dadosSite["visivel"]=="0") {?> checked="checked"<? } ?> /><span>Não</span></label>
                            </fieldset><!-- END radioGrup -->
                            
                            <!-- • • • • -->
                            
                            <fieldset class="menuButton">
                                <legend><em>Idioma</em><button class="ajuda icone" id="p_1">(?)</button></legend>
                                
                                <div id="idiomaInstitucional" class="menuIdioma">
                                    <span class="borda topo"></span>
                                    
                                    <?
                                    $totalIdiomas=count($conteudoIdiomas);
                                    $i=1;
                                    foreach ($conteudoIdiomas as $conteudoIdioma) {
                                        if ($i==1) {
                                            if ($i==$totalIdiomas) {
                                                $onView="onView";
                                                $separador="";
                                            } else {
                                                $onView="onView";
                                                $separador="<span class=\"separador\"></span>";	
                                            }
                                        } else {
                                            if ($i==$totalIdiomas and $i>1) {
                                                $onView="";
                                                $separador="";
                                            } else {
                                                $onView="";
                                                $separador="<span class=\"separador\"></span>";	
                                            }
                                        }
                                    ?>
                                        <button value="<? echo $conteudoIdioma["abreviatura"]; ?>" title="<? echo $conteudoIdioma["nome"]; ?>" name="institucional" class=" completo <? echo $onView; ?> <? echo $conteudoIdioma["class"]; ?>"><span><? echo $conteudoIdioma["nome"]; ?> - <? echo strtoupper($conteudoIdioma["abreviatura"]); ?></span></button>
                                        <? echo $separador; ?>
                                    <?
                                        $i++;
                                    }
                                    ?>                                
                                    
                                    <span class="borda fundo"></span>
                                </div>
                            </fieldset><!-- END menuButton -->
                        </div><!-- END collumB -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
                <!-- • • • • -->
                
                <div class="modulo upMidias Wfull" <? if ($tipoAcao=="incluir") { ?> style="display:none;"<? } ?>>
                	<div class="head">
                    	<button class="btnAB"><em>Imagem do Site</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("43");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                    	
                        <div class="boxAbas">
                        	<div class="menuAbas">
                            	<button value="abaIMAGEM" title="Imagens" class="abaView">
                                	<span></span>
                                    <em><span>Imagens</span></em>
                                    <span></span>
                                </button>
                            </div><!-- END menuAbas -->
                            
                            <!-- • • • • -->
                            <div class="parentAbas">
                                <!-- • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • • Aba IMAGENS -->
                                <div class="contAba colunas"><!-- nao pode passar ID para estas divs com a classe contAba -->
									<?
                                        $modelTextos=new textos_Model();
                                        echo $modelTextos->carregaTexto("44");
                                    ?>
                                    <input type="hidden" id="imgEdicao" value="0" class="698 440" /><!-- class=largura altura | value=1 mostra crop, 0 não mostra crop-->
                                    <div class="collumA">
                                        <div class="lista_selecionados">
                                        	<input type="file" name="imagem" id="imagem_upload" class="1"><!-- class = quantidade de arquivos -->
                                        </div><!-- END lista_selecionados -->
                                        
                                        <div style="display:none;" class="tempBox form"></div>
                                    </div><!-- END collumA -->
                                    
                                    <div class="collumB arquivosBloco">
                                    	<ol></ol>
                                    </div><!-- END collumB -->
                                    
                                    <!-- • • • • • • • • • • • EDITAR IMAGEM • • • -->
                                    <div style="display:none;" class="editArquivo edicaoIMAGEM form"></div>
                                </div><!-- END #abaIMAGENS -->
                                
                            </div><!-- END parentAbas -->
                            
                        </div><!-- END boxAbas -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
				</div><!-- END modulo -->
                
            </div><!-- END usuario -->
            
            <!-- • • • • -->
            
            <div id="footerPage">
            	<a href="<? echo $endereco_site; ?>/ack/sites" class="btnSeta voltarTopo" title="Voltar">Voltar</a>
                <button class="botao salvarVerde" title="Salvar" name="<? echo $tipoAcao; ?>" id="salvarSite"><span><var></var><em>Salvar</em></span><var class="borda"></var></button>
            </div><!-- END footerPage -->
            
        </div><!-- END wrappeACK-content -->
        
        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->
    
    <? include_once('_footer.php'); ?>
    
</div><!-- END wrapper -->

</body>
</html>