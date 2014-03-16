if (typeof functions === 'undefined')
    functions = new Array();

functions.push(function() {
    $('#filters-menu').filtersMenu();

    var url = document.URL;
    var params = url.substring(
            url.indexOf('filter:'),
            url.length);
    var filter = params.substring(7, params.length);

    $('#filters-menu').filtersMenu('addFilter', filter);

    $('#items').find('a').fancybox({
        type: 'ajax',
        maxWidth: 900,
        minWidth: 250
    });

    $('#subscription-billboard').on('submit',function(event){
        event.preventDefault();

        $this = $(this);

        $.ajax({
            url: '/billboards/subscribe',
            data: {
                email: $this.find('input.email').val()
            },
            type: 'post',
            dataType: 'html',
            success: function(html){
                $this.append(html);
            },
            error:function(){
                alert('Error de comunicación');
            }
        });

    });
});