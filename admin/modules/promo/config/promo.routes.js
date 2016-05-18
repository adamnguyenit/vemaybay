angular.module('com.module.promo')
    .config(function ($stateProvider) {
        $stateProvider
            .state('app.promo', {
                url: '/khuyen-mai',
                templateUrl: 'modules/promo/views/main.html',
                abstract: true
            })
            .state('app.promo.list', {
                url: '',
                templateUrl: 'modules/promo/views/list.html',
                controller: 'PromoCtrl'
            })
            .state('app.promo.add', {
                url: '/add',
                templateUrl: 'modules/promo/views/form.html',
                controller: 'PromoFormCtrl'
            })
            .state('app.promo.edit', {
                url: '/edit/:id',
                templateUrl: 'modules/promo/views/form.html',
                controller: 'PromoFormCtrl'
            });
    })