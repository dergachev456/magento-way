define(['uiComponent', 'ko'], function(Component, ko) {
   'use strict';

   return Component.extend({
       _counter : ko.observable('Loading....'),
       initialize : function() {
           this._super();
           setInterval(this.updateTime.bind(this), 1000);
       },

       getTime: function () {
            return this._counter;
       },

       updateTime: function() {
           this._counter(new Date());
       }
   });
});