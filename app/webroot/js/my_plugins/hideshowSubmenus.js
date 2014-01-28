/*
 * Oculta y mustra los submenus de un menu.
 * Dependencies: 
 *	jQuery 1.9.1
 */

(function($) {

	var methods = {
		init: function(settings) {
			var $menu = $(this);

			this.on('click', '> ul > li', function() {
				var x = $(this).children('ul').is(':hidden');
				$menu.find('ul li ul:visible').hide('blind');

				if (x) {
					$(this).children('ul').show('blind');
				}
			});

			return this;
		}
	};

	$.fn.hideshowSubmenus = function() {

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

})(jQuery);



