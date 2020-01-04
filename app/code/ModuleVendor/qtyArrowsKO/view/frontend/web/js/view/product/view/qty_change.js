define([
    'ko',
    'uiComponent'
], function (ko, Component) {
    'use strict';
    return Component.extend({
        qty : ko.observable(),

        initialize: function () {
            this._super();
            this.qty(this.defaultQty);
            this.qtyValidation();
        },
        decreaseQty: function() {
                this.qty(parseInt(this.qty()) - 1);
        },
        increaseQty: function() {
                this.qty(parseInt(this.qty()) + 1);
        },

        qtyValidation: function() {
            var self = this;

            this.qty.subscribe(function(v) {
                if(v <= 0 || isNaN(v)) {
                    self.qty(1);
                }
            })
        }
    });
});