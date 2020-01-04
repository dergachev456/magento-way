define(
  [
    'jquery',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/view/floated-labels'
  ], function ($, navigator, quote, floated) {
    'use strict';

    return function (targetModule) {
        return targetModule.extend({

          checkAvailable: $.proxy(floated.checkAvailable, floated),

          initObservable: function() {
              this._super();
              return this;
          }
        });
    };
});