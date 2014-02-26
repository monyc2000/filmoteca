/*!
 * Buttons helper for fancyBox
 * version: 1.0.5 (Mon, 15 Oct 2012)
 * @requires fancyBox v2.0 or later
 *
 * Usage:
 *     $(".fancybox").fancybox({
 *         helpers : {
 *             buttons: {
 *                 position : 'top'
 *             }
 *         }
 *     });
 *
 */
(function($) {
//Shortcut for fancyBox object
	var F = $.fancybox;
	//Add helper object
	F.helpers.menu = {
		defaults: {
			skipSingle: false, // disables if gallery contains single image
			position: 'top', // 'top' or 'bottom'
		},
		list: null,
		beforeLoad: function(opts, obj) {
			//Remove self if gallery do not have at least two items

			if (opts.skipSingle && obj.group.length < 2) {
				obj.helpers.buttons = false;
				obj.closeBtn = true;
				return;
			}

			//Increase top margin to give space for buttons
			obj.margin[ opts.position === 'bottom' ? 2 : 0 ] += 30;
		},
		afterShow: function(opts, obj) {
			var buttons = this.buttons;
			var $this = this

			if (!buttons) {

				var $menu = obj.element.parent().parent().children('ul').clone();
				this.list = $('<div id="fancybox-menu"></div>').html($menu)
						.addClass(opts.position)
						.appendTo('body');

				this.list.find('a').each(function() {
					$(this).click(function() {
						console.log($('#' + $(this).parent().parent().data('itemid')));
						var $item = $('#' + $(this).parent().parent().data('itemid'));
						$item.find('.' + $(this).data('linkto')).click();
					});
				});
			}
		},
		onUpdate: function(opts, obj) {

		},
		beforeClose: function() {
//			if (this.list) {
//				this.list.remove();
//			}

			this.list = null;
			this.menu = null;
		}
	};
}(jQuery));
