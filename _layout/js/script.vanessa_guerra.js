
$(function(){
		
	// ---------------- inicia as animações do site
	site.init();
	// ---------------- menu
	f_Menu();
	// ---------------- projetos
	f_Projetos();
	// ---------------- menu de categorias
	f_MenuCategorias();
	// ---------------- resize da janela
	f_ResizeWindow();
	// ---------------- busca
	f_Busca();
	// ---------------- links em geral
	f_Links();

});

// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################                                   ################ ################
// ################ ################             variáveis             ################ ################
// ################ ################                                   ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################

//constantes
var site = {
	animacao		: 600,
	url					: '',
	isiPad			: false,
	hash				:	'',
	swipe				:	'',
	resize			:	function(){
		var newHeight = $(window).height() - $('#topo').height();
		var paddings = $('#conteudo > div').height() - $('#conteudo > div').outerHeight();
		if ( site.isiPad ) paddings+=20;
		// altura da div conteúdo
		$('#conteudo').css({ minHeight : newHeight });
		$('#conteudo > div').css({ minHeight : newHeight + paddings }); 
		// testa posição do scroll do site para animar ele
		if ( $('body , html').scrollTop() !=  $('#galeria_trabalhos').height() ) {
			$('body , html').animate({ scrollTop : $('#topo').offset().top },site.animacao/2);
		}
		// reajusta galeria do topo
		topo.resize();
	},
	init				: function(){
		site.isiPad = navigator.userAgent.match(/iPad/i) != null;
		site.hash = location.hash.replace('#!/','');
		site.url = location.href.replace(location.hash,'');
		topo.init();
		if ( site.hash ) ajaxInit();
		// hashchange
		$(window).bind('hashchange',function(){
			site.hash = location.hash.replace('#!/','');
			if (!site.hash) site.hash = 'home';
			ajaxInit();
		});
	},
	changeHash	:	function changeHash(url){
		url = url.replace(site.url,''); //pro IE7
		location.hash = '!/'+url; // atualiza URL
		site.hash = url;
	}
}
var galeria = {
	scroller		: '',
	swipe			: '',
	lista			: '',
	itens			: '',
	item_width		: '',
	stage			: { 'anterior' : '' , 'proximo' : '' },
	carousel		: { 'anterior' : '' , 'proximo' : '' },
	legenda			:	'',
	init			: function(){ 
		galeria.scroller			= $('#galeria_multimidia .carousel div');
		galeria.itens				= $('#galeria_multimidia .carousel li').length;
		galeria.item_width			= $('#galeria_multimidia .carousel li').width();
		galeria.lista				= $('#galeria_multimidia .carousel ul');
		galeria.legenda				= $('#galeria_multimidia .stage ul');
		galeria.carousel.anterior 	= $('#galeria_multimidia .carousel a.anterior');
		galeria.carousel.proximo	= $('#galeria_multimidia .carousel a.proximo');
		galeria.stage.anterior		= $('#galeria_multimidia .stage a.anterior');
		galeria.stage.proximo		= $('#galeria_multimidia .stage a.proximo');
		galeria.lista.width( galeria.item_width * galeria.itens );
		
		if (!site.isiPad) {
			galeria.scroller.find('li:first-child div').addClass('selected');
			galeria.navClick();
		}
		else {
			galeria.scroller.find('li:first-child div:first-child').addClass('selected');
			galeria.navSwipe();
		}
		galeria.legenda.find('li:first-child').addClass('selected');
		
		if ( galeria.lista.width() <= galeria.scroller.width() )
			galeria.carousel.proximo.addClass('inactive');
		if ( galeria.scroller.width() <= galeria.item_width )
			galeria.stage.proximo.addClass('inactive');
		
		galeria.scroller.scrollLeft(0);
			
		galeria.stage.anterior.addClass('inactive');
		galeria.carousel.anterior.addClass('inactive');
		
		galeria.scroller.find('a').bind('click',function(e){
			e.preventDefault();
			var url = $(this).attr('href'); //pega url
			var selected = galeria.lista.find('.selected'); //item selecionado
			var legenda = galeria.legenda.find('li.selected'); //legenda selecionada
			
			// youtube
			if ( url.search('youtube') > 0 ){ 
				url = url.split('/');
				$('#galeria_multimidia .stage em').html('&nbsp;<iframe width="560" height="315" src="http://www.youtube.com/embed/'+ url[url.length-1] +'?wmode=opaque" frameborder="0" allowfullscreen></iframe>&nbsp;');
			}
			// vimeo
			else if ( url.search('vimeo') > 0 ){ 
				url = url.split('/');
				$('#galeria_multimidia .stage em').html('&nbsp;<iframe src="http://player.vimeo.com/video/'+ url[url.length-1] +'" width="560" height="315" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>&nbsp;');
			}
			// fotos
			else {
				$('#galeria_multimidia .stage em').html('&nbsp;<img src="thumb/phpThumb.php?src=../'+ url +'&w=944&h=580" alt="" />&nbsp;');
			}
			
			// seleciona foto
			selected.removeClass('selected');
			$(this).parent().addClass('selected');
			
			if (!site.isiPad)	var index = $(this).parent().parent().index();
			else				var index = $(this).parent().index();
			
			// seleciona legenda
			legenda.removeClass('selected');
			galeria.legenda.find('li:eq('+ index +')').addClass('selected');
			
			galeria.testeStage( $(this) );
		});
	},
	navClick		:	function(){
		
		galeria.testeStage( galeria.lista.find('.selected') );
		
		// ---------------- botões prev / next do carousel
		galeria.carousel.proximo.bind('click',function(){
			galeria.scroller.stop(true,true).animate({ scrollLeft: galeria.scroller.scrollLeft() + galeria.item_width },'fast', galeria.testeCarousel );
			return false;
		});
		galeria.carousel.anterior.bind('click',function(){
			galeria.scroller.stop(true,true).animate({ scrollLeft: galeria.scroller.scrollLeft() - galeria.item_width },'fast', galeria.testeCarousel );
			return false;
		});
		// ---------------- botões prev / next da ampliação
		galeria.stage.proximo.bind('click',function(){
			var selected = galeria.lista.find('.selected');
			var pos = selected.parent().index() * galeria.item_width;
			// se existir próximo
			if ( selected.parent().next().length > 0 ) {
				selected.removeClass('selected').parent().next().find('a').trigger('click');
				// se a posição do item selecionado for menor que a posição do scroll (esquerda)
				if ( pos <  galeria.scroller.scrollLeft() )
					galeria.scroller.stop(true,true).animate({ scrollLeft: pos },'fast', galeria.testeCarousel );
				// se a posição do item selecionado for maior que a posição do scroll (direita)
				else if ( pos >=  galeria.scroller.scrollLeft() + galeria.scroller.width() - galeria.item_width  ) {
					galeria.scroller.stop(true,true).animate({ scrollLeft: selected.parent().next().index() * galeria.item_width + galeria.item_width - galeria.scroller.width()  },'fast', galeria.testeCarousel );
				}
			}
			return false;
		});
		galeria.stage.anterior.bind('click',function(){
			var selected = galeria.lista.find('.selected');
			var pos = selected.parent().index() * galeria.item_width;
			// se existir anterior
			if ( selected.parent().prev().length > 0 ) {
				selected.removeClass('selected').parent().prev().find('a').trigger('click');
				// se a posição do item selecionado for maior que a posição do scroll (direita)
				if ( pos >  galeria.scroller.scrollLeft() + galeria.scroller.width() )
					galeria.scroller.stop(true,true).animate({ scrollLeft: pos + galeria.item_width - galeria.scroller.width() },'fast', galeria.testeCarousel );
				// se a posição do item selecionado for menor que a posição do scroll (esquerda)
				else if ( pos <=  galeria.scroller.scrollLeft() )
					galeria.scroller.stop(true,true).animate({ scrollLeft: selected.parent().prev().index() * galeria.item_width  },'fast', galeria.testeCarousel );
			}
			return false;
		});
	},
	navSwipe		: function(){
		// ---------------- botões prev / next da ampliação
		galeria.stage.proximo.bind('click',function(){
			var selected = galeria.lista.find('.selected');
			
			if ( selected.next().length > 0 ) 
				selected.removeClass('selected').next().find('a').trigger('click');
			else if ( selected.parent().next().length > 0 )
				selected.removeClass('selected').parent().next().children(':first-child').find('a').trigger('click');
			
			selected = galeria.lista.find('.selected');
						
			if ( selected.parent().index() < galeria.swipe.getPos() || selected.parent().index() > galeria.swipe.getPos() )
				galeria.swipe.slide(selected.parent().index() );
			return false;
		});
		galeria.stage.anterior.bind('click',function(){
			var selected = galeria.lista.find('.selected');
			
			if ( selected.prev().length > 0 )
				selected.removeClass('selected').prev().find('a').trigger('click');
			else if ( selected.parent().prev().length > 0 )
				selected.removeClass('selected').parent().prev().children(':last-child').find('a').trigger('click');
				
			selected = galeria.lista.find('.selected');
						
			if ( selected.parent().index() < galeria.swipe.getPos() || selected.parent().index() > galeria.swipe.getPos() ) 
				galeria.swipe.slide(selected.parent().index() );
			return false;
		});
	},
	testeStage	: function(el){
		if (!site.isiPad)	index = el.parent().parent().index();
		else				index = el.parent().index();
		if ( index == 0 )						galeria.stage.anterior.addClass('inactive'); //se for a primeira foto
		else									galeria.stage.anterior.removeClass('inactive'); //se for a primeira foto
		if ( index == galeria.itens-1 )			galeria.stage.proximo.addClass('inactive'); //se for a última foto
		else									galeria.stage.proximo.removeClass('inactive');
	},
	testeCarousel	: function(){
		if ( galeria.scroller.scrollLeft() > 0 )													galeria.carousel.anterior.removeClass('inactive');
		else																						galeria.carousel.anterior.addClass('inactive');
		if ( galeria.scroller.scrollLeft() + galeria.scroller.width() <  galeria.lista.width() )	galeria.carousel.proximo.removeClass('inactive');
		else																						galeria.carousel.proximo.addClass('inactive');
	}
}
var topo = {
	scroller	: '',
	lista		: '',
	itens		: '',
	item_width	: '',
	selected	: 1,
	moving		: false,
	timer		: '',
	init				: function(){
		if (site.isiPad) $('#galeria_trabalhos').addClass('ipad');
		topo.scroller	= $('#galeria_trabalhos');
		topo.itens		= $('#galeria_trabalhos li').length;
		topo.item_width	= $('#galeria_trabalhos li').width();
		topo.lista		= $('#galeria_trabalhos ul.lista');
		topo.nav		= $('#galeria_trabalhos ul.nav');
		// cria navegador
		$('#galeria_trabalhos img').each(function(a){
			topo.nav.append('<li><a href="javascript:void(0);" foto="'+ a +'"></a></li>');
		});
		topo.nav.css({ marginLeft: -topo.nav.width()/2  });
		// teste ipad
		if (!site.isiPad) {
			topo.lista.children('li:last').prependTo(topo.lista);
			topo.lista.width(9999);
			topo.lista.css({ left: - topo.item_width });
			// binda os links do navegador
			topo.nav.find('a').bind( 'click' , topo.navClick ).first().addClass('selected');
			// binda as imagens para o botão next
			topo.lista.find('img').live( 'click' , function(){
				var eq = topo.selected;
				if (topo.selected == topo.itens) eq = 0;
				topo.nav.find('li:eq('+ eq +')').children('a').trigger('click');
			});
			// mostra o primeiro item
			topo.lista.find('li:eq(1)').find('img').animate({ opacity : 1.0 },site.animacao);
			topo.detalhes();
			topo.resize();
		}
		else {
			// deixa todos os itens com o segundo estado
			topo.lista.find('li').addClass('selected');
			// binda os links do navegador
			topo.nav.find('a').bind( 'click' , topo.navClickSwipe ).first().addClass('selected');
			// cria swipe
			site.swipe = new Swipe(document.getElementById('galeria_trabalhos'), { callback : topo.navSwipe });
		}
	},
	navClick	: function(){
		// seleciona o marcador
		$(this).addClass('selected');
		$(this).parent().siblings().children().removeClass('selected');
		var index = $(this).parent().index()+1;
		if( index > topo.selected ) {
			diff = index - topo.selected;
			topo.anim('next',diff);
		}
		if( index < topo.selected ){
			diff = topo.selected - index;
			topo.anim('prev', diff);
		}
	},
	navClickSwipe : function(){
		$(this).addClass('selected');
		$(this).parent().siblings().children().removeClass('selected');
		site.swipe.slide($(this).parent().index());
	},
	navSwipe	: function() {
		topo.nav.find('li:eq('+ this.getPos() +')').children().addClass('selected');
		topo.nav.find('li:eq('+ this.getPos() +')').siblings().children().removeClass('selected');
	},
	resize	:	function(){
		if ($(window).width() - topo.scroller	.width() > 0 ) {
			topo.scroller.css({ paddingLeft :  ($(window).width() - topo.scroller	.width()) /2 , paddingRight : ($(window).width() - topo.scroller.width()) /2 });
		}
		else {
			topo.scroller.css({ paddingLeft :  0 , paddingRight : 0 });
		}
	},
	detalhes	:	function(){
		topo.lista.find('li:eq(1)').bind('mouseenter',function(){
			clearTimeout( topo.timer );
			$(this).find('div').stop(true,true).fadeIn(site.animacao/2);
		}).bind('mouseleave',function(){
			topo.timer = setTimeout(function(){ topo.lista.find('li:eq(1) div').stop(true,true).fadeOut(site.animacao/2); }, site.animacao);
		});
		topo.nav.bind('mouseenter mousemove',function(){
			clearTimeout( topo.timer );
		});
	},
	anim	:	function( direction , dist ){
		// muda item selecionado para o primeiro estado
		topo.lista.find('li').unbind('mouseenter mouseleave');
		topo.lista.find('li:eq(1)').find('div').hide();
		topo.lista.find('li:eq(1)').find('img').css({ opacity : 0.25 });
		if( direction == "next" ) {
			topo.nav.find('a').css({'cursor':'default'}).unbind('click');
			if( topo.selected == topo.itens ) topo.selected = 0;
			if(dist > 1) {
				topo.lista.children('li:lt(2)').clone().appendTo( topo.lista );
				topo.lista.animate({ left: - ( topo.item_width * (dist+1) )  },site.animacao, function() {
					topo.lista.children('li:lt(2)').remove();
					for(i=1;i<=dist-2;i++) {
						topo.lista.children('li:first').appendTo( topo.lista );
					}
					$(this).css({ left: - topo.item_width });
					topo.selected = topo.selected+2;
					topo.detalhes();
					topo.lista.find('li:eq(1)').find('img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').bind( 'click' , topo.navClick ).css({'cursor':'pointer'});
					});
				});
			}
			else {
				topo.lista.children('li:first').clone().appendTo( topo.lista );	
				topo.lista.animate({left: - topo.item_width*2 },site.animacao,function(){
					topo.lista.children('li:first').remove();
					$(this).css({ left : - topo.item_width });
					topo.selected = topo.selected+1;
					topo.detalhes();
					topo.lista.find('li:eq(1)').find('img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').bind( 'click' , topo.navClick ).css({'cursor':'pointer'});
					});
				});
			}
		}
		if(direction == "prev") {
			topo.nav.find('a').css({'cursor':'default'}).unbind('click');
			if( dist > 1 ) {
				topo.lista.children('li:gt('+ (topo.itens-(dist+1)) +')').clone().prependTo( topo.lista );
				topo.lista.css({ left : -(topo.item_width*(dist+1)) }).animate({left: - topo.item_width},site.animacao,function(){
					topo.lista.children('li:gt('+(topo.itens-1)+')').remove();
					topo.selected = topo.selected - dist;
					topo.detalhes();
					topo.lista.find('li:eq(1)').find('img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').bind( 'click' , topo.navClick ).css({'cursor':'pointer'});
					});
				});
			}
			else {
				topo.lista.children('li:last').clone().prependTo( topo.lista );
				topo.lista.css({ left : -(topo.item_width*2) }).animate({left:-topo.item_width},site.animacao,function(){
					topo.lista.children('li:last').remove();
					topo.selected = topo.selected-1;
					if(topo.selected==0) topo.selected = topo.itens;
					topo.detalhes();
					topo.lista.find('li:eq(1)').find('img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').bind( 'click' , topo.navClick ).css({'cursor':'pointer'});
					});
				});
			}
		}
	}
}
var markups = {
	escritorio : '\
		<div id="escritorio">\
			<div class="escritorio">\
				<div class="center">\
					<div class="texto left">\
						<h2>{titulo1}</h2>\
						{texto1}\
					</div>\
					<div class="galeria right">\
						{galeria_escritorio}\
					</div>\
				</div>\
			</div>\
			<div class="sobre">\
				<div class="center">\
					<div class="galeria left">\
						{galeria_sobre}\
					</div>\
					<div class="texto left">\
						<h2>{titulo2}</h2>\
						{texto2}\
					</div>\
					<div class="rodape"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
				</div>\
			</div> <!-- fim sobre -->\
    	</div> <!-- fim escritorio -->\
	',
	contato : '\
		<div id="contato">\
			<div class="center">\
				<div class="texto left">\
					<h2>Entre em Contato</h2>\
					<p>Para entrar em contato basta preencher os campos abaixo e entraremos em contato logo que possível.</p>\
					<form id="frm_contato" name="frm_contato">\
						<input type="text" name="nome" value="Nome" />\
						<input type="text" name="email" value="E-mail" />\
						<input type="text" name="telefone" value="Telefone" maxlength="14" />\
						<textarea name="mensagem">Mensagem</textarea>\
						<input type="submit" title="Enviar" value="Enviar" />\
						<p class="alerta"></p>\
					</form>\
				</div>\
				<div class="right">\
					<iframe class="mapa" width="430" height="223" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/?ie=UTF8&amp;t=m&amp;ll=-14.264383,-53.173828&amp;spn=18.66209,39.462891&amp;z=4&amp;output=embed"></iframe>\
					<div class="midias">\
						<a href="https://www.facebook.com/vanessa.guerra.26.11" class="facebook" target="_blank" title="Facebook">Facebook</a>\
						<a href="#" class="twitter" target="_blank" title="Twitter">Twitter</a>\
					</div>\
					<p class="endereco">\
						(54) 3042-0172<br />\
						Rua Pinheiro Machado 195 -  Sala 804<br />\
						Farroupilha - RS\
					</p>\
				</div>\
				<div class="rodape"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
			</div>\
    	</div> <!-- fim contato -->\
	',
	projetos : '\
		<div id="projetos">\
			<div class="center">\
				<div id="breadcrumbs">\
					<p>Onde você está?</p>\
					{breadcrumbs}\
				</div>\
				<div id="categorias_nav">\
					<a href="javascript:void(0);"></a>\
					<ul id="menu_categorias" class="{tamanho}">\
					{categorias}\
					</ul>\
				</div>\
				<form id="busca" name="busca">\
					<input name="termo" type="text" value="{termo}" />\
				</form>\
				{conteudo}\
				<div class="rodape"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
			</div>\
		</div> <!-- fim projetos -->\
	',
	lista : '\
		<div id="categorias">\
			<ul>\
			{itens}\
			</ul> <!-- fim categorias -->\
		</div>\
		<div class="wrap_projetos_nav">\
			<div class="projetos_nav">{itens_nav}</div>\
		</div>\
	',
	itens : '\
		<div>\
			<a href="{link}">\
				<div><div><p><span>{nome}</span></p></div></div>\
				<img src="{foto}" width="295" height="165" alt="" />\
			</a>\
		</div>\
	',
	detalhes : '\
		<div class="voltar">\
			<a href="projetos/{link}" title="Voltar"></a>\
			<p><span>{titulo}</span></p>\
		</div>\
		<div class="descricao {ipad}">\
			<div class="normal">\
				{tx_menor}\
			</div>\
			<div class="maior">\
				{tx_maior}\
				<div class="addthis_toolbox compartilhar">\
					<span>Compartilhe esse projeto</span>\
					<a class="addthis_button_facebook facebook" data-url="{url}"><img src="images/ic_facebook_pequeno.png" alt="" /></a>\
					<a class="addthis_button_twitter twitter" data-url="{url}"><img src="images/ic_facebook_twitter.png" alt="" /></a>\
				</div>\
			</div>\
			{botaoMais}\
		</div> <!-- fim descricao -->\
		<div id="galeria_multimidia">\
			<div class="stage">\
				<a href="javascript:void(0);" class="anterior" title="Anterior"></a>\
				<a href="javascript:void(0);" class="proximo" title="Próximo"></a>\
				<em>&nbsp;{ampliacao}&nbsp;</em>\
				<ul>{legenda}</ul>\
			</div>\
			<div class="carousel {ipad}">\
				<a href="javascript:void(0);" class="anterior" title="Itens anteriores"></a>\
				<a href="javascript:void(0);" class="proximo" title="Próximos itens"></a>\
				<div id="carousel">\
					<ul>\
						{galeria}\
					</ul>\
				</div>\
			</div>\
		</div> <!-- fim galeria_multimidia -->\
	'
}

// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################                                   ################ ################
// ################ ################          funções de bind          ################ ################
// ################ ################                                   ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################

// ################ funções do menu
function f_Menu() {
	$('#menu a , h1 a , #categorias a , #breadcrumbs a , #menu_categorias a , div.voltar a , #galeria_trabalhos ul.lista a')
	.live('click',function(){
		var url = $(this).attr('href');
		site.changeHash( url );
	});
	//voltar ao menu
	if (!site.isiPad){
		$('#menu_principal.ativo').live('mouseleave',function(){
			site.timer = setTimeout(function() {
				$('#menu_principal.ativo').animate({ left: site.pos_menu },site.animacao,function(){ $(this).hide(); });
			},800);
		}).live('mouseenter',function(){
			clearTimeout(site.timer);
		});
	}
}

// ################ funções dos projetos
function f_Projetos() {
	if (!site.isiPad){
		$('#projetos .descricao').live('mouseenter',function(){
			$(this).children('.normal').hide();
			$(this).children('.maior').show();
			$(this).stop(true,true).animate({ height : $('.maior').outerHeight() + $(this).height() },'fast');
		}).live('mouseleave',function(){
			$(this).stop(true,true).animate({ height : 60 },'fast',function(){
				$(this).children('.normal').show();
				$(this).children('.maior').hide();
			});
		});
	}
	else {
		$('#projetos .descricao > a').live('touchstart',function(){
			var div = $('#projetos .descricao');
			if (!div.children('.maior').is(':visible')){
				$(this).addClass('open');
				div.children('.normal').hide();
				div.children('.maior').show();
				div.stop(true,true).animate({ height : $('.maior').outerHeight() + div.height() },'fast');
			}
			else {
				$(this).removeClass('open');
				div.stop(true,true).animate({ height : 60 },'fast',function(){
					div.children('.normal').show();
					div.children('.maior').hide();
				});
			}
		});
	}
}

