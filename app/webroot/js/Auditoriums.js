if (typeof functions === 'undefined')
	functions = new Array();

functions.push(function() {

	$('#filters-menu').billboardWithFilters().hideshowSubmenus();

	$('#items').find('a').fancybox({
		type: 'ajax',
		maxWidth: 900,
		minWidth: 250
	});
});

