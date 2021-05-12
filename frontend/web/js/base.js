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
        this.id = 'cado_msg';
        this.ele = null;
    };
    Message.prototype = {
        _init: function() {
            var self = this;
            if(this.ele) {
                return;
            }
            var html = '<div id="'+this.id+'" style="display:none;"><div class="msg"></div></div>';
            this.ele = $(html);
            $('body').append(this.ele);
            this.ele.find('.msg').on('click', function( e ) {
                self.ele.hide();
            });
        },
        _display: function( content , timer ) {
            this._init();
            var self = this;
            var defer = new $.Deferred();
            this.ele.find('.msg').html(content);
            this.ele.show();
            if(typeof timer != 'number') { 
                timer = 1500;
            }
            setTimeout(function() {
                defer.resolve(content);
            }, timer);
            defer.done(function( content ) {
               self.ele.hide();
            });
            return defer.promise();
        },
        message: function(content, timer) {
            return this._display(content, timer);
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