// ################ funções do menu de categorias
function f_MenuCategorias() {
	if (!site.isiPad){
		$('#categorias_nav').live('mouseenter',function(){
			$(this).addClass('hover');
			$('#menu_categorias').show();
		}).live('mouseleave',function(){
			$(this).removeClass('hover');
			$('#menu_categorias').hide();
		});
	}
	else {
		$('#categorias_nav').live('click',function(){
			if (!$('#menu_categorias').is(':visible')){
				$('#menu_categorias').show();
				$(this).addClass('hover');
			}
			else{
				$('#menu_categorias').hide();
				$(this).removeClass('hover');
			}
		});
	}
}

// ################ links em geral
function f_Links(){
	$('#menu a , h1 a , #projetos .descricao > a , #categorias a , #breadcrumbs a ,  #menu_categorias a , div.voltar a , #galeria_trabalhos a , .compartilhar a').live('click',function(e){ e.preventDefault(); });
}

// ################ resize da janela
function f_ResizeWindow(){
	if (!site.isiPad) var tipo = 'resize';
	else 							var tipo = 'orientationchange';
	$(window).bind(tipo, function(){
		site.resize();
	});
}

// ################ busca
function f_Busca(){
	$('#busca').live('submit',function(e){
		var form 		 = $(this);
		var termo    = $('#busca input');
		if (termo.val().length <= 2 || termo.val() == 'Busca'){
			return false;
		}		
		url = site.hash.split('/');
		url = url[0] + '/busca/' + termo.val();
		site.changeHash(url);
		return false;
	});
}



// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################                                   ################ ################
// ################ ################          funções ativadas         ################ ################
// ################ ################                                   ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################


// ---------------- requisições de conteúdo
function ajaxInit(){
	
	var url = site.hash.split('/');
	var modulo = url[0];
	var classe = url[1];
	var variaveis = url.slice(2,url.length);
	var conteudo = $('#conteudo');
	
	//marca o menu principal
	$('#menu a').removeClass('selected');
	$('#menu a.'+modulo).addClass('selected');
	
	var pacote;
	var dados = {
		modulo : modulo,
		classe : classe,
		variaveis : variaveis,
		acao: 'carregaConteudo'
	};
	pacote = JSON.stringify( dados );
		
	if (modulo!='home') {
		$.ajax({
			type: 'POST',
			url: 'json.php',
			data: 'ajaxACK=' + pacote,
			dataType: 'json',
			beforeSend: function(){
				//adiciona o loader
				if ($('#conteudo').is(':visible')) {
					conteudo.children('div').append('<div class="loader"></div>');
				}
			},
			success: function(resposta){
				if (modulo == 'contato') {
					conteudo.fadeIn().html( markups.contato );
				}
				else if (modulo == 'escritorio') {
					galeria_sobre = '';
					galeria_escritorio = '';
					for ( i in resposta.escritorio ) {
						for ( j in resposta.escritorio[i].imagens ) {
							if (i==0) galeria_escritorio += '<img src="thumb/phpThumb.php?src=../galeria/escritorio/'+ resposta.escritorio[i].imagens[j] +'&w=380&h=363&zc=1" alt="" />';
							if (i==1) galeria_sobre += '<img src="thumb/phpThumb.php?src=../galeria/escritorio/'+ resposta.escritorio[i].imagens[j] +'&w=230&h=220&zc=1" alt="" />';
						}
					}
					conteudo.fadeIn().html( markups.escritorio.replace(/{texto1}/,resposta.escritorio[0].texto)
																										.replace(/{texto2}/,resposta.escritorio[1].texto)
																										.replace(/{titulo1}/,resposta.escritorio[0].titulo)
																										.replace(/{titulo2}/,resposta.escritorio[1].titulo)
																										.replace(/{galeria_escritorio}/,galeria_escritorio)
																										.replace(/{galeria_sobre}/,galeria_sobre)
																);
					bindGaleriaEscritorio();
				}
				else if (modulo == 'projetos') {
					if ( !classe ){
						breadcrumbs = '<p><a href="projetos">Categorias</a>&nbsp;</p>';
						cont = 0; categorias = ''; itens = ''; aux = 0; itens_nav = '';
						for ( i in resposta.projetos ) {
							categorias += '<li><a href="projetos/'+ i +'">' + i + '</a></li>';
							cont++;
							aux++;
							if (aux == 1) { itens += '<li>'; itens_nav += '<a href="javascript:void(0);"></a>'; }
							itens += markups.itens	.replace(/{link}/,'projetos/'+i)
													.replace(/{nome}/,i)
													.replace(/{foto}/,'thumb/phpThumb.php?src=../galeria/projetos/'+resposta.projetos[i][0].imagens[0].foto+'&w=295&h=165&zc=1') ;
							if (aux == 6) { itens += '</li>'; aux = 0; }
						}
						if (aux > 0){ itens += '</li>'; }
						if ( !site.isiPad ) itens_nav = '';
						content = markups.lista	.replace(/{itens}/,itens)
												.replace(/{itens_nav}/,itens_nav);
					}
					else if ( classe == 'busca') {
						termo = variaveis[0];
						breadcrumbs = '<p>Busca</p>';
						cont = 0; categorias = ''; itens = ''; aux = 0; itens_nav = '';
						for ( i in resposta.projetos ) {
							categorias += '<li><a href="projetos/'+ i +'">' + i + '</a></li>';
							for ( j in resposta.projetos[i] ) {
								cont++;
								aux++;
								if (aux == 1) { itens += '<li>'; itens_nav += '<a href="javascript:void(0);"></a>'; }
								itens += markups.itens	.replace(/{link}/,'projetos/'+ i +'/'+ resposta.projetos[i][j].titulo)
														.replace(/{nome}/,resposta.projetos[i][j].titulo)
														.replace(/{foto}/,'thumb/phpThumb.php?src=../galeria/projetos/'+resposta.projetos[i][j].imagens[0].foto+'&w=295&h=165&zc=1') ;
								if (aux == 6) { itens += '</li>'; aux = 0; }
							}
						}
						if (aux > 0){ content += '</li>'; }
						if ( !site.isiPad ) itens_nav = '';
						content = markups.lista	.replace(/{itens}/,itens)
												.replace(/{itens_nav}/,itens_nav);
					}
					else if ( classe != 'busca' && variaveis[0] ) {
						breadcrumbs = '<p><a href="projetos/'+ modulo +'">Categorias</a> / <a href="projetos/'+ classe +'">'+ classe +'</a></p>';
						cont = 0; categorias = ''; itens = ''; aux = 0; legenda = '';	
						if (site.isiPad){	botao = '<a href="javascript:void(0);"></a>'; ipad='ipad' }
						else						{	botao = ''; ipad='' }
						for ( i in resposta.projetos ) {
							cont++;
							categorias += '<li><a href="projetos/'+ i +'">' + i + '</a></li>';
						}
						for ( i in resposta.projetos ) {
							//AQUI
							if (resposta.projetos[i][0].imagens.length > 0)
								ampliacao = '<img src="thumb/phpThumb.php?src=../galeria/projetos/'+ resposta.projetos[i][0].imagens[0].foto +'&w=944&h=580" alt="" />';
							else
								ampliacao = '<iframe width="430" height="223" src="http://www.youtube.com/embed/'+ resposta.projetos[i][0].videos[0].video +'" frameborder="0" allowfullscreen></iframe>';
							aux = 0;
							for ( j in resposta.projetos[i][0].imagens ) {
								legenda += '<li>'+ resposta.projetos[i][0].imagens[j].legenda +'</li>';
								if ( !site.isiPad ) {
									itens += '<li><div><a href="galeria/projetos/'+ resposta.projetos[i][0].imagens[j].foto +'"><img src="thumb/phpThumb.php?src=../galeria/projetos/'+ resposta.projetos[i][0].imagens[j].foto +'&w=140&h=86" alt="" /></a></div></li>';
									continue;
								}
								aux++;
								if ( aux == 1 ) { itens += '<li>'; }
								itens += '<div><a href="galeria/projetos/'+ resposta.projetos[i][0].imagens[j].foto +'"><img src="thumb/phpThumb.php?src=../galeria/projetos/'+ resposta.projetos[i][0].imagens[j].foto +'&w=140&h=86" alt="" /></a></div>';
								if (aux == 6) { itens += '</li>'; aux = 0; }
							}
							for ( j in resposta.projetos[i][0].videos ) {
								legenda += '<li>'+ resposta.projetos[i][0].videos[j].legenda +'</li>';
								if ( !site.isiPad ) {
									itens += '<li><div><a href="http://www.youtube.com/v/'+ resposta.projetos[i][0].videos[j].video +'"><em></em><img src="http://img.youtube.com/vi/'+ resposta.projetos[i][0].videos[j].video +'/1.jpg" height="86" alt="" /></a></div></li>';
									continue;
								}
								aux++;
								if ( aux == 1 ) { itens += '<li>'; }
								itens += '<div><a href="http://www.youtube.com/v/'+ resposta.projetos[i][0].videos[j].video +'"><em></em><img src="http://img.youtube.com/vi/'+ resposta.projetos[i][0].videos[j].video +'/1.jpg" height="86" alt="" /></a></div>';
								if (aux == 6) { itens += '</li>'; aux = 0; }
							}
							
							break;
						}
						content = markups.detalhes.replace(/{link}/,classe)
																			.replace(/{titulo}/,resposta.projetos[i][0].titulo)
																			.replace(/{tx_menor}/,resposta.projetos[i][0].texto_menor)
																			.replace(/{tx_maior}/,resposta.projetos[i][0].texto)
																			.replace(/{botaoMais}/,botao)
																			.replace(/{ampliacao}/,ampliacao)
																			.replace(/{legenda}/,legenda)
																			.replace(/{galeria}/,itens)
																			.replace(/{ipad}/g,ipad)
																			.replace(/{url}/g,$(location).attr('href'));
					}
					else {
						breadcrumbs = '<p><a href="projetos">Categorias</a> / <a href="projetos/'+ classe +'">'+ classe +'</a></p>';
						cont = 0; categorias = ''; itens = ''; aux = 0; itens_nav = '';
						for ( i in resposta.projetos ) {
							categorias += '<li><a href="projetos/'+ i +'">' + i + '</a></li>';
							for ( j in resposta.projetos[i] ) {
								cont++;
								aux++;
								if (aux == 1) { itens += '<li>'; itens_nav += '<a href="javascript:void(0);"></a>'; }
								itens += markups.itens.replace(/{link}/,'projetos/'+ i +'/'+ resposta.projetos[i][j].titulo)
																			.replace(/{nome}/,resposta.projetos[i][j].titulo)
																			.replace(/{foto}/,'galeria/projetos/'+resposta.projetos[i][j].imagens[0].foto) ;
								if (aux == 6) { itens += '</li>'; aux = 0; }
							}
						}
						if (aux > 0){ content += '</li>'; }
						if ( !site.isiPad ) itens_nav = '';
						content = markups.lista.replace(/{itens}/,itens)
																	 .replace(/{itens_nav}/,itens_nav);
					}
					if (cont > 10) tamanho = "maior";
					else					 tamanho = "";
					if (classe != 'busca') termo = 'Busca';
					conteudo.fadeIn().html( markups.projetos.replace(/{conteudo}/, content)
																									.replace(/{categorias}/,categorias)
																									.replace(/{tamanho}/,tamanho)
																									.replace(/{breadcrumbs}/,breadcrumbs)
																									.replace(/{termo}/,termo)
																);
					bindGaleriaCategorias();
					if ( $('.carousel').length > 0 ){
						galeria.init();
						if ( site.isiPad ) {
							galeria.swipe = new Swipe(document.getElementById('carousel'));
						}
						addthis.toolbox(".addthis_toolbox");
					}
				}
				
				
				//$(window).triggerHandler('resize');
				site.resize();
				bindFormularios(conteudo);
				
			}
		});
	}
	else {
		// scrolla o site para o top e da um fade no conteúdo
		$('body , html').animate({ scrollTop : 0 },site.animacao);
		conteudo.fadeOut(site.animacao,function(){ conteudo.hide().html(''); })
	}
}

// ---------------- focus/blur formularios
function bindFormularios(data){
	data.find('input[type=text] , textarea').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
			if(this.value == default_value) {
				this.value = '';
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				this.value = default_value;
			}
		});
	});
}

// ---------------- cycle das galerias
function bindGaleriaCategorias(){
	if ( site.isiPad ) {
		var catSwipe = new Swipe(document.getElementById('categorias'),{
			callback : function(){
				$('.projetos_nav a:eq('+ this.getPos() +')').trigger('click');
			}
		});
		$('.projetos_nav a').bind('click',function(){
			catSwipe.slide( $(this).index() );
			$(this).addClass('activeSlide');
			$(this).siblings().removeClass('activeSlide');
		}).first().trigger('click');
	}
	else {
		$('#categorias ul').cycle({
			fx: 			'scrollHorz',
			pager: 		'.projetos_nav',
			speed:    site.animacao, 
			timeout:  5000
		});
		$('#categorias ul').cycle('pause');
	}
}
function bindGaleriaEscritorio(){
	$('.galeria.left').cycle({
		speed:    site.animacao, 
    timeout:  5000
	});
	$('.galeria.right').cycle({
		speed:    site.animacao, 
    timeout:  5000
	});
}
