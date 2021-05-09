/**
 * 需要如下文件进行支持
 * jquery.min.js
 * bootstrap.min.js
 * bootstrap.min.css
 * 
 * 通用 js 文件
 */


/**
 * 停止事件
 * @param Event e 
 * @param boolen stopIm 如果为true, 则剩余的事件也不再传播
 */
var stopEvent = function( e, stopIm ) {
    e.preventDefault();
    e.stopPropagation();
    if(stopIm) {
        e.stopImmediatePropagation();
    }
};



var cado = { 
    _s: {
        click: false,
    } 
};
cado.message = (function(){
    var Message = function() {
        this.status = 0;
        this.init();
    };
    Message.prototype = {
        init: function() {
            this.status = 0;
        },
        message: function(content, timer) {
            alert(content);
            var defer = new $.Deferred();
            if(typeof timer == 'number') {
                setTimeout(function() {
                    defer.resolve(content);
                }, timer);
            } else {
                defer.resolve(content);
            }
            return defer.promise();
        },
        info: function() {
            return this.message.apply(this, arguments);
        },
        success: function() {
            return this.message.apply(this, arguments);
        },
        error: function() {
            return this.message.apply(this, arguments);
        }
    };
    return new Message();
})();

cado.click = function( click ) {
    if(click === false) {
        cado._s['click'] = false;
        return false;
    }
    var result = cado._s['click'];
    if(result) {
        return true;
    }
    cado._s['click'] = true;
    return false;
};
cado.loading = function( bool ) {
    if(bool) {
        console.log('load::begin');
    } else {
        console.log('load::end');
        cado.click(false);
    }
};








