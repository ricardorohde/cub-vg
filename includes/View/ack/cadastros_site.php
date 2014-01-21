<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <? include_once('_header.php'); ?>
              
            <div id="breadcrumbs">
            	<ul>
                    <li><span><em>Cadastros no site</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            <!-- • • • • -->
            
            <div id="descricaoPagina">
            	<h2>Cadastros no site</h2>
				<?
                    $modelTextos=new textos_Model();
                    echo $modelTextos->carregaTexto("82");
                ?>
            </div><!-- END descricaoPagina -->
            
            <!-- • • • • -->
            
            <div id="cadastrosSite" class="parentFull">
            	<input type="hidden" id="cadastros" class="dadosPagina" />
                
                <div class="modulo cadastrosSite listagem">
                	<div class="head">
                    	<button class="btnAB aberto"><em>Cadastros</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("83");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide filtro">
                    	<div class="boxBotoes">
                            <button title="Excluir cadastro" class="botao styleDell_vermelho" id="excluirCadastro"><span><var></var><em>Excluir</em></span><var class="borda"></var></button>
                        </div>
                        
                        <!-- • • • -->
                        
                    	<div class="collumA">
                            <div id="listaCadastros" class="lista">
                                <div class="header">
                                    <span class="borda"></span>
                                    <div>
                                        <div class="checkGrupo"><input type="checkbox" name="checkAll"></div>
                                        <div class="nome"><span>Nome</span></div>
                                        <div class="email"><span>E-mail</span></div>
                                    </div>
                                    <span class="borda"></span>
                                </div><!-- END header -->
                                
                                <!-- • • • -->
                                
                                <ol></ol>
                                
                                <!-- • • • -->
                                
                                <button name="cadastros" class="carregarMais" title="Carregar mais resultados"><span></span><em>Exibir mais resultados.</em><span></span></button>
                            </div><!-- END lista -->
                        </div><!-- END collumA -->
                        
                        <!-- • • • -->
                        
                        <div class="collumB form">
                        	<fieldset>
                            	<legend><em>Tipo do cadastro</em></legend>
                                
                                <div class="select usuarios">
                                    <select name="tipo">
                                        <option value="">Todos</option>
                                        <option value="1">Fisica</option>
                                        <option value="2">Juridica</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <!-- • • • • • -->
                            
                            <fieldset class="Pfisica">
                            	<legend><em>Sexo</em></legend>
                                
                                <div class="select sexo">
                                    <select name="sexo">
                                        <option value="">Todos</option>
                                        <option value="m">Masculino</option>
                                        <option value="f">Feminino</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset class="Pfisica">
                            	<legend><em>Estado civil</em></legend>
                                
                                <div class="select estadoCivil">
                                    <select name="est_civil">
                                        <option value="">Todos</option>
                                        <option value="solteiro">Solteiro(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorciado">Divorciado(a)</option>
                                        <option value="viuvo">Viúvo(a)</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset class="Pfisica">
                            	<legend><em>Faixa etária</em></legend>
                                
                                <div class="select faixaEtaria">
                                    <select name="faixa">
                                        <option value="">Todos</option>
                                        <option value="0-5">0 - 5 anos</option>
                                        <option value="6-10">6 - 10 anos</option>
                                        <option value="11-15">11 - 15 anos</option>
                                        <option value="16+">Mais de 16 anos</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <!-- • • • • • -->
                            
                            <fieldset class="Pjuridica">
                            	<legend><em>Tipo estabelecimento</em></legend>
                                
                                <div class="select tipoEstabelecimento">
                                    <select name="tipo_est">
                                        <option value="">Todos</option>
                                        <option value="1">Supermercado</option>
                                        <option value="2">Mini-Mercado</option>
                                        <option value="3">Confeitaria</option>
                                        <option value="4">Padaria</option>
                                        <option value="5">Loja de Convêniencia</option>
                                        <option value="6">Restaurante</option>
                                        <option value="7">Pizzaria</option>
                                        <option value="8">Hotel</option>
                                        <option value="9">Açougue</option>
                                        <option value="10">Outros</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset class="Pjuridica">
                            	<legend><em>Cliente Santa-clara</em></legend>
                                
                                <div class="select cliente">
                                    <select name="cliente">
                                        <option value="">Todos</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset class="Pjuridica">
                            	<legend><em>Já visitado por representante</em></legend>
                                
                                <div class="select jaVisitado">
                                    <select name="representante">
                                        <option value="">Todos</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <!-- • • • • • -->
                            
                            <fieldset>
                            	<legend><em>Estado</em></legend>
                                
                                <div class="select estado">
                                    <select name="estado">
                                        <option value="">Todos</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                            	<legend><em>Produtos de interesse</em></legend>
                                
                                <div class="select produtosInteresse">
                                    <select name="produtos">
                                        <option value="">Todos</option>
                                        <option value="leites">Leites</option>
                                        <option value="temper">Temper Cheese</option>
                                        <option value="manteiga">Manteiga</option>
                                        <option value="embutidos">Embutidos</option>
                                        <option value="queijos">Queijos</option>
                                        <option value="bebidas">Achocolatados e Bebidas Lácteas</option>
                                        <option value="cremeleite">Creme de Leite</option>
                                        <option value="carnes">Carnes</option>
                                        <option value="requeijao">Requeijão</option>
                                        <option value="doceleite">Doce de Leite </option>
                                        <option value="linhalight">Linha Light e Funcional</option>
                                        <option value="sobremesas">Sobremesas Lácteas</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                            	<legend><em>Informa-se sobre a Santa-Clara?</em></legend>
                                
                                <div class="select meioInforma">
                                    <select name="informa">
                                        <option value="">Todos</option>
                                        <option value="tv">TV</option>
                                        <option value="radio">Radio</option>
                                        <option value="jornal">Jornal</option>
                                        <option value="site">Site</option>
                                        <option value="newsletter">Newsletter</option>
                                        <option value="emfoco">Informativo Em Foco</option>
                                        <option value="outros">Outros</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                            <!--Esse aparece para qualquer tipo de cadastro-->
                            <fieldset>
                            	<legend><em>Quer receber os informativos?</em></legend>
                                
                                <div class="select receber">
                                    <select name="receber">
                                        <option value="">Todos</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </fieldset>
                            
                        </div><!-- END collumB -->
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
            </div><!-- END parentFull -->
            
            <!-- • • • -->
            
            <div id="footerPage">
            	<button name="exportar" title="Exportar lista" class="botao exportar"><span><var></var><em>Exportar lista</em></span><var class="borda"></var></button>
            </div><!-- END footerPage -->
            
        </div><!-- END wrappeACK-content -->
        
        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->
    
    <? include_once('_footer.php'); ?>

</div><!-- END wrapper -->
</body>
</html>