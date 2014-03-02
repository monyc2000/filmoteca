/*
 * 
 * Dependencies: 
 *	jQuery 1.9.1
 *	scrollTo 1.4
 *	serialScroll 1.2
 *	fancybox 2.0
 */

(function($) {

	var methods = {
		init: function(settings) {

			return $(this).each(function() {

				var ops = $.extend({}, $.fn.miniBillboard.defaults, settings);
				var $billboard = $(this);
				var $buttonNext = $billboard.find('> .screen > .next');
				var $buttonPrev = $billboard.find('> .screen > .prev');
				var $items = $billboard.find('li');

				$billboard.find('ul').width(($items.length * 100) + '%');
				$items.width((100 / $items.length) + '%');

				$billboard.before('<div id="aux" style="display:none"></div>');

				$billboard
						.addClass('billboard')
						.children('div.screen')
						.serialScroll({
							target: '.sections',
							items: 'li', // Selector to the items ( relative to the matched elements, '#sections' in this case )
							axis: 'x', // The default is 'y' scroll on both ways
							duration: 700, // Length of te animation (if you scroll 2 axes and use queue, then each axis take half this time)
							cycle: false, // Return to start when press the next button in the end
							force: true,
							step: 1,
							prev: 'div.prev',
							next: 'div.next',
							onBefore: function(event, targetElement, scrolledElement, objCollection, position) {

								var len = objCollection.length - 1;

								if (position === 0) {
									$buttonPrev.hide();
									$buttonNext.show();
								} else {
									if (position === len) {
										$buttonNext.hide();
										$buttonPrev.show();
									} else {
										$buttonPrev.show();
										$buttonNext.show();
									}
								}
							}
						});
				/* Esto es necesario por un error de fancybox */
				$('#' + $(this).attr('id') + ' li a').fancybox(ops.fancybox);
			});
		},
		//postData: Datos enviados a travéz de $.ajax. Fecha con formato dd-mm-yyy
		update: function(postData) {
			var $this = $(this);
			
			var day = postData.substr(0,2);
			var mount = postData.substr(3,2);
			var year = postData.substr(6,4);
					
			$.ajax({
				dataType: 'html',
				type: 'get',
				url: $(this).data('url') + '/day:' + day + '/mount:' + mount + '/year:' + year ,
				success: function(html) {
					$this.html(html);

					var tmp = $this.clone();
					var id = $this.attr('id');
					$this.remove();
					$('#aux').after(tmp);
					methods['init'].apply($('#' + id), arguments);
				},
				error: function(e) {
					console.log(e);
				}
			});
		}


	};

	$.fn.miniBillboard = function() {

		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.miniBillboard');
			return this;
		}

		return method.apply(this, arguments);

	}

	$.fn.miniBillboard.defaults = {
		fancybox: {
			type: 'ajax',
			maxWidth: 1024,
			minWidth: 280
		}
	};

})(jQuery);