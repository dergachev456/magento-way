/**
 * @category    Ifuel
 * @package     Magento_ConfigurableProduct
 * @copyright    Copyright (C) 2020 iFuel (www.ifuelinteractive.com)
 * @author       Sergey Kosenko <skosenko@ifuelinteractive.com>
 */

define([
        'jquery',
        'uiComponent'
    ],
    function($, Component) {
        'use strict';

        return Component.extend({
            options: {
                select: $('.field.configurable select')
            },

            initialize: function() {
                    self = this;
                   this._super();
                   this._bind();
                   this.options.select.each(self.setActive);
            },

            _bind : function() {
                var self = this;
                this.options.select.change(self.setActive);
            },

            setActive: function() {
                if(!$(this).children('option:selected').val() == '') {
                    $(this).parent().parent().addClass('active');
                } else {
                    $(this).parent().parent().removeClass('active');
                    $(this).parent().parent().nextAll().removeClass('active');
                }
            }
        })
    }
);
