angular.module('com.module.priceOptions')
	.controller('PriceOptionsCtrl', function($scope, ApiService, CoreService, $state){
		$scope.loading = true;
        $scope.searchText = '';
        ApiService.getPriceOptions(localStorage.accessToken, function (response) {
            $scope.priceOptions = response.data;
            $scope.myOrder = 'id';
            $scope.myReverse = false;
            $scope.loading = false;
            $scope.orderMe = function (orderBy) {
                $scope.myOrder = orderBy;
                $scope.myReverse = ($scope.myOrder == orderBy) ? $scope.myReverse = !$scope.myReverse : $scope.myReverse = fasle;
            }

            $scope.viewby = 10;
            $scope.currentPage = 1;
            $scope.itemsPerPage = $scope.viewby;
            $scope.maxSize = 5;
            $scope.totalItems = $scope.priceOptions.length;
            $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            $scope.setItemsPerPage = function (num) {
                $scope.itemsPerPage = num;
                $scope.currentPage = 1; //reset to first paghe
                $scope.totalPage = Math.ceil($scope.totalItems / $scope.itemsPerPage);
            };
            $scope.onEdit = function (item) {
                $scope.editItem = item;
            }
            $scope.editPrice = function(item){
                var data = {
                    "AgentTicketCharge": item.agentTicketCharge.toString(),
                    "InternationalTicketCharge": item.internationalTicketCharge.toString()
                }
                ApiService.editPriceOption(localStorage.accessToken, item.id, data, function(){
                    ApiService.getPriceOptions(localStorage.accessToken, function (response) {
                        CoreService.toastSuccess('Success!');
                        $scope.priceOptions = response.data;
                    })
                })
            }
        })
	})