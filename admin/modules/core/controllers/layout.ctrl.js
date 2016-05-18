'use strict';
angular.module('com.module.core')
/**
 * @ngdoc function
 * @name com.module.core.controller:LayoutCtrl
 * @description Layout controller
 * @requires $scope
 * @requires $rootScope
 * @requires CoreService
 * @requires gettextCatalog
 **/
    .controller('LayoutCtrl', function ($scope, $rootScope, $cookies, CoreService,
                                        gettextCatalog) {


        $scope.toggleSidebar = function () {
            var $ = angular.element;
            if ($(window).width() <= 992) {
                $('.row-offcanvas').toggleClass('active');
                $('.left-side').removeClass('collapse-left');
                $('.right-side').removeClass('strech');
                $('.row-offcanvas').toggleClass('relative');
            } else {
                // Else, enable content streching
                $('.left-side').toggleClass('collapse-left');
                $('.right-side').toggleClass('strech');
            }
        };

        $scope.settings = $rootScope.settings;

        $rootScope.loadSettings();

    });
