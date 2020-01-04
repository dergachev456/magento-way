define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($) {
        "use strict";

        $.widget('VendorName.Popup', {
            options: {
                modalForm: '#popup',
                modalButton: '.popup-open'
            },
            _create: function() {
                this.options.modalOption = this.getModalOptions();
                this._bind();
            },
            getModalOptions: function() {
                var options = {
                    type: 'popup',
                    responsive: true,
                    clickableOverlay: true,
                    title: $.mage.__('Phone numbers'),
                    modalClass: 'popup',
                    buttons: [{
                        text: $.mage.__('Close'),
                        class: '',
                        click: function() {
                            this.closeModal();
                        }
                    }]
                };
                return options;
            },
            _bind: function() {
                var modalOption = this.options.modalOption;
                var modalForm = this.options.modalForm;
                $(document).on('click', this.options.modalButton, function() {
                    $(modalForm).modal(modalOption);
                    $(modalForm).trigger('openModal');
                })
            }
        });
        return $.VendorName.Popup;
    }
);