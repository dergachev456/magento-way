define(
    [
        'jquery',
        'ModuleVendor_PopupSubscribe/js/helper',
        'Magento_Ui/js/modal/modal',
    ],
    function($) {
        "use strict";

        var bindOptions = {
            'content': $('#popup'),
            'emailSubmit': $('#popup-newsletter-validate-detail button'),
            'submitErrors': $('#popup-newsletter-error')
        };

        $.widget('VendorName.Popup', {
            options: {
                type: 'popup',
                responsive: true,
                clickableOverlay: true,
                title: $.mage.__('Want to receive latest news?'),
                autoOpen: true,
                modalClass: 'popup-subscribe',
                buttons: [{
                    text: $.mage.__('No'),
                    class: '',
                    click: function() {
                        this.closeModal();
                    }
                }]
            },

            _create: function() {
                this._bind();
            },

            _bind: function() {
                var self = this;

                if(window.loggedUser != 1 && this.checkStorage() != '1'){
                    bindOptions.content.modal(this.options);
                    bindOptions.content.on('modalclosed', this.setLocalData);
                    bindOptions.emailSubmit.on('click', self.setLocalData);
                }
            },

            setLocalData: function(event) {
                if(event) {
                    setTimeout(function () {
                        if(!bindOptions.submitErrors.length) {
                            window.sessionStorage.setItem('subscribed', '1');
                        }
                    },200);
                } else {
                    window.sessionStorage.setItem('subscribed', '0');
                }
            },

            checkStorage: function() {
                var choice = window.sessionStorage.getItem('subscribed');
                return choice;
            }
        });
        return $.VendorName.Popup;
    }
);