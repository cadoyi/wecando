
jQuery(function( $ ) {
    var $body = $('body');
    $(document).on('ajaxStart', function( e ) {
        var loading = $('#loading');
        if(!loading.length) {
            $body.append('<div id="loading"><i class="fa fa-spinner fa-pulse"></i></div>');
        }
        $body.addClass('loading');
    }).on('ajaxStop', function( e ) {
        $body.removeClass('loading');
    }).on('ajaxComplete', function(e, xhr) {
        xhr.fail(function(xhr, error, message) {
            alert('服务器繁忙, 请稍后再试');
        });
    });


});