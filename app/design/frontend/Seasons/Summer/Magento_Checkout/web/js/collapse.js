define([
    'jquery',
    'collapsible',
    'matchMedia',
    'domReady!',
], function ($) {
    'use strict';

    var helpers = {
        domReady: function() {
            var accordionResize = function($accordions) {
                $accordions.forEach(function(element, index){
                    var $accordion = $(element);
                    mediaCheck({
                        media: '(min-width: 768px)',
                        entry: function() { // desktop
                            $accordion.collapsible('activate');
                            $accordion.collapsible('option', 'collapsible', false);
                        },
                        exit: function() { // mobile
                            $accordion.collapsible('deactivate');
                            $accordion.collapsible('option', 'collapsible', true);
                        }
                    });
                });
            };

            var $container = $('.product-accordion'),
                $accordions = [],
                accordionOptions = {
                    collapsible: true,
                    header: '.trigger',
                    trigger: '',
                    content: '.product-list',
                    openedState: 'active',
                    animate: false
                };

            $container.children("div").each(function(index, elem){
                var $this = $(elem),
                    $accordion = $this.collapsible(accordionOptions);

                $accordions.push($accordion);
            });

            accordionResize($accordions);
        }
    };

    return function() {
        helpers.domReady();
    }
});
