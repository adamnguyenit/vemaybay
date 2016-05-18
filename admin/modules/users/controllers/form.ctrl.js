'use strict';

angular.module('com.module.users')
    .controller('UserFormCtrl', function (ApiService, $scope, $window, $state, CoreService, $stateParams) {

        $scope.user = {};
        $scope.onSubmit = function () {
            ApiService.create('users', localStorage.accessToken, $scope.user, function (response) {
                CoreService.toastSuccess('Success!');
                $state.go('app.users.list');
            })
        }


    })