<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<? include_once('_header.php'); ?>
    
            <div id="breadcrumbs">
            	<ul>
                	<li><a href="<? echo $endereco_site; ?>/ack/enderecos" title="Postos RodOil"><em>Endereços</em></a></li>
                	<li><span><em>Endereços</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            
            <div id="descricaoPagina">
            	<h2>Endereços</h2>
				<?
                    $modelTextos=new ACKtextos_Model();
                    echo $modelTextos->carregaTexto("168");
                ?>
            </div><!-- END descricaoPagina -->
            
            
            <div class="parentFull">
            	<input type="hidden" class="dadosPagina" id="enderecos" />
                
                <div class="modulo listagem">
                	<div class="head">
                    	<div class="boxBotoes">
                            <a href="<? echo $endereco_site; ?>/ack/enderecos/incluir" class="botao add" title="Adicionar endereço"><span><var></var><em>Adicionar endereço</em></span><var class="borda"></var></a>
                            <button class="botao excluir" title="Excluir endereço"><span><var></var><em>Excluir</em></span><var class="borda"></var></button>
                        </div>
                        
                    	<button class="btnAB"><em>Endereços</em></button>
						<?
                            $modelTextos=new ACKtextos_Model();
                            echo $modelTextos->carregaTexto("185");
                        ?>
                    </div><!-- END head -->
                    
                    <div id="enderecos" class="slide list_enderecos">
                    	<div class="lista enderecos" id="enderecos">
                            <div class="header">
                                <span class="borda"></span>
                                <div>
                                    <div class="checkGrupo"> <input type="checkbox" name="checkAll" /></div>
                                    <div class="nome"><button><em>Nome</em></button></div>
                                    <div class="email"><button><em>E-mail</em></button></div>
                                    <div class="ordem normal"><button><em>Ordenação</em></button></div>
                                    <div class="visivel"><button><em>Visível</em></button></div>
                                </div>
                                <span class="borda"></span>
                            </div><!-- END header -->
                            
                            <ol></ol>
                            
                            <button class="carregarMais" title="Carregar mais resultados" name="enderecos"><span class="borda esq"></span><em>Exibir mais resultados</em><span class="borda dir"></span></button>
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