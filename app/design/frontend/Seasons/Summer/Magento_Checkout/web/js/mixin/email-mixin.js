define([
    'jquery',
    'Magento_Customer/js/model/customer'
], function($, customer) {
    'use strict';

    var mixin = {
        userEmail: customer.customerData.email
    };

    return function(email) {
        return email.extend(mixin);
    }
});