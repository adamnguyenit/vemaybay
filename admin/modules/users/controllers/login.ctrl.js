(function () {
    'use strict';
    /**
     * @ngdoc function
     * @name com.module.users.controller:LoginCtrl
     * @description Login Controller
     * @requires $scope
     * @requires $routeParams
     * @requires $location
     * Contrller for Login Page
     **/
    angular
        .module('com.module.users')
        .controller('LoginCtrl', function (ApiService, $window, $http, $scope, $location, CoreService, gettextCatalog, $rootScope, $cookieStore) {

            var TWO_WEEKS = 1000 * 60 * 60 * 24 * 7 * 2;

            $scope.credentials = {
                ttl: TWO_WEEKS,
                rememberMe: true
            };

            if (CoreService.env.name === 'development') {
                $scope.credentials.email = 'admin';
                $scope.credentials.password = 'admin';
            }

            $scope.schema = [
                {
                    label: '',
                    property: 'username',
                    placeholder: gettextCatalog.getString('User Name'),
                    type: 'text',
                    attr: {
                        required: true,
                        ngMinlength: 4
                    }
                },
                {
                    label: '',
                    property: 'password',
                    placeholder: gettextCatalog.getString('Password'),
                    type: 'password',
                    attr: {
                        required: true
                    }
                }
            ];

            $scope.options = {
                validation: {
                    enabled: true,
                    showMessages: false
                },
                layout: {
                    type: 'basic',
                    labelSize: 3,
                    inputSize: 9
                }
            };


            $scope.login = function () {
                ApiService.login($scope.credentials, function (response) {
                    localStorage.accessToken = response.data.accessToken;
                    $location.path('/app');
                }, function (response) {
                    $scope.loginError = {message: "Error! Please check username or password and try again"}
                })
            };

        });

})();
