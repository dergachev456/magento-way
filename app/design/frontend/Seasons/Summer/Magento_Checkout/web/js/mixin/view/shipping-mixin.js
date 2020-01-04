define([
    'jquery',
    'Magento_Checkout/js/view/floated-labels'
  ],
  function($, floated) {
    'use strict';

    return function(shipping) {
      return shipping.extend({
        defaults: {
          shippingMethodItemTemplate: 'Magento_Checkout/shipping-address/shipping-method-custom-item'
        },
        initialize: function () {
          this._super();
          this.checkAvailable();
        },
        checkAvailable: $.proxy(floated.checkAvailable, floated)
      });
    }
  }
);