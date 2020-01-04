/**
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Hearst
 * @package     Magento_Checkout
 * @copyright   Copyright (c) 2019 Guidance Solutions (http://www.guidance.com)
 */

define([
    'jquery'
  ],
  function($) {
    'use strict';

    return {
        checkAvailable: function(){  // Check if is loaded last element on list
          var self = this;
          $(document).ready(function() {
            var existCondition = setInterval(function () {
              if ($('[name="shippingAddress.postcode"] .input-text').length) {
                clearInterval(existCondition);
                self.floatedLabels();
              }
            }, 1000);
          });
        },

        floatedLabels : function() { // adding active class to a grandparent elementgit
          var input = $('.input-text');
          input.each(function(){
            if($(this).val()) {
              $(this).parent().parent().addClass('active');
            }
          });
          input.on({
            'focus' : function() {
              $(this).parent().parent().addClass('active');
            },
            'blur' : function() {
              if(!$(this).val()) {
                $(this).parent().parent().removeClass('active');
              }
            }
          })
        }
      }
    }
);