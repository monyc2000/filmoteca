if (typeof functions === 'undefined')
    functions = new Array();

functions.push(function() {
    $('#filters-menu').billboardWithFilters().hideshowSubmenus();

    var url = document.URL;
    var params = url.substring(
            url.indexOf('filter:'),
            url.length);
    var filter = params.substring(7, params.length);

    $('#filters-menu').billboardWithFilters('addFilter', filter);

    $('#items').find('a').fancybox({
        type: 'ajax',
        maxWidth: 900,
        minWidth: 250
    });
});