define(
    [
        'jquery',
        'uiComponent'
    ], function ($, Component) {

    "use strict";

    return Component.extend({
        initialize : function() {
            this._super();
            this._bind();
            this.addClass();
        },

        _bind: function() {
            var self = this;
            $(window).scroll(function(){
                self.addClass();
            });
        },

        addClass: function() {
            if ($(window).scrollTop() >= 50) {
                $('.header.content').css({
                    'position': 'fixed',
                    'top': '0',
                    'left': '0',
                    'width': '100%',
                    'z-index': '10000'
                });
            } else {
                $('.header.content').css({
                    'position': 'unset'
                });
            }
        }
    });
});