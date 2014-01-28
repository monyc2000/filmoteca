if (typeof functions === 'undefined')
	functions = new Array();
functions.push(function() {

	$('#billboard').miniBillboard({
		fancybox: {
			type: 'ajax',
			maxWidth: 1024,
			minWidth: 240
		}
	});

	$('#presentation').presentation();

	$('#presentation .controls a').click(function() {
		var $a = $(this).addClass('selected');
		$a.siblings('.selected').removeClass('selected')
		$('#presentation').presentation('goto', [$a.data('index')]);
	});

	$('#calendar').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function(date){
			$('#billboard').miniBillboard('update',date);
			$(this).find('.ui-state-highlight').removeClass('ui-state-highlight');
		}
	})
	//No resaltamos la fecha actual
			.find('.ui-datepicker-today')
			.removeClass("ui-datepicker-today ui-datepicker-days-cell-over ui-datepicker-current-day")
			.children('a')
			.removeClass("ui-state-highlight ui-state-active ui-state-hover");
	$('#calendar-button').on('click', function() {
		$('#calendar').toggle();
	});
});