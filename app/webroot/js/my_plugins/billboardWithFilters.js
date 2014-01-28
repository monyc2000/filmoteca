/*
 * 
 * Dependencies: 
 *	jQuery 1.9.1
 *	fancybox 2.0
 */

(function($) {

	var methods = {
		init: function(settings) {

			return $(this).each(function() {

				var $this = $(this);
				var self = this;
				var ops = $.extend({}, $.fn.billboardWithFilters.defaults, settings);

				$this.data('ops', ops);

				$this.on('click', 'a', function(event) {
					event.preventDefault();

					var clicked = $(this);

					if (clicked.hasClass('selected')) {
						clicked.removeClass('selected');
					} else {
						$this.find('a').removeClass('selected');
						clicked.addClass('selected');
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

			$selectedFilters.each(function() {
				strFilters += "." + $(this).data('filter');
			});

			if (strFilters !== '' && strFilters !== '.') {
				$(ops.items + strFilters, ops.containerItems).show();
				$(ops.items, ops.containerItems).not(strFilters).hide();
			} else {
				$(ops.items, ops.containerItems).show();
			}


			return methods['showAppliedFilters'].apply(this);

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
			var a = $(this).find("a[data-filter='" + filter + "']");
			if (action === 'add') {
				a.addClass('selected');
			} else {
				a.removeClass('selected');
			}

			return methods['applyFilters'].apply(this);
		},
		showAppliedFilters: function() {
			var $this = $(this);
			var ops = $this.data('ops');
			var $selectedFilters = $this.find('a.selected');

			var results = $(ops.containerItems).find(ops.items + ':visible').length;

			$this.data('ops').showAppliedFilters.apply(this, [$selectedFilters, results]);
			return this;
		}
	};

	$.fn.billboardWithFilters = function() {

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

	$.fn.billboardWithFilters.defaults = {
		containerItems: '#items',
		items: 'li.item', // Relativo a containerItems
		showAppliedFilters: function(selectedFilters, results) {
		},
		show: 'blind',
		hide: 'blind',
		filtersSelector: '> ul > li > ul > li' //Selector que elementos serviran de filtros.
	};

})(jQuery);

