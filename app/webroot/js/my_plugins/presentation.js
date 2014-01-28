/*
 * 
 * Dependencies: 
 *	jQuery 1.9.1
 */

(function($) {


	var methods = {
		init: function(settings) {

			return $(this).each(function() {

				var $this = $(this);
				var ops = $.extend({}, $.fn.presentation.defaults, settings);
				ops.imgs = $this.find('li img');
				ops.w = parseInt(ops.imgs.width());
				ops.totalImg = $this.find('ul li').length;
				ops.visibleImg = $(ops.imgs.get(0));

				ops.opsAnimation = {
					marginTop: 0,
					opacity: 1
				};

				ops.opsCssStrips = {
					marginTop: '-200px',
					width: (100 / ops.numStrips) + '%',
					opacity: 0,
					float: 'left',
					overflow: 'hidden'
				};


				$(window).resize(function() {
					if (typeof sizewait != 'undefined') {
						clearTimeout(sizewait);
					}
					sizewait = setTimeout(function() {
						$this.find('ul').height(ops.imgs.height())
					}, 50);
				});

				$(window).resize();

				ops.imgs.hide();

				$this.data('ops', ops);

				methods['goto'].apply(this, [0]);
			});
		},
		goto: function(newIndex) {
			var $this = $(this);
			var ops = $this.data('ops');

			newIndex = Math.abs(newIndex);
			methods['makeTransition'].apply(this,
					[ops.visibleImg,
						ops.imgs.get(newIndex),
						ops.beforeTrans,
						ops.afterTrans]);
		},
		/**
		 * Realiza una transición desde la imagen fromImg hacia imagen 
		 * toImg.
		 * 
		 * @param {img tag} $toImg imagen hacia la cual se hara la transición.
		 * @param {img tag}
		 * @param {fun} funciona que se ejecuta antes de iniciar la transición.
		 * @returns {undefined}
		 */
		makeTransition: function(fromImg, toImg, beforeFun, afterFun) {
			var $fromImg = $(fromImg);
			var $toImg = $(toImg);
			var ops = $(this).data('ops');
			var ns = $toImg.siblings('.strip');
			var src = $toImg.attr('src');

			var strip = $('<div class="strip"></div>');
			var img = $('<img src="' + src + '">');
			strip.css(ops.opsCssStrips);

			beforeFun.apply(this, []);
			$fromImg.hide();
			//Actualizamos la imagen visible
			ops.visibleImg = $toImg;
			$(this).data('ops', ops);

			/**
			 * Crea y agrega las tiras de la imagen al padre de la imagen
			 * para después mostrarlas una después de la otra y así lograr
			 * un efecto de persiana. Una vez que todas las tiras
			 * haya sido mostradas, éstas son ocultadas y se muestras la
			 * imagen orignal.
			 * 
			 * - Para lograr el efecto de tira se mueve el background
			 * de cada tira.
			 * - Se establece la opacidad de la imagen a 0 antes de ocultarla
			 * para que se conserve la altura.
			 */
			var f = function(i) {
				if (i < ops.numStrips) {
					var cloneStrip = strip.clone();
					var cloneImg = img.clone();
					var x = 100 * i;
					cloneImg.css({
						display: 'block',
						marginLeft: '-' + x + '%',
						width: 100 * ops.numStrips + '%'
					});
					$toImg.parent().append(cloneStrip.append(cloneImg));
					cloneStrip.delay(ops.timeTransition * i).animate(ops.opsAnimation);

					f(i + 1);
				} else {
					finishAnimation();
				}
			};

			/**
			 * Después de que termina la animación, oculta las tiras
			 * y muestra la imagen original. Además, recibe como parámetro
			 * una función que se ejecuta en el contexto del plugin (el contexto) es this.
			 * una vez que todo haya terminado.
			 * 		
			 */
			var finishAnimation = function() {
				setTimeout(function() {
					$toImg.show();
					$toImg.siblings('.strip').css(ops.opsCssStrips).stop().hide();
					afterFun.apply(this, []);
				}, ops.timeTransition * (ops.numStrips + 1));
			};

			$toImg.hide();
			if (ns.length === 0) {
				f(0);
			} else {
				ns.css({opacity: 0}).show();
				ns.each(function(i) {
					$(this).delay(ops.timeTransition * i).animate(ops.opsAnimation);
				});
				finishAnimation();
			}
		}
	};

	$.fn.presentation = function() {

		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.vAnimate');
			return this;
		}

		return method.apply(this, arguments);
	};

	$.fn.presentation.defaults = {
		numStrips: 6,
		timeTransition: 200,
		beforeTrans: function() {
			$('#presentation').find('.controls').fadeOut();
		},
		afterTrans: function() {
			$('#presentation').find('.controls').fadeIn();
		}
	};

})(jQuery);
