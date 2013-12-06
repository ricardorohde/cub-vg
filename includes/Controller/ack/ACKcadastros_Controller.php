<?php
class ACKcadastros_Controller
{
    function index () {
		protectedArea();
		openSession();
		verifyTimeSession();
		$dados=array();
		//Pega os dados do Site
		$modelSite=new site_Model();
		$dadosSite=$modelSite->dadosSite();
		$dados["dadosSite"]=$dadosSite;
		$dados["idioma"]=$modelSite->idiomasSite("1");

		//Pega os dados do Usuário
		$modelUser=new user_Model();
		$modelUser->userLevel("34",true);	
		$dados["dadosUserHeader"]=$modelUser->dataUser(array("email"=>$_SESSION["email"]));

		//Pega os dado dos tópicos
		$dados["tituloPagina"]="Cadastros no Site";
		loadView("ack/cadastros_site",$dados);
	}
	function excluir($dadosJSON) {
		postRequest();
		$dadosJSON=readJSON($_POST["ajaxACK"]);
		protectedArea();
		openSession();
		verifyTimeSession();
		$itens_lista=explode(",",$dadosJSON["itens_lista"]);
		
		$modelUser=new user_Model();
		$permissao_acesso=$modelUser->userLevel("34", false, "2");
		
		$total=0;
		$json["array"]=array();
		foreach ($itens_lista as $item) {
			dbDelete("cadastros", $item);
			array_push($json["array"], $item);
			$total++;
		}
		$json['status']=1;
		$json["total"]=$total;
		echo newJSON($json);
	}
    function editar ($dados) {
		$id=$dados[0];
		protectedArea();
		openSession();
		verifyTimeSession();
		$dados=array();
		
		//Pega os dados do Site
		$modelSite=new site_Model();
		$dadosSite=$modelSite->dadosSite();
		$dados["dadosSite"]=$dadosSite;
		
		//Pega os dados do Usuário
		$modelUser=new user_Model();
		$modelUser->userLevel("34",true);
		$permissao_acesso=$modelUser->userLevel("34",false,"2");	
		$dados["dadosUserHeader"]=$modelUser->dataUser(array("email"=>$_SESSION["email"]));
		
		//Pega os dados do Destaque
		$modelSantaClara=new santaClara_Model();
		$dados["dadosCadastro"]=$modelSantaClara->dataCadastro(array("id"=>$id));
		if (!$dados["dadosCadastro"]) {
			$dadosErro["erro"]=array("titulo"=>"CADASTRO NÃO EXISTE","conteudo"=>"O cadastro que você tentou acessar não existe ou foi excluído.","linkACK"=>true);
			loadView("__erro",$dadosErro);
			exit;
		}
		
		//Pega os dados das Metatags
		$dados["tituloPagina"]="Visualizar cadastro";
		loadView("ack/cadastro_site",$dados);
	}
	function exportar() {
		protectedArea();
		openSession();
		verifyTimeSession();
		$dadosJSON=readJSON($_POST["ajaxACK"],true);
		//Pega as categorias, caso existam
		if ($dadosJSON["categorias"]) {
			$categorias=$dadosJSON["categorias"];
		} else {
			$categorias=false;	
		}
		//Pega os dados do Site
		$modelSite=new site_Model();
		$dadosSite=$modelSite->dadosSite();
		(int)$limite=$dadosSite["itens_pagina"];
		$idioma=$modelSite->idiomasSite("1");

		//Chama o Model Geral para listar os cadastros
		$modelSantaClara=new santaClara_Model();
		$cadastros=$modelSantaClara->listaCadastros(0,99999999,false,$categorias);
		
		header("Content-type: text/csv, charset=UTF-8; encoding=UTF-8'");  
		header("Cache-Control: no-store, no-cache");  
		header('Content-Disposition: attachment; filename="cadastros.csv"');  

		//Imprime o cabeçalho
		echo "Nome,Email,Tipo de Pessoa,Tipo Estabelecimento,Checkouts,Cliente Santa Clara, Visitado Representante, Sexo, Data de Nascimento, Telefone, Endereço, Complemento, Bairro, CEP, Cidade, UF, Profissão, Estado Civil, Filhos, Faixa Etária, Produtos de Interesse, Conheceu Santa Clara, Receber News, Receber News Confraria, Data de Adesão\n";
		
		//Imprime os registros
		foreach ($cadastros as $cadastro) {
			//Tipo de Pessoa
			if ($cadastro["tipo"]=="1") {
				$tipo="Pessoa Física";
			} elseif ($cadastro["tipo"]=="2") {
				$tipo="Pessoa Jurídica";
			}
			//Tipo de Estabelecimento
			if ($cadastro["tipo_est"]=="1") {
				$tipo_est="Supermercado";
			} elseif ($cadastro["tipo_est"]=="2") {
				$tipo_est="Mini-Mercado";
			} elseif ($cadastro["tipo_est"]=="3") {
				$tipo_est="Confeitaria";
			} elseif ($cadastro["tipo_est"]=="4") {
				$tipo_est="Padaria";
			} elseif ($cadastro["tipo_est"]=="5") {
				$tipo_est="Loja de Convêniencia";
			} elseif ($cadastro["tipo_est"]=="6") {
				$tipo_est="Restaurante";
			} elseif ($cadastro["tipo_est"]=="7") {
				$tipo_est="Pizzaria";
			} elseif ($cadastro["tipo_est"]=="8") {
				$tipo_est="Hotel";
			} elseif ($cadastro["tipo_est"]=="9") {
				$tipo_est="Açougue";
			} elseif ($cadastro["tipo_est"]=="10") {
				$tipo_est="Outros";
			}
			//Cliente Santa Clara
			if ($cadastro["cliente"]=="1") {
				$cliente="Sim";
			} else {
				$cliente="Não";
			}
			//Visitado Representante
			if ($cadastro["representante"]=="1") {
				$representante="Sim";
			} else {
				$representante="Não";
			}
			//Sexo
			if ($cadastro["sexo"]=="m") {
				$sexo="Masculino";
			} elseif ($cadastro["sexo"]=="f") {
				$sexo="Feminino";
			} elseif ($cadastro["sexo"]=="e") {
				$sexo="Empresa";
			}
			//Estado Civil
			if ($cadastro["est_civil"]=="solteiro" or $cadastro["est_civil"]=="2") {
				$est_civil="Solteiro(a)";
			} elseif ($cadastro["est_civil"]=="casado"or $cadastro["est_civil"]=="1") {
				$est_civil="Casado(a)";
			} elseif ($cadastro["est_civil"]=="divorciado" or $cadastro["est_civil"]=="4") {
				$est_civil="Divorciado(a)";
			} elseif ($cadastro["est_civil"]=="viuvo" or $cadastro["est_civil"]=="3") {
				$est_civil="Viúvo(a)";
			}
			//Receber News
			if ($cadastro["receber"]=="1") {
				$receber="Sim";
			} else {
				$receber="Não";
			}
			//Receber News Gourmer
			if ($cadastro["receber_gourmet"]=="1") {
				$receber_gourmet="Sim";
			} else {
				$receber_gourmet="Não";
			}
			echo $cadastro["nome"].",".$cadastro["email"].",".$tipo.",".$tipo_est.",".$cadastro["checkouts"].",".$cliente.",".$representante.",".$sexo.",".convertDate($cadastro["nascimento"], "%d-%m-%Y").",".$cadastro["telefone"].",".$cadastro["endereco"].",".$cadastro["complemento"].",".$cadastro["bairro"].",".$cadastro["cep"].",".$cadastro["cidade"].",".$cadastro["estado"].",".$cadastro["profissao"].",".$est_civil.",".$cadastro["filhos"].",".$cadastro["faixa"].",".$cadastro["produtos"].",".$cadastro["informa"].",".$receber.",".$receber_gourmet.",".convertDate($cadastro["adesao"],"%d-%m-%Y")."\n";
		}			
	}
}
?>