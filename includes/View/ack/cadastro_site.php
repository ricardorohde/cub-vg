<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

    <? include_once('_header.php'); ?>
                         
            <div id="breadcrumbs">
            	<a title="Voltar" class="btnSeta voltarTopo" href="<? echo $endereco_site; ?>/ack/cadastros">Voltar</a>
                
            	<ul>
                	<li><a title="Cadastros no site" href="<? echo $endereco_site; ?>/ack/cadastros"><em>Cadastros no site</em></a></li>
                	<li><span><em>Visualizar Cadastro</em></span></li>
                </ul>
            </div><!-- END breadcrumbs -->
            
            <!-- • • • -->
            
            <div id="descricaoPagina">
            	<h2>Visualizar cadastro</h2>
				<?
                    $modelTextos=new textos_Model();
                    echo $modelTextos->carregaTexto("79");
                ?>
            </div><!-- END descricaoPagina -->
            
            <!-- • • • -->
            
            <div class="parentFull cadastro">
            	<input type="hidden" id="cadastros" class="dadosPagina" value="<? echo $dadosCadastro["id"]; ?>" />
            
                <div class="modulo contTexto">
                	<div class="head">
                    	<button class="btnAB"><em>Dados gerais do cadastro</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("80");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                    	<ul>
                            <li><p><b>Nome:    </b> <? echo $dadosCadastro["nome"]; ?></p></li>
                            <li><p><b>E-mail:  </b> <? echo $dadosCadastro["email"]; ?></p></li>
                            <li><p><b>Adesão:  </b> <? echo convertDate ($dadosCadastro["adesao"], "%d-%m-%Y"); ?></p></li>
                            <li><p><b>Senha:   </b> •••••</p> <button title="Enviar nova senha" class="alterarSenha"><em>Enviar nova senha</em></button></li>
                            <!-- • • • -->
                            <li><p><b>Telefone:</b> <? echo $dadosCadastro["telefone"]; ?></p></li>
                            <li><p><b>Endereço:</b> <? echo $dadosCadastro["endereco"]; ?></p></li>
                            <? if ($dadosCadastro["complemento"]) { ?><li><p><b>Complemento:</b> <? echo $dadosCadastro["complemento"]; ?></p></li><? } ?>
                            <li><p><b>Bairro:</b> <? echo $dadosCadastro["bairro"]; ?></p></li>
                            <li><p><b>CEP:</b> <? echo $dadosCadastro["cep"]; ?></p></li>
                            <li><p><b>Cidade/UF:</b> <? echo $dadosCadastro["cidade"]; ?>/<? echo $dadosCadastro["estado"]; ?></p></li>
                            <!-- • • • -->
                            
                            <? if ($dadosCadastro["tipo"]=="1") { ?>
                            <!-- • • • -->
                            <li><p><b>Sexo:               </b> <? if ($dadosCadastro["sexo"]=="m") { echo "Masculino"; } elseif ($dadosCadastro["sexo"]=="f") { echo "Feminino"; } ?></p></li>
                            <li><p><b>Data de nascimento: </b> <? echo convertDate ($dadosCadastro["data_nascimento"], "%d-%m-%Y"); ?></p></li>
                            <li><p><b>Profissão:          </b> <? echo $dadosCadastro["profissao"]; ?></p></li>
                            <li><p><b>Estado Civil:       </b>
								<?
								if ($dadosCadastro["est_civil"]=="solteiro" or $dadosCadastro["est_civil"]=="2") {
									echo "Solteiro(a)";
								} elseif ($dadosCadastro["est_civil"]=="casado"or $dadosCadastro["est_civil"]=="1") {
									echo "Casado(a)";
								} elseif ($dadosCadastro["est_civil"]=="divorciado" or $dadosCadastro["est_civil"]=="4") {
									echo "Divorciado(a)";
								} elseif ($dadosCadastro["est_civil"]=="viuvo" or $dadosCadastro["est_civil"]=="3") {
									echo "Viúvo(a)";
								}
								?></p></li>
                            <li><p><b>Nº de filhos:       </b> <? echo $dadosCadastro["filhos"]; ?></p></li>
                            <li><p><b>Faixa etária:       </b>
								<?
								if ($dadosCadastro["faixa"]=="0-5") {
									echo "0 - 5 anos";
								} elseif ($dadosCadastro["faixa"]=="6-10") {
									echo "6 - 10 anos";
								} elseif ($dadosCadastro["faixa"]=="11-15") {
									echo "11 - 15 anos";
								} elseif ($dadosCadastro["faixa"]=="16+") {
									echo "Mais de 16 anos";
								}
								?></p></li>
                            <? } ?>
                            <? if ($dadosCadastro["tipo"]=="2") { ?>
                            <!-- • • • -->
                            <li><p><b>Tipo estabelecimento: </b>
								<?
								if ($dadosCadastro["tipo_est"]=="1") {
									echo "Supermercado";
								} elseif ($dadosCadastro["tipo_est"]=="2") {
									echo "Mini-Mercado";
								} elseif ($dadosCadastro["tipo_est"]=="3") {
									echo "Confeitaria";
								} elseif ($dadosCadastro["tipo_est"]=="4") {
									echo "Padaria";
								} elseif ($dadosCadastro["tipo_est"]=="5") {
									echo "Loja de Convêniencia";
								} elseif ($dadosCadastro["tipo_est"]=="6") {
									echo "Restaurante";
								} elseif ($dadosCadastro["tipo_est"]=="7") {
									echo "Pizzaria";
								} elseif ($dadosCadastro["tipo_est"]=="8") {
									echo "Hotel";
								} elseif ($dadosCadastro["tipo_est"]=="9") {
									echo "Açougue";
								} elseif ($dadosCadastro["tipo_est"]=="10") {
									echo "Outros";
								}
								?></p></li>
                            <li><p><b>Cliente Santa Clara?  </b> <? if ($dadosCadastro["cliente"]=="1") { echo "Sim"; } elseif ($dadosCadastro["cliente"]=="0") { echo "Não"; } ?></p></li>
                            <li><p><b>Visitado por Representante?</b> <? if ($dadosCadastro["representante"]=="1") { echo "Sim"; } elseif ($dadosCadastro["representante"]=="0") { echo "Não"; } ?></p></li>
                            <li><p><b>Nº de checkts:        </b>
								<?
								if ($dadosCadastro["checkouts"]=="5") {
									echo "Até 5";
								} elseif ($dadosCadastro["checkouts"]=="6-10") {
									echo "De 6 a 10";
								} elseif ($dadosCadastro["checkouts"]=="11-15") {
									echo "De 11 a 15";
								} elseif ($dadosCadastro["checkouts"]=="15") {
									echo "Acima de 15";
								}
								?></p></li>
                            <!-- • • • -->
                            <? } ?>
                        </ul>
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo -->
                
                <!-- • • • -->
                
                <div class="modulo contTexto">
                	<div class="head">
                    	<button class="btnAB"><em>Outras informações</em></button>
						<?
                            $modelTextos=new textos_Model();
                            echo $modelTextos->carregaTexto("81");
                        ?>
                    </div><!-- END head -->
                    
                    <div class="slide">
                    	<ul>
                        	<!-- • • • • -->
                            <li><p><b>Receber News?</b> <? if ($dadosCadastro["receber"]=="1") { echo "Sim"; } elseif ($dadosCadastro["receber"]=="0") { echo "Não"; } ?></p></li>
                            <li><p><b>Receber News Gourmet?</b> <? if ($dadosCadastro["receber_gourmet"]=="1") { echo "Sim"; } elseif ($dadosCadastro["receber_gourmet"]=="0") { echo "Não"; } ?></p></li>
                            <!-- • • • • -->
                            
                        	<li>
                            	<p><b>Produtos de interesse: </b></p>
                                <ol>
                                	<? 
										$interesses=explode(";", $dadosCadastro["produtos"]);
										foreach ($interesses as $interesse) {
											if ($interesse=="leites") {
												echo "<li><em>Leites</em></li>";
											} elseif ($interesse=="queijos") {
												echo "<li><em>Queijos</em></li>";
											} elseif ($interesse=="requeijao") {
												echo "<li><em>Requeijão</em></li>";
											} elseif ($interesse=="temper") {
												echo "<li><em>Temper Cheese</em></li>";
											} elseif ($interesse=="bebidas") {
												echo "<li><em>Achocolatados e Bebidas Lácteas</em></li>";
											} elseif ($interesse=="doceleite") {
												echo "<li><em>Doce de Leite</em></li>";
											} elseif ($interesse=="manteiga") {
												echo "<li><em>Manteiga</em></li>";
											} elseif ($interesse=="cremeleite") {
												echo "<li><em>Creme de Leite</em></li>";
											} elseif ($interesse=="linhalight") {
												echo "<li><em>Linha Light e Funcional</em></li>";
											} elseif ($interesse=="embutidos") {
												echo "<li><em>Embutidos</em></li>";
											} elseif ($interesse=="carnes") {
												echo "<li><em>Carnes</em></li>";
											} elseif ($interesse=="sobremesas") {
												echo "<li><em>Sobremesas Lácteas</em></li>";
											}
										}
									?>
                                </ol>
                            </li>
                            
                            <li>
                            	<p><b>Qual é o meio que se informa sobre a Santa Clara?</b></p>
                                <ol>
                                	<? 
										$informes=explode(";", $dadosCadastro["informa"]);
										foreach ($informes as $informe) {
											if ($informe=="tv") {
												echo "<li><em>TV</em></li>";
											} elseif ($informe=="radio") {
												echo "<li><em>Rádio</em></li>";
											} elseif ($informe=="jornal") {
												echo "<li><em>Jornal</em></li>";
											} elseif ($informe=="site") {
												echo "<li><em>Site</em></li>";
											} elseif ($informe=="newsletter") {
												echo "<li><em>Newsletter</em></li>";
											} elseif ($informe=="emfoco") {
												echo "<li><em>Informativo Em Foco</em></li>";
											} elseif ($informe=="outros") {
												echo "<li><em>Outros</em></li>";
											}
										}
									?>
                                </ol>
                            </li>
                        </ul>
                        
                        <span class="clearBoth"></span>
                    </div><!-- END slide -->
                </div><!-- END modulo  -->
                
            </div><!-- END usuario -->
            
            <!-- • • • -->
            
            <div id="footerPage">
                <a title="Voltar" class="btnSeta voltarTopo" href="<? echo $endereco_site; ?>/ack/cadastros">Voltar</a>
            </div><!-- END footerPage -->
            
        </div><!-- END wrappeACK-content -->
        
        <div class="borda fundo"></div>
    </div><!-- END wrappeACK -->
    
    <? include_once('_footer.php'); ?>
    
</div><!-- END wrapper -->
</body>
</html>