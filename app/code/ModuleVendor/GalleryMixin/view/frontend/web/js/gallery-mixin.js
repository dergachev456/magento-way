define([
    'jquery',
    'fotorama/fotorama',
    'underscore',
    'matchMedia',
    'mage/template',
    'text!ModuleVendor_GalleryMixin/template/extend-gallery.html',
    'uiClass',
    'mage/translate'
], function ($, fotorama, _, mediaCheck, template, galleryTpl, Class, $t) {
    'use strict';
    var getMainImageIndex = function (data) {
        var mainIndex;

        if (_.every(data, function (item) {
            return _.isObject(item);
        })
        ) {
            mainIndex = _.findIndex(data, function (item) {
                return item.isMain;
            });
        }

        return mainIndex > 0 ? mainIndex : 0;
    };
    return function(gallery){

        gallery.prototype.initGallery = function () {
            var breakpoints = {},
                settings = this.settings,
                config = this.config,
                tpl = template(galleryTpl, {
                    next: $t('Next'),
                    previous: $t('Previous')
                }),
                mainImageIndex;

            if (settings.breakpoints) {
                _.each(_.values(settings.breakpoints), function (breakpoint) {
                    var conditions;

                    _.each(_.pairs(breakpoint.conditions), function (pair) {
                        conditions = conditions ? conditions + ' and (' + pair[0] + ': ' + pair[1] + ')' :
                            '(' + pair[0] + ': ' + pair[1] + ')';
                    });
                    breakpoints[conditions] = breakpoint.options;
                });
                settings.breakpoints = breakpoints;
            }

            _.extend(config, config.options);
            config.options = undefined;

            config.click = false;
            config.breakpoints = null;
            settings.currentConfig = config;
            settings.$element.html(tpl);
            settings.$element.removeClass('_block-content-loading');
            settings.$elementF = $(settings.$element.children()[0]);
            settings.$elementF.fotorama(config);
            settings.fotoramaApi = settings.$elementF.data('fotorama');
            $.extend(true, config, this.startConfig);

            mainImageIndex = getMainImageIndex(config.data);

            if (mainImageIndex) {
                this.settings.fotoramaApi.show({
                    index: mainImageIndex,
                    time: 0
                });
            }
        }
        return gallery;
    }
});