define([
    'jquery',
], function ($) {
    'use strict';

    $.widget('mage.changeProductCount', {
        options: {
            formInputQtySelector: '.input-text.qty',
            decreaseButtonSelector: '.number-decrease',
            increaseButtonSelector: '.number-increase'
        },

        /**
         */
        _create: function () {
            var self = this;
            var options = this.options;
            var $qty = $(options.formInputQtySelector, this.element);
            var $decrease = $(options.decreaseButtonSelector, this.element);
            var $increase = $(options.increaseButtonSelector, this.element);

            $increase.on('click', function() {
                self.countUp($qty)
            });
            $decrease.on('click', self.countDown($qty));

        },
        countUp : function($qty) {
                var currentValue = $qty.val();
                $qty.val(++currentValue);
        },
        countDown : function($qty) {
                var currentValue = $qty.val() > 1 ? $qty.val() : 1;
                $qty.val(--currentValue);
        }
    });

    return $.mage.changeProductCount;
});
