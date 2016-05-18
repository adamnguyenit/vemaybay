angular.module('com.module.news')
    .config(function ($stateProvider) {
        $stateProvider
            .state('app.news', {
                url: '/tin-tuc',
                templateUrl: 'modules/news/views/main.html',
                abstract: true
            })
            .state('app.news.list', {
                url: '',
                templateUrl: 'modules/news/views/list.html',
                controller: 'NewsCtrl'
            })
            .state('app.news.add', {
                url: '/add',
                templateUrl: 'modules/news/views/form.html',
                controller: 'NewsFormCtrl'
            })
            .state('app.news.edit', {
                url: '/edit/:id',
                templateUrl: 'modules/news/views/form.html',
                controller: 'NewsFormCtrl'
            });
    })