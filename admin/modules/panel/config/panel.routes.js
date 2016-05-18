angular.module('com.module.panel')
    .config(function ($stateProvider) {
        $stateProvider
            .state('app.panel', {
                url: '/panels',
                templateUrl: 'modules/panel/views/main-panel.html',
                abstract: true
            })
            .state('app.panel.list', {
                url: '',
                templateUrl: 'modules/panel/views/list-panel.html',
                controller: 'PanelCtrl'
            })
            .state('app.panel.add', {
                url: '/add',
                templateUrl: 'modules/panel/views/form-panel.html',
                controller: 'PanelFormCtrl'
            })


            .state('app.slide', {
                url: '/slides',
                templateUrl: 'modules/panel/views/main-slide.html',
                abstract: true
            })
            .state('app.slide.list', {
                url: '',
                templateUrl: 'modules/panel/views/list-slide.html',
                controller: 'SlideCtrl'
            })
            .state('app.slide.add', {
                url: '/add',
                templateUrl: 'modules/panel/views/form-slide.html',
                controller: 'SlideFormCtrl'
            });
    })