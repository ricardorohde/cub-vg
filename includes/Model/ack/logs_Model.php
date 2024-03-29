<?php
class logs_Model {	
	function lastUpdate() {
		// Executa o comando no banco de dados
		global $db;
		$mysql = $db->prepare('SELECT logs.*, usuarios.nome AS usuario
								FROM logs, usuarios
								WHERE acao="incluiu"
								OR acao="excluiu"
								OR acao="editou"
								AND logs.usuario=usuarios.id
								ORDER BY data DESC
								LIMIT 1;');
		$mysql->execute();
		$retorno = $mysql->fetchAll();
		if (count($retorno)>0) {
			return $retorno[0];
		} else {
			return false;
		}
	}
	function salvar($acao, $tabela, $id_afetado, $sql, $texto_log=false ) {
		openSession ();
		if (!$texto_log) {
			if ($tabela=="usuarios") {
				$tipo_dado="o usuário";
				$modelUser=new user_Model();
				$infosUser=$modelUser->dataUser(array("id"=>$id_afetado));
				$dado=$infosUser["nome"];
			} elseif ($tabela=="permissoes") {
				$tipo_dado="as permissões de acesso de";
				global $db;
				$mysql = $db->prepare('SELECT usuarios.nome
										FROM permissoes, usuarios
										WHERE permissoes.id="'.$id_afetado.'"
										AND usuarios.id=permissoes.usuario;');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["nome"];
			} elseif ($tabela=="enderecos") {
				$tipo_dado="o endereço";
				$dado="do site";
			} elseif ($tabela=="metatags") {
				$tipo_dado="as metatags de";
				global $db;
				$mysql = $db->prepare('SELECT *	FROM metatags WHERE id="'.$id_afetado.'"');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$mysql = $db->prepare('SELECT *	FROM '.$retorno[0]["tabela"].' WHERE id="'.$retorno[0]["item"].'"');
				$mysql->execute();
				$retornoFinal = $mysql->fetchAll();
				if ($retorno[0]["tabela"]=="sistema") {
					$dado=$retorno[0]["tabela"]." em ".$retornoFinal[0]["nome_site"];
				} else {
					$dado=$retorno[0]["tabela"]." em ".$retornoFinal[0]["nome_pt"];
				}
			} elseif ($tabela=="sistema") {
				$tipo_dado="as configurações do";
				$dado="site";
			} elseif ($tabela=="idiomas") {
				$tipo_dado="a visibilidade do idioma";
				global $db;
				$mysql = $db->prepare('SELECT * FROM idiomas WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["nome"];
			} elseif ($tabela=="destaques") {
				$tipo_dado="o destaque";
				global $db;
				$mysql = $db->prepare('SELECT * FROM destaques WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="modulos") {
				$tipo_dado="o módulo";
				global $db;
				$mysql = $db->prepare('SELECT * FROM modulos WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="intitucional") {
				$tipo_dado="o texto institucional";
				global $db;
				$mysql = $db->prepare('SELECT * FROM institucional WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="categorias") {
				$tipo_dado="a categoria";
				global $db;
				$mysql = $db->prepare('SELECT * FROM categorias WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="produtos") {
				$tipo_dado="o produto";
				global $db;
				$mysql = $db->prepare('SELECT * FROM produtos WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="noticias") {
				$tipo_dado="a notícia";
				global $db;
				$mysql = $db->prepare('SELECT * FROM noticias WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="contatos") {
				$tipo_dado="o contato enviado por";
				global $db;
				$mysql = $db->prepare('SELECT * FROM contatos WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["remetente"];
			} elseif ($tabela=="contatosimprensa") {
				$tipo_dado="o contato enviado por";
				global $db;
				$mysql = $db->prepare('SELECT * FROM contatosimprensa WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["remetente"];
			} elseif ($tabela=="newsletter") {
				$tipo_dado="na lista de newsletter o e-mail de";
				global $db;
				$mysql = $db->prepare('SELECT * FROM newsletter WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["nome"];
			} elseif ($tabela=="sites") {
				$tipo_dado="o Site Santa Clara";
				global $db;
				$mysql = $db->prepare('SELECT * FROM sites WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="cadastros") {
				$tipo_dado="o cadastro de";
				global $db;
				$mysql = $db->prepare('SELECT * FROM cadastros WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["nome"];
			} elseif ($tabela=="feiras") {
				$tipo_dado="a feira";
				global $db;
				$mysql = $db->prepare('SELECT * FROM feiras WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="setores") {
				$tipo_dado="o setor de contato";
				global $db;
				$mysql = $db->prepare('SELECT * FROM setores WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="revistas") {
				$tipo_dado="a revista EmFoco";
				global $db;
				$mysql = $db->prepare('SELECT * FROM revistas WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="gourmetreceitas") {
				$tipo_dado="a receita";
				global $db;
				$mysql = $db->prepare('SELECT * FROM gourmetreceitas WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="gourmetdicassegredos") {
				$tipo_dado="a dica/segredo";
				global $db;
				$mysql = $db->prepare('SELECT * FROM gourmetdicassegredos WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="gourmetentrevistas") {
				$tipo_dado="a entrevista de";
				global $db;
				$mysql = $db->prepare('SELECT * FROM gourmetentrevistas WHERE id="'.$id_afetado.'";');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=$retorno[0]["titulo_pt"];
			} elseif ($tabela=="crops") {
				$tipo_dado="o crop de uma imagem em";
				global $db;
				$mysql = $db->prepare('SELECT modulos.modulo FROM crops, modulos WHERE crops.id="'.$id_afetado.'" AND modulos.id=crops.modulo;');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=ucfirst($retorno[0]["modulo"]);
			} elseif ($tabela=="fotos") {
				$tipo_dado="uma foto em";
				global $db;
				$mysql = $db->prepare('SELECT modulos.modulo FROM fotos, modulos WHERE fotos.id="'.$id_afetado.'" AND modulos.id=fotos.modulo;');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=ucfirst($retorno[0]["modulo"]);
			} elseif ($tabela=="anexos") {
				$tipo_dado="um anexo em";
				global $db;
				$mysql = $db->prepare('SELECT modulos.modulo FROM anexos, modulos WHERE anexos.id="'.$id_afetado.'" AND modulos.id=anexos.modulo;');
				$mysql->execute();
				$retorno = $mysql->fetchAll();
				$dado=ucfirst($retorno[0]["modulo"]);
			}
			$texto_log="O usuário ".$_SESSION["nome"]." ".$acao." ".$tipo_dado." ".$dado;
		}
		$dadosLog["resultados"]=array("usuario"=>$_SESSION["id"],"acao"=>$acao,"tabela"=>$tabela,"id_afetado"=>$id_afetado,"texto_log"=>$texto_log,"instrucao_sql"=>$sql);
		dbSave("logs",$dadosLog); 
	}
	function listaLogs($apartir=false,$limite=false,$filtros=false,$verificaBotao=true) {
		$apartir=" LIMIT ".$apartir.", ";
		if (!$limite) {
			$modelSite=new site_Model();
			$dadosSite=$modelSite->dadosSite();
			$limite=$dadosSite["itens_pagina"];
		}
		if ($verificaBotao) {
			$limite++;
		}
		if ($filtros) {
			$arrayColunas = array_keys($filtros); // Pega as chaves do array
			$colunas=implode(",", $arrayColunas); // Separa as chaves do array e coloca elas separadas com vírgula para definir as colunas
			
			// Separa as chaves do array e coloca elas separadas por dois pontos e vírgula para definir a variável PDO dos valores
			$valores=array();
			foreach ($arrayColunas as $valColunas) {
				if ($valColunas=="periodo") {
					array_push($valores, " data<=NOW() AND data>='".$filtros[$valColunas]."'");
				} else {
					array_push($valores, $valColunas."='".$filtros[$valColunas]."'");
				}
			}
			$where=implode("AND", $valores);
			$where="WHERE ".$where;
		} else {
			$where="";
		}
		// Executa o comando no banco de dados
		global $db;
		$mysql = $db->prepare('SELECT * FROM logs '.$where.' ORDER BY id DESC '.$apartir.$limite.';');
		$mysql->execute();
		$retorno = $mysql->fetchAll();
		if (count($retorno)>0) {
			return $retorno;
		} else {
			return false;
		}
	}
}
?>