
$(function(){

	// ---------------- inicia as animações do site
	site.init();


	// ################ ################ ################ ################ ################ ################
	// ################ ################                                   ################ ################
	// ################ ################            <ipadTest>             ################ ################
	// ################ ################                                   ################ ################
	// ################ ################ ################ ################ ################ ################


	// just for pc
	if (!site.isiPad){

		var tipo = 'resize';

		// ---------------- menu de categorias
		$('#wrapper').on('mouseenter','#category-box',function(){
			$(this).addClass('selected');
			$('.category-list').show();
		}).on('mouseleave','#category-box',function(){
			$(this).removeClass('selected');
			$('.category-list').hide();
		});

		// ---------------- menu de categorias
		$('#wrapper').on('click','.category-menu-button',function(event){
			event.preventDefault();
		});

	}
	else {

		var tipo = 'orientationchange';

		// ---------------- menu de categorias
		$('#wrapper').on('click','.category-menu-button',function(event){
			event.preventDefault();
			if (!$('.category-list').is(':visible')){
				$('.category-list').show();
				$(this).parent().addClass('selected');
			}
			else{
				$('.category-list').hide();
				$(this).parent().removeClass('selected');
			}
		});

	}


	// ################ ################ ################ ################ ################ ################
	// ################ ################                                   ################ ################
	// ################ ################            </ipadTest>            ################ ################
	// ################ ################                                   ################ ################
	// ################ ################ ################ ################ ################ ################



	// ---------------- resize da janela
	$(window).bind(tipo, function(){
		site.resize();
	});


	// ---------------- check forms
	$('#wrapper').on('keyup','.ipt-phone',function(){
		checkPhone(this);
	});
	$('#wrapper').on('keyup','.ipt-number',function(){
		checkNumber(this);
	});
	$('#wrapper').on('focusin','input , textarea , select', function(){
		$(this).closest('.field').addClass('selected');
	}).on('focusout','input , textarea , select', function(){
		$(this).closest('.field').removeClass('selected');
	});


	// ---------------- focus/blur formularios
	$('#wrapper').on('keypress paste','input:not([readonly]) , textarea:not([readonly]) , select:not([readonly])',function(event) {
		if ( $(this).is('.persistent') ) return;
		if ( event.which == 13 || event.which == 0 || event.which == 8 ) {
			return;
		}
		$(this).closest('.field').find('.placeholder-text').hide();
	}).on('keyup change input','input:not([readonly]) , textarea:not([readonly]) , select:not([readonly])',function(event){
		if ( $(this).is('.persistent') ) {
			$(this).closest('.field').find('.field-alert').fadeOut(function(){ $(this).remove(); });
			return;
		}
		if ( !$(this).val() ) {
			$(this).closest('.field').find('.placeholder-text').show();
		}
		else {
			$(this).closest('.field').find('.placeholder-text').hide();
			$(this).closest('.field').find('.field-alert').fadeOut(function(){ $(this).remove(); });
		}
	});


	// ---------------- submit
	$('#wrapper').on('submit',function(event){
		event.preventDefault();
		$(this).find('.form-button').trigger('click');
	});
	$('#wrapper').on('click','.form-button',function(event){
		event.preventDefault();

		if ( $(this).is('.disabled') ) return;

		var $flag = false,
			$dados = new Object,
			$pacote,
			$form = $(this).closest('.form'),
			$alert = $form.find('.form-alert'),
			$blocks = $form.find('.field-block'),
			$fields = 'input , textarea , select',
			$botao = $(this),
			$bullet = $botao.find('.form-bullet'),
			$text = $bullet.text(),
			$url;

		// acao do form
		$dados['acao'] = $form.attr('acao');

		// remove alert
		$('.field-alert').not('.ok').remove();


		// enviar contato
		if ( $dados['acao'] == 'enviaContato' ) {
			$url = site.url + '/home/ajax';
		}
		else if ( $dados['acao'] == 'search' ) {
			var $termo = $form.find($fields).val();
			if ( $termo.length <= 2 ){
				return false;
			}
			window.location = '#!/busca/' + encodeURI($termo) + '/page/1';
			return false;
		}

		// cycle blocks
		$blocks.each(function(){

			// não valida
			if ( $(this).is('.no-valid')) return;

			var	$c = $(this).attr('chave');

			if ( !$dados[ $c ]  ) {
				$dados[ $c ] = new Object;
			}
			else {
				$dados[ $c ] = $dados[ $c ];
			}

			// cycle fields
			$(this).find($fields).each(function(){
				var $v = $(this).val(),
					$n = $(this).attr('name');

				// teste type
				if ( $(this).attr('type') == 'radio' ) {
					if ( $(this).is(':checked') )
						$dados[ $c ][ $n ] = $v;
				}
				else if ( $(this).attr('type') == 'checkbox' ) {
					$dados[ $c ][ $n ] = $(this).is(':checked');
				}
				else {
					$dados[ $c ][ $n ] = $v;
				}

				// não valida
				if ( $(this).is('.no-valid') ) return;

				// email
				if ( $(this).is('.ipt-email') ) {
					if ( !/[A-Za-z0-9_.-]+@([A-Za-z0-9_]+\.)+[A-Za-z]{2,4}/.test( $v ) ) {
						$flag = site.addAlert( $(this).closest('.placeholder') );
					}
				}
				// teste vazio
				else if ( !$dados[ $c ][ $n ] ) {
					$flag = site.addAlert( $(this).closest('.placeholder') );
				}
			});
		});

		// para o envio caso encontre algum erro nos campos
		if ( $flag ){
			$alert.fadeIn('fast').html('Preencha os campos marcados.');
			return false;
		}


		// desabilita botão
		$botao.addClass('disabled');
		$alert.hide();

		if ( $dados['acao'] == 'enviaContato' ) {
			$bullet.html('Aguarde');
		}

		$pacote = JSON.stringify( $dados );

		$.ajax({
			type: 'POST',
			url: $url,
			data: { ajaxACK : $pacote },
			dataType: 'json',
			success: function( $resposta ){

				// reabilita botão
				$botao.removeClass('disabled');

				// search reload
				if ( $dados['acao'] == 'enviaContato' ) {
					$bullet.html( $text );
					if ( $resposta.status ) {
						$alert.show().html('<span>'+ resposta.mensagem + '</span>');
						$form.find($fields).each(function(){
							$(this).val('');
						});
					}
					else {
						$alert.show().html( resposta.mensagem );
					}
				}

			}
		});

	});


});

// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################                                   ################ ################
// ################ ################             variáveis             ################ ################
// ################ ################                                   ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################


var site = {
	animacao		: 600,
	isiPad			: false,
	hash			: '',
	swipe			: '',
	resize : function(){
		var newHeight = $(window).height() - $('#header').height();
		var paddings = $('#conteudo > div').height() - $('#conteudo > div').outerHeight(true);

		// altura da div conteúdo
		$('#conteudo').css({ minHeight : newHeight });
		$('#conteudo > div').css({ minHeight : newHeight + paddings });

		// padding específico para escritorio
		if ( $('#escritorio').length ) {
			var $padd = $('.sobre').height() - $('.sobre').outerHeight(true);
			$('.sobre').height( newHeight - $('#escritorio .escritorio').outerHeight(true) + $padd );
		}

		// reajusta galeria do topo
		topo.resize();
	},
	scroll : function(){
		// testa posição do scroll do site para animar ele
		if ( $('body , html').scrollTop() !=  $('#project-gallery').height() ) {
			$('body , html').animate({ scrollTop : $('#header').offset().top },site.animacao/2);
		}
	},
	init : function(){
		site.isiPad = navigator.userAgent.match(/iPad/i) != null;
		if ( location.hash ) location.hash = decodeURI(location.hash);
		site.hash = location.hash.replace('#!/','');

		// ipad
		if ( site.isiPad ) {
			$('#wrapper').addClass('ipad');
		}

		// inicia galeria do topo
		topo.init();

		// hash
		ajaxInit();

		// hashchange
		$(window).bind('hashchange',function(){
			site.hash = location.hash.replace('#!/','');
			ajaxInit();
		});
	},
	addAlert : function( $el ) {
		$el.append('<span class="field-alert"></span>');
		$el.find('.field-alert').fadeIn('fast');
		return true;
	},
	pagerURL : function( $index ){
		var $url = site.hash.split('/');
		var $page = $.inArray( 'page', $url );

		if ( $page > -1 ) {
			$url[$page+1] = $index;
			$url = $url.join('/');
			window.location = site.url + '/#!/' + $url;
		}
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

		galeria.scroller.find('a').bind('click',function(event){
			event.preventDefault();

			var $url = $(this).attr('href'); //pega url
			var $selected = galeria.lista.find('.selected'); //item selecionado
			var $legenda = galeria.legenda.find('li.selected'); //legenda selecionada

			// youtube
			if ( $url.search('youtube') > 0 ){
				$url = $url.split('/');
				$('#galeria_multimidia .stage em').html('&nbsp;<iframe width="560" height="315" src="http://www.youtube.com/embed/'+ $url[$url.length-1] +'?wmode=opaque" frameborder="0" allowfullscreen></iframe>&nbsp;');
			}
			// vimeo
			else if ( $url.search('vimeo') > 0 ){
				$url = $url.split('/');
				$('#galeria_multimidia .stage em').html('&nbsp;<iframe src="http://player.vimeo.com/video/'+ $url[$url.length-1] +'" width="560" height="315" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>&nbsp;');
			}
			// fotos
			else {
				$('#galeria_multimidia .stage em').html('&nbsp;<img src="'+ $url +'" alt="" />&nbsp;');
			}

			// seleciona foto
			$selected.removeClass('selected');
			$(this).parent().addClass('selected');

			if (!site.isiPad)	var $index = $(this).parent().parent().index();
			else				var $index = $(this).parent().index();

			// seleciona legenda
			$legenda.removeClass('selected');
			galeria.legenda.find('li:eq('+ $index +')').addClass('selected');

			galeria.testeStage( $(this) );
		});
	},
	navClick		:	function(){

		galeria.testeStage( galeria.lista.find('.selected') );

		// ---------------- botões prev / next do carousel
		galeria.carousel.proximo.bind('click',function(event){
			event.preventDefault();
			galeria.scroller.stop(true,true).animate({ scrollLeft: galeria.scroller.scrollLeft() + galeria.item_width },'fast', galeria.testeCarousel );
			return false;
		});
		galeria.carousel.anterior.bind('click',function(event){
			event.preventDefault();
			galeria.scroller.stop(true,true).animate({ scrollLeft: galeria.scroller.scrollLeft() - galeria.item_width },'fast', galeria.testeCarousel );
			return false;
		});
		// ---------------- botões prev / next da ampliação
		galeria.stage.proximo.bind('click',function(event){
			event.preventDefault();
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
		galeria.stage.anterior.bind('click',function(event){
			event.preventDefault();
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
		galeria.stage.proximo.bind('click',function(event){
			event.preventDefault();

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
		galeria.stage.anterior.bind('click',function(event){
			event.preventDefault();

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
		if (site.isiPad) $('#project-gallery').addClass('ipad');
		topo.scroller	= $('#project-gallery');
		topo.itens		= $('.project-gallery-item').length;
		topo.item_width	= $('.project-gallery-item').width();
		topo.lista		= $('.project-gallery-list');
		topo.nav		= $('#project-gallery .cycle-nav');

		// cria navegador
		topo.lista.find('img').each(function(a){
			topo.nav.append('<li><a href="#"></a></li>');
		});

		// teste ipad
		if (!site.isiPad) {

			// last item first
			topo.lista.children('li:last').prependTo(topo.lista);
			// width
			topo.lista.width(99999);
			// padding
			topo.lista.css({ left: - topo.item_width });

			// binda os links do navegador
			topo.nav.on( 'click','a',function(event){
				event.preventDefault();

				if ( $(this).is('.disabled') ) return;

				// seleciona o marcador
				$(this).addClass('selected');
				$(this).parent().siblings().children().removeClass('selected');


				var index = $(this).parent().index()+1;

				if( index > topo.selected ) {
					diff = index - topo.selected;
					topo.anim('next', diff);
				}
				if( index < topo.selected ){
					diff = topo.selected - index;
					topo.anim('prev', diff);
				}
			})

			// binda as imagens para o botão next
			topo.lista.on( 'click', 'img', function(){
				if ( topo.nav.find('.disabled').length ) return;
				var eq = topo.selected;
				if (topo.selected == topo.itens) eq = 0;
				topo.nav.find('li:eq('+ eq +')').children('a').trigger('click');
			});

			// mostra o primeiro item
			topo.lista.find('li:eq(1)').find('img').animate({ opacity : 1.0 },site.animacao);
			topo.nav.find('a:first').addClass('selected');

			topo.detalhes();
			topo.resize();
		}
		else {
			// deixa todos os itens com o segundo estado
			topo.lista.find('li').addClass('selected');
			// binda os links do navegador
			topo.nav.find('a').bind( 'click' , topo.navClickSwipe ).first().addClass('selected');
			// cria swipe
			site.swipe = new Swipe(document.getElementById('project-gallery'), { callback : topo.navSwipe });
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
		if ($(window).width() - topo.scroller.width() > 0 ) {
			topo.scroller.css({ paddingLeft :  ($(window).width() - topo.scroller	.width()) /2 , paddingRight : ($(window).width() - topo.scroller.width()) /2 });
		}
		else {
			topo.scroller.css({ paddingLeft :  0 , paddingRight : 0 });
		}
	},
	detalhes	:	function(){
		topo.lista.on('mouseenter','li:eq(1)',function(){
			clearTimeout( topo.timer );
			$(this).find('.project-gallery-info').stop(true,true).fadeIn(site.animacao/2);
		}).on('mouseleave','li:eq(1)',function(){
			topo.timer = setTimeout(function(){
				topo.lista.find('li:eq(1) .project-gallery-info').stop(true,true).fadeOut(site.animacao/2);
			}, site.animacao);
		});
		topo.nav.on('mouseenter mousemove',function(){
			clearTimeout( topo.timer );
		});
	},
	anim	:	function( direction , dist ){
		// muda item selecionado para o primeiro estado
		topo.lista.find('li:eq(1)').find('.project-gallery-info').hide();
		topo.lista.find('li:eq(1)').find('img').css({ opacity : 0.25 });
		// disable nav
		topo.nav.find('a').addClass('disabled');

		if( direction == "next" ) {
			if( topo.selected == topo.itens ) topo.selected = 0;
			if(dist > 1) {
				topo.lista.children('li:lt(2)').clone().appendTo( topo.lista );
				topo.lista.animate({ left: - ( topo.item_width * (dist+1) )  },site.animacao, function() {
					topo.lista.children('li:lt(2)').remove();
					for(i=1;i<=dist-2;i++) {
						topo.lista.children('li:first').appendTo( topo.lista );
					}
					$(this).css({ left: - topo.item_width });
					topo.selected = topo.selected + diff;
					topo.lista.find('li:eq(1) img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').removeClass('disabled');
					});
				});
			}
			else {
				topo.lista.children('li:first').clone().appendTo( topo.lista );
				topo.lista.animate({left: - topo.item_width*2 },site.animacao,function(){
					topo.lista.children('li:first').remove();
					$(this).css({ left : - topo.item_width });
					topo.selected = topo.selected+1;
					topo.lista.find('li:eq(1) img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').removeClass('disabled');
					});
				});
			}
		}
		if(direction == "prev") {
			if( dist > 1 ) {

				topo.lista.children('li:gt('+ (topo.itens-(dist+1)) +')').clone().prependTo( topo.lista );
				topo.lista.css({ left : -(topo.item_width*(dist+1)) }).animate({left: - topo.item_width},site.animacao,function(){
					topo.lista.children('li:gt('+(topo.itens-1)+')').remove();
					topo.selected = topo.selected - dist;
					topo.lista.find('li:eq(1) img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').removeClass('disabled');
					});
				});
			}
			else {
				topo.lista.children('li:last').clone().prependTo( topo.lista );
				topo.lista.css({ left : -(topo.item_width*2) }).animate({left:-topo.item_width},site.animacao,function(){
					topo.lista.children('li:last').remove();
					topo.selected = topo.selected-1;
					if(topo.selected==0) topo.selected = topo.itens;
					topo.lista.find('li:eq(1) img').stop(true).animate({ opacity : 1.0 },site.animacao/2,function(){
						topo.nav.find('a').removeClass('disabled');
					});
				});
			}
		}
	}
}



// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################                                   ################ ################
// ################ ################              markups              ################ ################
// ################ ################                                   ################ ################
// ################ ################ ################ ################ ################ ################
// ################ ################ ################ ################ ################ ################


var markups = {
	escritorio : '\
		<div id="escritorio">\
			<div class="escritorio">\
				<div class="container">\
					<div class="text-box left">\
						<h2 class="second-header">{titulo1}</h2>\
						{texto1}\
					</div>\
					<div class="galeria right">\
						{galeria_escritorio}\
					</div>\
				</div>\
			</div>\
			<div class="sobre">\
				<div class="container">\
					<div class="galeria left">\
						{galeria_sobre}\
					</div>\
					<div class="text-box left">\
						<h2 class="second-header">{titulo2}</h2>\
						{texto2}\
					</div>\
				</div>\
			</div> <!-- fim sobre -->\
			<div class="footer"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
    	</div> <!-- fim escritorio -->\
	',
	contato : '\
		<div id="contato">\
			<div class="container">\
				<div class="left">\
					<h2 class="second-header">Entre em Contato</h2>\
					<div class="text-box">\
						<p>Para entrar em contato basta preencher os campos abaixo e entraremos em contato logo que possível.</p>\
					</div>\
					<form class="form contato" acao="enviaContato">\
						<div class="field-block" chave="contato">\
							<fieldset class="field default">\
								<p class="field-text"></p>\
								<label class="placeholder">\
									<input type="text" name="nome" class="placeholder-input" autocomplete="off" />\
									<span class="placeholder-text">Nome</span>\
								</label>\
							</fieldset>\
							<fieldset class="field default">\
								<p class="field-text"></p>\
								<label class="placeholder">\
									<input type="text" name="email" class="placeholder-input ipt-email" autocomplete="off" />\
									<span class="placeholder-text">E-mail</span>\
								</label>\
							</fieldset>\
							<fieldset class="field default">\
								<p class="field-text"></p>\
								<label class="placeholder">\
									<input type="text" name="telefone" class="placeholder-input ipt-phone" autocomplete="off" />\
									<span class="placeholder-text">Telefone</span>\
								</label>\
							</fieldset>\
							<fieldset class="field default textarea">\
								<p class="field-text"></p>\
								<label class="placeholder">\
									<textarea name="mensagem" class="placeholder-input" autocomplete="off"></textarea>\
									<span class="placeholder-text">Mensagem</span>\
								</label>\
							</fieldset>\
						</div>\
						<a href="#" class="form-button"><span class="form-bullet">Enviar</span></a>\
						<p class="form-alert"></p>\
					</form>\
				</div>\
				<div class="right">\
					<iframe class="mapa" width="430" height="223" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{mapa}&output=embed"></iframe>\
					<div class="midias">\
						<a href="https://www.facebook.com/vanessa.guerra.26.11" class="facebook" target="_blank" title="Facebook">Facebook</a>\
						<a href="#" class="twitter" target="_blank" title="Twitter">Twitter</a>\
					</div>\
					<div class="address">\
						<p>{telefone}</p>\
						<p>{endereco}</p>\
					</div>\
				</div>\
			</div>\
			<div class="footer"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
    	</div> <!-- fim contato -->\
	',
	projetos : '\
		<div id="projetos" class="{sessao}">\
			<div class="container">\
				<ul id="breadcrumbs">\
					<li>Onde você está?</li>\
					{breadcrumbs}\
				</ul>\
				<div id="category-box">\
					<a href="#" class="category-menu-button"></a>\
					<ul class="category-list {tamanho}">\
						{categorias}\
					</ul>\
				</div>\
				<form class="form busca" acao="search">\
					<div class="field-block" chave="busca">\
						<fieldset class="field default">\
							<p class="field-text"></p>\
							<label class="placeholder">\
								<input type="text" name="termo" class="placeholder-input" autocomplete="off" />\
								<span class="placeholder-text">Busca</span>\
							</label>\
						</fieldset>\
					</div>\
					<a href="#" class="form-button" title="Buscar"><span class="form-bullet">Buscar</span></a>\
				</form>\
				{conteudo}\
			</div>\
			<div class="footer"><a href="http://www.icub.com.br" target="_blank" class="cub"></a></div>\
		</div> <!-- fim projetos -->\
	',
	categoryItem : '\
		<li class="category-item"><a href="#!/categoria/{id}/{furl}" class="category-link">{titulo}</a></li>\
	',
	lista : '\
		<div id="projects-cycle">\
			<ul class="projects-list">\
				{itens}\
			</ul>\
		</div>\
		<div class="cycle-nav-box">\
			<div class="cycle-nav">{itens_nav}</div>\
		</div>\
	',
	itens : '\
		<div class="projects-box">\
			<a href="{link}" class="projects-link">\
				<div class="projects-title"><div><p>{nome}</p></div></div>\
				<img src="{foto}" width="295" height="165" alt="" />\
			</a>\
		</div>\
	',
	detalhes : '\
		<div class="title-box">\
			<a href="#!/categoria/{link}" title="Voltar" class="back-button"></a>\
			<p>{titulo}</p>\
		</div>\
		<div id="galeria_multimidia">\
			<div class="stage">\
				<a href="#" class="anterior" title="Anterior"></a>\
				<a href="#" class="proximo" title="Próximo"></a>\
				<em>&nbsp;{ampliacao}&nbsp;</em>\
				<ul>{legenda}</ul>\
			</div>\
			<div class="carousel {ipad}">\
				<a href="#" class="anterior" title="Itens anteriores"></a>\
				<a href="#" class="proximo" title="Próximos itens"></a>\
				<div id="carousel">\
					<ul>\
						{galeria}\
					</ul>\
				</div>\
			</div>\
		</div> <!-- fim galeria_multimidia -->\
		<div class="project-description">\
			<div class="text-box">{tx_maior}</div>\
			<div class="addthis_toolbox share-box">\
				<span>Compartilhe esse projeto</span>\
				<a class="addthis_button_facebook facebook" data-url="{url}"><img src="imagens/site/ic_facebook_pequeno.png" alt="" /></a>\
				<a class="addthis_button_twitter twitter" data-url="{url}"><img src="imagens/site/ic_twitter_pequeno.png" alt="" /></a>\
			</div>\
		</div> <!-- fim descricao -->\
	',
	noResults : '\
		<li class="projects-item no-results">Nenhum resultado encontrado.</li>\
	'
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

	var $url = site.hash.split('/');
	var $conteudo = $('#conteudo');

	var $pacote;
	var $dados = {
		sessao : $url[0],
		acao: 'carregaConteudo'
	};

	//marca o menu principal
	$('#menu a').removeClass('selected');
	if ( $dados.sessao ) {
		$('#menu a.' + $dados.sessao ).addClass('selected');
	}

	// home
	if ( !$dados.sessao || $dados.sessao == 'home' ) {

		$('body , html').animate({ scrollTop : 0 }, site.animacao );

		// content
		$conteudo.fadeOut( site.animacao ,function(){
			$conteudo.hide().html('');
			// overlay
			$('.loader').fadeOut('fast');
		})

		return false;
	}
	// escritorio
	else if ( $dados.sessao == 'escritorio' ) {
		// something
	}
	// categorias
	else if ( $dados.sessao == 'projetos' ) {
		var $page =  $.inArray( 'page', $url );
		var $start = ($page > -1) ? ($url[$page+1]-1) : 0;

		// não executa ajax, move passador
		if ( $('#projetos').hasClass( $dados.sessao ) ) {
			if ( !site.isiPad ) {
				$('.projects-list').cycle( $start );
			}
			else {
				site.catSwipe.slide( $start );
			}
			return;
		}
	}
	// projetos
	else if ( $dados.sessao == 'categoria' ) {
		var $page =  $.inArray( 'page', $url );
		var $start = ($page > -1) ? ($url[$page+1]-1) : 0;
		$dados.categoria = $url[1];

		// não executa ajax, move passador
		if ( $('#projetos').hasClass( $dados.sessao ) ) {
			if ( !site.isiPad ) {
				$('.projects-list').cycle( $start );
			}
			else {
				site.catSwipe.slide( $start );
			}
			return;
		}
	}
	// projeto
	else if ( $dados.sessao == 'projeto' ) {
		$dados.projeto = $url[1];
	}
	// busca
	else if ( $dados.sessao == 'busca' ) {
		var $page =  $.inArray( 'page', $url );
		var $start = ($page > -1) ? ($url[$page+1]-1) : 0;
		$dados.termo = decodeURI($url[1]);

		// não executa ajax, move passador
		if ( $('#projetos').hasClass( $dados.sessao ) ) {
			if ( !site.isiPad ) {
				$('.projects-list').cycle( $start );
			}
			else {
				site.catSwipe.slide( $start );
			}
			return;
		}
	}
	else if ( $dados.sessao == 'contato' ) {
		// something
	}




	console.log( $dados );




	// overlay
	$('.loader').fadeIn('fast');

	$pacote = JSON.stringify( $dados );

	$.ajax({
		type: 'POST',
		url: site.url + '/home/ajax',
		data: { ajaxACK : $pacote },
		dataType: 'json',
		success: function( $resposta ){

			// escritorio
			if ( $dados.sessao == 'escritorio' ) {

				var $galeria_sobre = '',
					$galeria_escritorio = '';

				for ( i=0; i<$resposta.escritorio.length; i++ ) {
					for ( j=0; j<$resposta.escritorio[i].imagens.length ; j++ ) {
						if (i==0) $galeria_escritorio += '<img src="'+ $resposta.escritorio[i].imagens[j] +'" alt="" />';
						if (i==1) $galeria_sobre += '<img src="'+ $resposta.escritorio[i].imagens[j] +'" alt="" />';
					}
				}

				$conteudo.fadeIn().html(
					markups.escritorio	.replace(/{texto1}/, $resposta.escritorio[0].texto )
										.replace(/{texto2}/, $resposta.escritorio[1].texto )
										.replace(/{titulo1}/, $resposta.escritorio[0].titulo )
										.replace(/{titulo2}/, $resposta.escritorio[1].titulo )
										.replace(/{galeria_escritorio}/, $galeria_escritorio )
										.replace(/{galeria_sobre}/, $galeria_sobre )
				);

				// galleries
				$('.galeria.left').cycle({
					speed:    site.animacao,
					timeout:  5000
				});
				$('.galeria.right').cycle({
					speed:    site.animacao,
					timeout:  5000
				});

			}
			// contato
			else if ( $dados.sessao == 'contato' ) {
				$conteudo.fadeIn().html(
					markups.contato	.replace(/{telefone}/, $resposta.telefone )
									.replace(/{endereco}/, $resposta.endereco )
									.replace(/{mapa}/, $resposta.mapa )
				);
			}
			// projetos / categoria / busca
			else {
				var $menuCategorias = '',
					$breadcrumbs = '',
					$content = '',
					$menu_tamanho = ( $resposta.menu.length > 10) ? 'big' : '';

				// menu de categorias
				for ( i=0; i<$resposta.menu.length; i++ ) {
					$menuCategorias += markups.categoryItem	.replace(/{id}/, $resposta.menu[i].id )
															.replace(/{furl}/, $resposta.menu[i].furl )
															.replace(/{titulo}/, $resposta.menu[i].titulo );
				}

				// projetos
				if ( $dados.sessao == 'projetos' ) {
					var $itens = '',
						$itens_nav = '',
						$aux = 0;

					$breadcrumbs = '<li><a href="#!/projetos">Categorias</a></li>';

					if ( $resposta.categorias.length ) {
						// itens loop
						for ( i=0 ; i<$resposta.categorias.length ; i++ ) {
							var $link = '#!/categoria/'+ $resposta.categorias[i].id +'/'+ $resposta.categorias[i].furl + '/page/1';
							$aux++;
							// create page
							if ($aux == 1) {
								$itens += '<li class="projects-item">';
								$itens_nav += '<a href="#"></a>';
							}
							$itens += markups.itens	.replace(/{link}/, $link )
													.replace(/{nome}/, $resposta.categorias[i].titulo )
													.replace(/{foto}/, $resposta.categorias[i].imagem );
							// close page
							if ($aux == 6) {
								$aux = 0;
								$itens += '</li>';
							}
						}
						// close page
						if ($aux > 0) $itens += '</li>';
					}
					else {
						$itens = markups.noResults;
					}

					// reset nav
					if ( !site.isiPad ) $itens_nav = '';

					$content = markups.lista.replace(/{itens}/, $itens )
											.replace(/{itens_nav}/, $itens_nav );
				}

				// categoria
				else if ( $dados.sessao == 'categoria' ) {
					var $itens = '',
						$itens_nav = '',
						$aux = 0;

					$breadcrumbs = '<li><a href="#!/projetos/page/1">Categorias</a> / <a href="#!/categoria/'+ $resposta.projetos[0].categoria.id +'/'+ $resposta.projetos[0].categoria.furl + '/page/1">'+ $resposta.projetos[0].categoria.titulo +'</a></li>';

					if ( $resposta.projetos.length ) {
						// itens loop
						for ( i=0 ; i<$resposta.projetos.length ; i++ ) {
							var $link = '#!/projeto/'+ $resposta.projetos[i].id +'/'+ $resposta.projetos[i].furl;
							$aux++;
							// create page
							if ($aux == 1) {
								$itens += '<li class="projects-item">';
								$itens_nav += '<a href="#"></a>';
							}
							$itens += markups.itens	.replace(/{link}/, $link )
													.replace(/{nome}/, $resposta.projetos[i].titulo )
													.replace(/{foto}/, $resposta.projetos[i].imagem );
							// close page
							if ($aux == 6) {
								$aux = 0;
								$itens += '</li>';
							}
						}
						// close page
						if ($aux > 0) $itens += '</li>';
					}
					else {
						$itens = markups.noResults;
					}

					// reset nav
					if ( !site.isiPad ) $itens_nav = '';

					$content = markups.lista.replace(/{itens}/, $itens )
											.replace(/{itens_nav}/, $itens_nav );
				}

				// busca
				else if ( $dados.sessao == 'busca' ) {
					var $itens = '',
						$itens_nav = '',
						$aux = 0;

					$breadcrumbs = '<li>Busca / '+ $dados.termo +'</li>';

					if ( $resposta.projetos.length ) {
						// itens loop
						for ( i=0 ; i<$resposta.projetos.length ; i++ ) {
							var $link = '#!/projeto/'+ $resposta.projetos[i].id +'/'+ $resposta.projetos[i].furl;
							$aux++;
							// create page
							if ($aux == 1) {
								$itens += '<li class="projects-item">';
								$itens_nav += '<a href="#"></a>';
							}
							$itens += markups.itens	.replace(/{link}/, $link )
													.replace(/{nome}/, $resposta.projetos[i].titulo )
													.replace(/{foto}/, $resposta.projetos[i].imagem );
							// close page
							if ($aux == 6) {
								$aux = 0;
								$itens += '</li>';
							}
						}
						// close page
						if ($aux > 0) $itens += '</li>';
					}
					else {
						$itens = markups.noResults;
					}

					// reset nav
					if ( !site.isiPad ) $itens_nav = '';

					$content = markups.lista.replace(/{itens}/, $itens )
											.replace(/{itens_nav}/, $itens_nav );
				}

				// projeto (detalhe)
				else {
					var $categorias = '',
						$itens = '',
						$aux = 0,
						$legenda = '',
						$ampliacao = '',
						$ipad = ( site.isiPad ) ? 'ipad' : '';

					$breadcrumbs = '<li><a href="#!/projetos/page/1">Categorias</a> / <a href="#!/categoria/'+ $resposta.item.categoria.id +'/'+ $resposta.item.categoria.furl + '/page/1">'+ $resposta.item.categoria.titulo +'</a></li>';

					// foto aompliada
					if ( $resposta.item.fotos.length )
						$ampliacao = '<img src="'+ $resposta.item.fotos[0].foto +'" alt="" />';

					// loop fotos
					for ( i=0; i<$resposta.item.fotos.length; i++ ) {
						$legenda += '<li>'+ $resposta.item.fotos[i].legenda +'</li>';

						if ( !site.isiPad ) {
							$itens += '<li><div><a href="'+ $resposta.item.fotos[i].foto +'"><img src="'+ $resposta.item.fotos[i].thumb +'" alt="" /></a></div></li>';
							continue;
						}

						$aux++;

						// create pager
						if ( $aux == 1 ) {
							$itens += '<li>';
						}

						$itens += '<div><a href="'+ $resposta.item.fotos[i].foto +'"><img src="'+ $resposta.item.fotos[i].thumb +'" alt="" /></a></div>';

						// end pager
						if ( $aux == 6 ) {
							$itens += '</li>';
							$aux = 0;
						}
					}

					// loop videos
					for ( i=0; i<$resposta.item.videos.length; i++ ) {
						$legenda += '<li>'+ $resposta.item.videos[i].legenda +'</li>';

						// youtube
						if ( $resposta.item.videos[i].tipo == 'youtube' ) {
							var $video = 'http://www.youtube.com/v/'+ $resposta.item.videos[i].video;
						}
						// vimeo
						else if ( $resposta.item.videos[i].tipo == 'vimeo' ) {
							var $video = 'http://www.youtube.com/v/'+ $resposta.item.videos[i].video;
						}

						if ( !site.isiPad ) {
							$itens += '<li><div><a href="'+ $video +'"><em></em><img src="'+ $resposta.item.videos[i].thumb +'" alt="" /></a></div></li>';
							continue;
						}

						$aux++;

						// create pager
						if ( $aux == 1 ) {
							$itens += '<li>';
						}

						$itens += '<div><a href="'+ $video +'"><em></em><img src="'+ $resposta.item.videos[i].thumb +'" alt="" /></a></div>';

						// end pager
						if ( $aux == 6 ) {
							$itens += '</li>';
							$aux = 0;
						}
					}

					$content = markups.detalhes	.replace(/{link}/, $resposta.item.categoria.id +'/'+ $resposta.item.categoria.furl + '/page/1' )
												.replace(/{titulo}/, $resposta.item.titulo )
												.replace(/{tx_maior}/, $resposta.item.texto )
												.replace(/{ampliacao}/, $ampliacao )
												.replace(/{legenda}/, $legenda )
												.replace(/{galeria}/, $itens )
												.replace(/{ipad}/g, $ipad )
												.replace(/{url}/g, window.location.href );


				}


				// mostra conteúdo
				$conteudo.fadeIn().html(
					markups.projetos.replace(/{conteudo}/, $content)
									.replace(/{categorias}/, $menuCategorias )
									.replace(/{tamanho}/, $menu_tamanho )
									.replace(/{breadcrumbs}/, $breadcrumbs )
									.replace(/{sessao}/, $dados.sessao )
				);

				// create swipe
				if ( $resposta.projetos || $resposta.categorias ) {
					// cria galeria de projetos
					if ( site.isiPad ) {
						site.catSwipe = new Swipe(document.getElementById('projects-cycle'),{
							callback : function(){
								$('#projetos .cycle-nav a:eq('+ this.getPos() +')').trigger('click');
							},
							startSlide : $start
						});
						$('#projetos .cycle-nav a').bind('click',function(event){
							event.preventDefault();

							// move
							site.catSwipe.slide( $(this).index() );

							// select
							$(this).addClass('activeSlide');
							$(this).siblings().removeClass('activeSlide');

							// page url
							site.pagerURL( $(this).index()+1 );

						}).eq( $start ).trigger('click');
						//.first().trigger('click');
					}
					else {
						$('.projects-list').cycle({
							fx: 		'scrollHorz',
							pager: 		'#projetos .cycle-nav',
							speed:		site.animacao,
							startingSlide : $start,
							timeout:	0,
							speed:		400,
							after: function(curr, next) {
								// page url
								site.pagerURL( $(next).index()+1 );
							}
						});
					}
				}

				// galeria de detalhes do projeto
				if ( $('.carousel').length ){
					galeria.init();
					if ( site.isiPad ) {
						galeria.swipe = new Swipe(document.getElementById('carousel'));
					}
					addthis.toolbox(".addthis_toolbox");
				}

			}

			// overlay
			$('.loader').fadeOut('fast');

			// site functions
			site.resize()
			site.scroll();
		}
	});
}

// ---------------- check rg
function checkPhone(obj){
	var v = obj.value;
	v = v.replace(/[^\s\d\-\(\)]/g,"");
	return obj.value = v;
}

// ---------------- check number
function checkNumber(obj){
	var v = obj.value;
	v = v.replace(/[^\d]/g,"");
	return obj.value = v;
}