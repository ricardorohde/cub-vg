<?php
class ACKsites_Controller
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

		//Pega os dados do Usuário
		$modelUser=new user_Model();
		$modelUser->userLevel("33",true);	
		$dados["dadosUserHeader"]=$modelUser->dataUser(array("email"=>$_SESSION["email"]));

		//Pega os dado dos tópicos
		$dados["tituloPagina"]="Sites Santa Clara";
		loadView("ack/sites",$dados);
	}
	function excluir($dadosJSON) {
		postRequest();
		$dadosJSON=readJSON($_POST["ajaxACK"]);
		protectedArea();
		openSession();
		verifyTimeSession();
		$itens_lista=explode(",",$dadosJSON["itens_lista"]);
		
		$modelUser=new user_Model();
		$permissao_acesso=$modelUser->userLevel("33", false, "2");
		
		$total=0;
		$json["array"]=array();
		foreach ($itens_lista as $item) {
			dbDelete("sites", $item);
			array_push($json["array"], $item);
			$total++;
		}
		$json['status']=1;
		$json["total"]=$total;
		echo newJSON($json);
	}
    function incluir () {
		protectedArea();
		openSession();
		verifyTimeSession();
		$dados=array();
		//Pega os dados do Site
		$modelSite=new site_Model();
		$dadosSite=$modelSite->dadosSite();
		$dados["dadosSite"]=$dadosSite;
		$dados["plugins"]=true;
		$dados["conteudoIdiomas"]=$modelSite->idiomasSite();

		//Pega os dados do Usuário
		$modelUser=new user_Model();
		$modelUser->userLevel("33",false,"2");	
		$dados["dadosUserHeader"]=$modelUser->dataUser(array("email"=>$_SESSION["email"]));

		//Carrega a View
		$dados["dadosSite"]=false;
		$dados["tipoAcao"]="incluir";
		$dados["tituloPagina"]="Adicionar Site Santa Clara";
		$dados["plugins"]=true;
		loadView("ack/site",$dados);
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
		$visitasSite=$modelSite->visitasSite();
		$dados["conteudoIdiomas"]=$modelSite->conteudoIdioma("destaques",$id,"titulo");
		$dados["dadosSite"]=$dadosSite;
		
		//Pega os dados do Usuário
		$modelUser=new user_Model();
		$modelUser->userLevel("33",true);
		$permissao_acesso=$modelUser->userLevel("33",false,"2");	
		$dados["dadosUserHeader"]=$modelUser->dataUser(array("email"=>$_SESSION["email"]));
		
		//Pega os dados do Destaque
		$modelSantaClara=new santaClara_Model();
		$dados["dadosSite"]=$modelSantaClara->dataSite(array("id"=>$id));
		if (!$dados["dadosSite"]) {
			$dadosErro["erro"]=array("titulo"=>"SITE NÃO EXISTE","conteudo"=>"O site que você tentou acessar não existe ou foi excluído.","linkACK"=>true);
			loadView("__erro",$dadosErro);
			exit;
		}
		
		//Pega os dados das Metatags
		$dados["plugins"]=true;
		$dados["tipoAcao"]="editar";
		$dados["tituloPagina"]="Editar Site Santa Clara";
		loadView("ack/site",$dados);
	}
	function salvar() {
		postRequest();
		$dadosJSON=readJSON($_POST["ajaxACK"]);
		protectedArea();
		openSession();
		verifyTimeSession();
		
		$modelUser=new user_Model();
		$permissao_acesso=$modelUser->userLevel("33",false,"2");	

		if ($dadosJSON["acao"]=="incluir") {
			//Salva o Tópico
			$dados["resultados"]=$dadosJSON["sites"];
			$dados["resultados"]["visivel"]=$dadosJSON["visivel"];
			$dados["resultados"]["status"]="1";
			$ordem = proximaOrdem("sites", array("status"=>"1"));
			$dados["resultados"]["ordem"]=$ordem;
			$idItem=dbSave("sites",$dados,true);
		
			//Gera os retornos do JSON
			$json['status'] = 1;
			$json['id'] = $idItem;
			echo newJSON($json);
		} elseif ($dadosJSON["acao"]=="editar") {
			// Salva o tópico
			$dados["resultados"]=$dadosJSON["sites"];
			$dados["resultados"]["visivel"]=$dadosJSON["visivel"];
			dbUpdate("sites", $dados);
			
			//Gera o retorno do JSON
			$json['status'] = 1;
			echo newJSON($json);
		}
	}
}
?>