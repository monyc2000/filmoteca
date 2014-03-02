/*
 * Oculta y mustra los submenus de un menu.
 * Dependencies: 
 *	jQuery 1.9.1
 */

(function($) {

	var methods = {
		init: function(settings) {

			return $(this).each(function() {

				var $this = $(this);
				var self = this;
				var ops = $.extend({}, $.fn.filtersMenu.defaults, settings);

				$this.data('ops', ops);

				$.fn.filtersMenu.behaviorMenu.apply(this);

				$this.on('click', 'a', function(event) {
					event.preventDefault();

					var clicked = $(this);
					var selecteds = $this.find('.selected');

					if (ops.multiselect) {
						clicked.toggleClass('selected');
					} else {

						if (ops.multicategory) {
							var category = clicked.data('category');
							var elemsOfCat = selecteds
									.filter('[data-category="' + category + '"]');

							if (elemsOfCat.length !== 0) {
								elemsOfCat.removeClass('selected');
							}

							clicked.toggleClass('selected');
						} else {
							var x = clicked.hasClass('selected');
							selecteds.removeClass('selected');
							clicked.toggleClass('selected',!x);
						}
					}

					methods['applyFilters'].apply(self);

				});
			});
		},
		applyFilters: function() {

			var $this = $(this);
			var ops = $this.data('ops');
			var strFilters = '';
			var $selectedFilters = $this.find('a.selected');
			var $selectedItems = null;
			var result = 0;

			$selectedFilters.each(function() {
				strFilters += "." + $(this).data('filter');
			});

			
			if (strFilters !== '' && strFilters !== '.') {
				$selectedItems = $(ops.items + strFilters, ops.containerItems);
				$selectedItems.show();
				result = $selectedItems.length;
				$(ops.items, ops.containerItems).not(strFilters).hide();
			} else {
				result = $(ops.items, ops.containerItems).show().length;
			}
			

			if (result === 0)
				$(ops.withoutResults).show();
			else
				$(ops.withoutResults).hide();
			
			$(ops.results).html(result);

			return this;

		},
		removeFilter: function(filter) {
			return methods['addOrRemoveFilter'].apply(this, ['remove', filter]);
		},
		removeAll: function() {
			$(this).find('li.selected').removeClass('selected');
			return methods['applyFilters'].apply(this);
		},
		addFilter: function(filter) {
			return methods['addOrRemoveFilter'].apply(this, ['add', filter]);
		},
		addOrRemoveFilter: function(action, filter) {
			var a = this.find("a[data-filter='" + filter + "']");
			if (action === 'add') {
				a.addClass('selected');
			} else {
				a.removeClass('selected');
			}

			return methods['applyFilters'].apply(this);
		}
	};



	$.fn.filtersMenu = function() {

		var method = arguments[0];

		if (methods[method]) {
			method = methods[method];
			arguments = Array.prototype.slice.call(arguments, 1);
		} else if (typeof (method) == 'object' || !method) {
			method = methods.init;
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.filtersMenu');
			return this;
		}

		return method.apply(this, arguments);

	};

	/**
	 * Esta funcion depende de como esté hecho el menú.
	 * Puede ser sobre-escrita.
	 * @returns {undefined}
	 */
	$.fn.filtersMenu.behaviorMenu = function() {
		var $this = $(this);
		var showAppliedFilters = function() {
			var $selectedFilters = $this.find('.selected');
			var $appliedFilters = $('#applied-filters');
			var str = '';
			var tmp = $('<a>', {
				href: "#",
			});

			$selectedFilters.each(function() {
				str += $(this).html() + ',';
			});
			str = str.substr(0, str.length - 1);

			tmp.data('filter', str);
			tmp.html(str);
			$appliedFilters.html(tmp);
		}

		$this.on('click', '>ul >li', function() {

			var x = $(this).children('ul').is(':hidden');
			$this.find('ul li ul:visible').hide('blind');

			if (x) {
				$(this).children('ul').show('blind');
			}

			showAppliedFilters();
		});

	}

	$.fn.filtersMenu.defaults = {
		containerItems: '#items',
		items: 'li.item', // Relativo a containerItems
		show: 'blind',
		hide: 'blind',
		results : '#results',
		withoutResults: '#without-results',
		filtersSelector: '> ul > li > ul > li', //Selector que elementos serviran de filtros.
		multicategory: false, //Permite seleccionar más de un filtro de distintas categorias, pero no de la misma.
		multiselect: false //Permite seleccionar más de en un filtro de la misma categoría.
	};

})(jQuery);



