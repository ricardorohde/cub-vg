<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
    <? include_once('_header.php'); ?>
    
            <div id="breadcrumbs">
            	<ul>
                	<li><span><em>Sites Santa Clara</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            <!-- • • • • -->
            
            <div id="descricaoPagina">
            	<h2>Sites Santa Clara</h2>
				<?
                    $modelTextos=new textos_Model();
                    echo $modelTextos->carregaTexto("75");
                ?>
            </div><!-- END descricaoPagina -->
            
            <!-- • • • • -->
            
            <div class="parentFull sites">
            	<input type="hidden" class="dadosPagina" id="sites" />
                
                <div class="modulo listagem">
                	<div class="head">
                    	<button class="btnAB"><em>Sites</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("76");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                        <div class="boxBotoes">
                            <a href="<? echo $endereco_site; ?>/ack/sites/incluir" class="botao styleAdd_verde" title="Adicionar site"><span><var></var><em>Adicionar site</em></span><var class="borda"></var></a>
                            <button class="botao styleDell_vermelho" title="Excluir"><span><var></var><em>Excluir</em></span><var class="borda"></var></button>
                        </div><!-- END boxBotoes -->
                        
                    	<div class="lista listaSites" id="lista_sites">
                            <div class="header">
                                <span class="borda"></span>
                                <div>
                                    <div class="checkGrupo"><input type="checkbox" name="checkAll" /></div>
                                    <div class="titulo"><span>Título do site</span></div>
                                    <div class="urlSite"><span>URL site</span></div>
                                    <div class="ordem"><span>Ordem na lista</span></div>
                                    <div class="visivel"><span>Visível</span></div>
                                </div>
                                <span class="borda"></span>
                            </div><!-- END header -->
                            
                            <ol></ol>
                            
                            <button class="carregarMais" name="sites_especiais" title="Carregar mais resultados"><span class="borda esq"></span><em>Exibir mais resultados</em><span class="borda dir"></span></button>
                        </div><!-- END lista -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
            </div><!-- END parentFull -->
            
        </div><!-- END wrappeACK-content -->
        
        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->
    
    <? include_once('_footer.php'); ?>
    
</div><!-- END wrapper -->

</body>
</html>