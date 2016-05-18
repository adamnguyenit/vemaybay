(function () {
    'use strict';
    angular
        .module('com.module.users')
        .config(function ($stateProvider) {
            $stateProvider
                .state('login', {
                    url: '/login',
                    template: '<login></login>',
                    controller: 'LoginCtrl'
                })
                .state('app.users', {
                    abstract: true,
                    url: '/users',
                    templateUrl: 'modules/users/views/main.html'
                })
                .state('app.users.list', {
                    url: '',
                    templateUrl: 'modules/users/views/list.html',
                    controller: 'UserCtrl'
                })
                .state('app.users.add', {
                    url: '/add',
                    templateUrl: 'modules/users/views/form.html',
                    controller: 'UserFormCtrl'
                });
        });

})();
