'use strict';
/**
 * @ngdoc function
 * @name com.module.core.controller:RouteCtrl
 * @description Redirect for acess
 * @requires $q
 * @requires $scope
 * @requires $state
 * @requires $location
 * @requires AppAuth
 **/
angular.module('com.module.core')
    .controller('RouteCtrl', function ($q, $scope, $state, $location, $window, $rootScope, ApiService) {
        // if (!AppAuth.currentUser) {
        //   console.log('Redirect to login');
        //   $location.path('/login');
        // } else {
        //   console.log('Redirect to app');
        //   $location.path('/app');
        // }
        if (localStorage.accessToken) {
            ApiService.checkApi(localStorage.accessToken,
                function (response) {
                    $rootScope.currentUser = response.data;
                    $rootScope.apiChecked = true;
                    $location.path('/app');
                });
        } else {
            $location.path('/login');
        }
    });
