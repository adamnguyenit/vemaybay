'use strict';

angular.module('com.module.promo')
    .controller('PromoFormCtrl', function (ApiService, $scope, $window, $state, CoreService, $stateParams) {
        $scope.loading = true;
        $(document).ready(function () {
            $('#editor').wysiwyg();
            $('.dropdown-menu input').click(function () {
                return false;
            })
                .change(function () {
                    $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                }).keydown('esc', function () {
                    this.value = '';
                    $(this).change();
                });
        })

        if ($stateParams.id) {
            ApiService.findOne('promotions-news', localStorage.accessToken, $stateParams.id, function (response) {
                $scope.loading = false;
                $scope.promo = response.data;
                $('#editor').html(response.data.content)
            })
            $scope.onSubmit = function () {
                $scope.promo.content = $('#editor').cleanHtml();
                ApiService.update('promotions-news', localStorage.accessToken, $scope.promo, function (response) {
                    CoreService.toastSuccess('Success!');
                    $state.go('app.promo.list');
                })
            }
        } else {
            $scope.loading = false;
            $scope.promo = {};
            $scope.onSubmit = function () {
                $scope.promo.content = $('#editor').cleanHtml();
                ApiService.create('promotions-news', localStorage.accessToken, $scope.promo, function (response) {
                    CoreService.toastSuccess('Success!');
                    $state.go('app.promo.list');
                })
            }
        }

        $scope.onView = function (item) {
            $scope.promo.content = $('#editor').cleanHtml();
        }


    })