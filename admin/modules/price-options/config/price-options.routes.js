angular.module('com.module.priceOptions')
    .config(function ($stateProvider) {
        $stateProvider
            .state('app.priceOptions', {
                url: '/phi',
                templateUrl: 'modules/price-options/views/main.html',
                abstract: true
            })
            .state('app.priceOptions.list', {
                url: '',
                templateUrl: 'modules/price-options/views/list.html',
                controller: 'PriceOptionsCtrl'
            })
    })