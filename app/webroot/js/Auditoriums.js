if (typeof functions === 'undefined')
	functions = new Array();

functions.push(function() {

	$('#filters-menu').filtersMenu();

	$('#items').find('a').fancybox({
		type: 'ajax',
		maxWidth: 900,
		minWidth: 250
	});
});

