define(['jquery'], function($){
    'use strict';

    return function(template) {
        window.loggedUser = template.isLoggedIn;
    }
});