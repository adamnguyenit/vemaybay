'use strict';

angular.module('com.module.panel')
    .controller('PanelFormCtrl', function (ApiService, $scope, $window, $state, CoreService, $stateParams) {

        $scope.panel = {};
        $scope.onSubmit = function () {
            var link = $('input[name=link]').val();
            var index = $('input[name=index]').val();
            var image = $('input[name=image]').get(0).files[0];
            var formData = new FormData();
            formData.append('image', image);
            formData.append('link', link);
            formData.append('index', index);
            ApiService.create('panels', localStorage.accessToken, formData, function (response) {
                CoreService.toastSuccess('Success!');
                $state.go('app.panel.list');
            })
        }


    })