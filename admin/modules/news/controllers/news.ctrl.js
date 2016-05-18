'use strict';

angular.module('com.module.news')
    .controller('NewsCtrl', function (ApiService, $scope, $window, $state, CoreService, $stateParams) {

        $scope.loading = true;
        $scope.searchText = '';
        ApiService.find('newses', localStorage.accessToken, function (response) {
            $scope.news = response.data;
            $scope.myOrder = '';
            $scope.myReverse = true;
            $scope.loading = false;
            $scope.orderMe = function (orderBy) {
                $scope.myOrder = orderBy;
                $scope.myReverse = ($scope.myOrder == orderBy) ? $scope.myReverse = !$scope.myReverse : $scope.myReverse = fasle;
            }

            $scope.viewby = 10;
            $scope.currentPage = 1;
            $scope.itemsPerPage = $scope.viewby;
            $scope.maxSize = 5;
            $scope.totalItems = $scope.news.length;
            $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            $scope.setItemsPerPage = function (num) {
                $scope.itemsPerPage = num;
                $scope.currentPage = 1; //reset to first paghe
                $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            };
            $scope.deleteNews = function (id) {
                CoreService.confirm('Xác nhận', 'Bạn có thực sự muốn xóa', function () {
                    ApiService.deleteById('newses', localStorage.accessToken, id, function () {
                        ApiService.getNews(localStorage.accessToken, function (response) {
                            CoreService.toastSuccess('Success!');
                            $scope.news = response.data;
                        })
                    })
                }, function () {

                })
            }
            $scope.onView = function (item) {
                $scope.viewItem = item;
            }
        })


    })