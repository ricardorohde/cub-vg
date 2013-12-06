<?

header('Cache-Control: max-age=3600, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s ",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s ",time()+3600)." GMT");

$ajaxACK = $_POST['ajaxACK'];
$ajaxACK = stripslashes($ajaxACK);
$ajaxACK = json_decode($ajaxACK, true);



# escritorio
if ($ajaxACK['sessao'] == 'escritorio') {
	$retorno = array(
		'escritorio'=>array(
			0=>array(
				'titulo'=>'Escritório de Arquitetura',
				'texto'=>'
					<p>Consectetur in bresaola, tri-tip pork veniam salami sed. Shankle reprehenderit fugiat, consectetur ut incididunt proident beef jerky ground round. Beef aute venison, commodo beef ribs laborum bresaola et meatball ut shankle mollit salami cillum nulla. Pariatur short ribs flank, venison non repreh enderit ullamco biltong esse exercitation corned beef frankfurter eu. Pork loin spare ribs pork chop jerky, qui beef veniam consequat incididunt short ribs beef ribs ham hock. Ground round chicken pastrami ex ball tip meatloaf. Ex do salami brisket, tempor spare ribs consectetur veniam proident nostrud ut andouille flank.</p>
					<p>Nostrud pork belly labore, do culpa beef tenderloin strip steak incididunt sunt. Pork loin ham hock labore anim jerky pork chop non spare ribs minim, andouille dolor fatback sint proident reprehenderit. In occaecat biltong t-bone in eiusmod.</p>
				',
				'imagens'=>array(
					'plugins/thumb/phpThumb.php?src=../../galeria/sobre.jpg&w=380&h=363&zc=1'
				),
				'videos'=>array(
					'C_Ng4s-a6eQ',
				)
			),
			1=>array(
				'titulo'=>'Arq. Vanessa Guerra',
				'texto'=>'
					<p>Consectetur in bresaola, tri-tip pork veniam salami sed. Shankle reprehenderit fugiat, consectetur ut incididunt proident beef jerky ground round. Beef aute venison, commodo beef ribs laborum bresaola et meatball ut shankle mollit salami cillum nulla. Pariatur short ribs flank, venison non repreh enderit ullamco biltong esse exercitation corned beef frankfurter eu. Pork loin spare ribs pork chop jerky, qui beef veniam consequat incididunt short ribs beef ribs ham hock. Ground round chicken pastrami ex ball tip meatloaf. Ex do salami brisket, tempor spare ribs consectetur veniam proident nostrud ut andouille flank.</p>
				',
				'imagens'=>array(
					'plugins/thumb/phpThumb.php?src=../../galeria/galeria/galeria_trabalhos/trabalho_01.jpg&w=230&h=220&zc=1'
				),
				'videos'=>array(
					'C_Ng4s-a6eQ'
				)
			)
		)
	);
}



# categorias
if ($ajaxACK['sessao'] == 'projetos') {
	$retorno = array(
		'menu'=>array(
			0=>array(
				'id'=>1,
				'titulo'=>'Categoria 1',
				'furl'=>'categoria-1'
			),
			1=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2'
			),
			2=>array(
				'id'=>3,
				'titulo'=>'Categoria 3',
				'furl'=>'categoria-3'
			)
		),
		'categorias'=>array(
			0=>array(
				'id'=>1,
				'titulo'=>'Categoria 1',
				'furl'=>'categoria-1',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			1=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			2=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			3=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			4=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			5=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			6=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			7=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			8=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			),
			9=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1'
			)
		)
	);
}



# categoria / busca
if ($ajaxACK['sessao'] == 'categoria' || $ajaxACK['sessao'] == 'busca') {
	$retorno = array(
		'menu'=>array(
			0=>array(
				'id'=>1,
				'titulo'=>'Categoria 1',
				'furl'=>'categoria-1'
			),
			1=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'Categoria-2'
			),
			2=>array(
				'id'=>3,
				'titulo'=>'Categoria 3',
				'furl'=>'Categoria-3'
			)
		),
		'projetos'=>array(
			0=>array(
				'id'=>1,
				'titulo'=>'Apartamento 1',
				'furl'=>'apartamento-1',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1',
				'categoria'=>array(
					'id'=>1,
					'titulo'=>'Categoria 1',
					'furl'=>'categoria-1'
				)
			),
			1=>array(
				'id'=>2,
				'titulo'=>'Apartamento 2',
				'furl'=>'apartamento-2',
				'imagem'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=295&h=165&zc=1',
				'categoria'=>array(
					'id'=>2,
					'titulo'=>'Categoria 2',
					'furl'=>'categoria-2'
				)
			)
		)
	);
}



# projeto (detalhe)
if ($ajaxACK['sessao'] == 'projeto') {
	$retorno = array(
		'menu'=>array(
			0=>array(
				'id'=>1,
				'titulo'=>'Categoria 1',
				'furl'=>'categoria-1'
			),
			1=>array(
				'id'=>2,
				'titulo'=>'Categoria 2',
				'furl'=>'categoria-2'
			),
			2=>array(
				'id'=>3,
				'titulo'=>'Categoria 3',
				'furl'=>'categoria-3'
			)
		),
		'item'=>array(
			'id'=>1,
			'titulo'=>'Apartamento 1',
			'furl'=>'apartamento-1',
			'texto'=>'<p>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>',
			'categoria'=>array(
				'id'=>1,
				'titulo'=>'Categoria 1',
				'furl'=>'categoria-1'
			),
			'fotos'=>array(
				0=>array(
					'foto'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=944&h=580',
					'thumb'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=140&h=86&zc=1',
					'legenda'=>'legendaaaaaaa'
				),
				1=>array(
					'foto'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=944&h=580',
					'thumb'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=140&h=86&zc=1',
					'legenda'=>'legendaaaaaaa'
				)
			),
			'videos'=>array(
				0=>array(
					'video'=>'43127008',
					'tipo'=>'vimeo',
					'thumb'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=140&h=86&zc=1',
					'legenda'=>'legendaaaaaaa'
				),
				1=>array(
					'video'=>'C_Ng4s-a6eQ',
					'tipo'=>'youtube',
					'thumb'=>'plugins/thumb/phpThumb.php?src=../../galeria/galeria_trabalhos/trabalho_01.jpg&w=140&h=86&zc=1',
					'legenda'=>'legendaaaaaaa'
				)
			)
		)
	);
}



# contato
if ($ajaxACK['sessao'] == 'contato') {
	$retorno = array(
		'telefone' => '54 3035.2002',
		'endereco' => 'Rua Júlio de Castilhos, 651 - Sala 501, Centro<br>Farroupilha - RS',
		'mapa' => 'http://maps.google.com.br/maps?q=Rua+J%C3%BAlio+de+Castilhos,+651,+Farroupilha+-+Rio+Grande+do+Sul&hl=pt-BR&ie=UTF8&ll=-29.230351,-51.344841&spn=0.010168,0.021136&sll=-29.230191,-51.347759&sspn=0.005084,0.010568&oq=Rua+J%C3%BAlio+de+Castilhos,+651,+&t=h&hnear=R.+J%C3%BAlio+de+Castilhos,+651+-+Centro,+Farroupilha+-+Rio+Grande+do+Sul,+95180-000&view=map&z=16&iwloc=A&output=embed'
	);
}



echo json_encode($retorno);


?>