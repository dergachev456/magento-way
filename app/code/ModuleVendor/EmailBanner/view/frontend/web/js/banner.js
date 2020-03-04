define([
    'jquery',
    'uiElement'

], function($, Component) {

    'use strict';

    return Component.extend({
        options: {
            cookie : $.cookie('clrwow-newsletter'),
            popup : $('#subscribe-new-popup'),
            message: $('.newsletter-message'),
            form: $('#newsletter-header-subscribe')
        },

        initialize: function () {
            this._super();
            this.showBanner();
            this._bind();
        },

        showBanner: function () {
            var self = this;

            if (!this.options.cookie) {
                setTimeout(function(){
                    $("body").addClass("has-newsletter-banner");
                    self.options.popup.slideDown("slow");
                }, 2000);
            }
        },

        _bind: function () {
            var self = this,
                popup = this.options.popup,
                message = this.options.message;

            popup.submit(function(event) {
                event.preventDefault();
                message.hide();

                var email = $("#cm_email").val();

                if (!self.newsletterIsEmail(email)) {
                    message.html(self.invalidEmail);
                    message.show();
                    return;
                }

                var form_data = self.options.form.serialize();
                self._ajaxRequest(form_data);
            });
        },

        _ajaxRequest : function(form_data) {
            var self = this;

            $.ajax({
                url : self.getFormUrl,
                type: "POST",
                data : form_data,
                dataType: 'json',
                timeout: 7000,
            })
                .done(self.onSuccess.bind(self))
                .fail(self.onFail.bind(self));
        },

        onSuccess: function (response) {
                var self = this,
                    form = this.options.form,
                    message = this.options.message,
                    popup = this.options.popup;

                if (response.response == "Success") {
                    $.cookie('clrwow-newsletter','newsletter', 90);

                    form.fadeOut("slow", function() {
                        message.html(self.getSuccessMessage);
                        message.fadeIn("slow");
                    });

                    setTimeout(function() {
                        popup.slideUp("slow", function() {
                            $("body").removeClass("has-newsletter-banner");
                        });
                    }, 5000);
                } else {
                    message.html(self.getFailMessage);
                    message.show();
                }
        },

        onFail : function () {
                var message = this.options.message;
                message.html(self.getFailMessage);
                message.show();
        },

        newsletterIsEmail: function(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    });
});
