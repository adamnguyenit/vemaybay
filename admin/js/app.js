(function () {
    'use strict';
    /**
     * @ngdoc overview
     * @name loopbackApp
     * @description
     * # loopbackApp
     *
     * Main module of the application.
     */
    angular
        .module('loopbackApp', [
            'angular-loading-bar',
            'angular.filter',
            'angularBootstrapNavTree',
            'btford.markdown',
            'oitozero.ngSweetAlert',
            'config',
            'formly',
            'formlyBootstrap',
            'monospaced.elastic',
            'ngAnimate',
            'ngCookies',
            'ngResource',
            'ngRoute',
            'ngSanitize',
            'ngTouch',
            'ui.bootstrap',
            'ui.codemirror',
            'ui.grid',
            'ui.router',
            'toasty',
            'autofields',
            'gettext',
            'angular-underscore/filters',
            'schemaForm',
            'ui.select',
            'com.module.core',
            'com.module.settings',
            'com.module.users',
            'com.module.bookings',
            'com.module.priceOptions',
            'com.module.promo',
            'com.module.news',
            'com.module.panel'
        ])
        .run(function (formlyConfig) {
            /*
             ngModelAttrs stuff
             */
            var ngModelAttrs = {};

            function camelize(string) {
                string = string.replace(/[\-_\s]+(.)?/g, function (match, chr) {
                    return chr ? chr.toUpperCase() : '';
                });
                // Ensure 1st char is always lowercase
                return string.replace(/^([A-Z])/, function (match, chr) {
                    return chr ? chr.toLowerCase() : '';
                });
            }

            /*
             timepicker
             */
            ngModelAttrs = {};

            // attributes
            angular.forEach([
                'meridians',
                'readonly-input',
                'mousewheel',
                'arrowkeys'
            ], function (attr) {
                ngModelAttrs[camelize(attr)] = {attribute: attr};
            });

            // bindings
            angular.forEach([
                'hour-step',
                'minute-step',
                'show-meridian'
            ], function (binding) {
                ngModelAttrs[camelize(binding)] = {bound: binding};
            });

            formlyConfig.setType({
                name: 'timepicker',
                template: '<timepicker ng-model="model[options.key]"></timepicker>',
                wrapper: [
                    'bootstrapLabel',
                    'bootstrapHasError'
                ],
                defaultOptions: {
                    ngModelAttrs: ngModelAttrs,
                    templateOptions: {
                        timepickerOptions: {}
                    }
                }
            });

            formlyConfig.setType({
                name: 'datepicker',
                template: '<datepicker ng-model="model[options.key]" ></datepicker>',
                wrapper: [
                    'bootstrapLabel',
                    'bootstrapHasError'
                ],
                defaultOptions: {
                    ngModelAttrs: ngModelAttrs,
                    templateOptions: {
                        datepickerOptions: {}
                    }
                }
            });
        });

})();
