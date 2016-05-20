angular.module('com.module.bookings')
	.controller('ReceiptCtrl', function($scope, ApiService, CoreService){
		$scope.loading = true;
        $scope.searchText = '';
        ApiService.find('bookings/new-bill', localStorage.accessToken, function (response) {
            $scope.receipts = response.data;
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
            $scope.totalItems = $scope.receipts.length;
            $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            $scope.setItemsPerPage = function (num) {
                $scope.itemsPerPage = num;
                $scope.currentPage = 1; //reset to first paghe
                $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            };
            $scope.deleteReceipt = function (identity) {
                CoreService.confirm('Xác nhận', 'Bạn có thực sự muốn xóa', function () {
                    ApiService.deleteReceiptRequest(localStorage.accessToken, identity, function () {
                        ApiService.find('bookings/new-bill', localStorage.accessToken, function (response) {
                            CoreService.toastSuccess('Success!');
                            $scope.receipts = response.data;
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