'use strict';
var app = angular.module('com.module.core');

app.service('ApiService', function ($http, $window, $location, CoreService, $state) {
    var apiURL = 'http://api.vemaybayhaiphiyen.com/administrator/';


    function error(response) {
        if (response.status == 401) {
            var config = {
                title: 'Thông báo',
                text: 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại và tiếp tục sử dụng dịch vụ',
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#DD6B55'
            }
            CoreService._swal(config, function () {
                delete localStorage.accessToken;
                $state.go('login');
            })
        }
    }

    this.checkApi = function (token, successCb, errorCb) {
        $http({
            method: 'GET',
            url: apiURL + 'me',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.login = function (credentials, successCb, errorCb) {
        $http({
            method: 'POST',
            url: apiURL + 'users/login',
            headers: {
                'Authorization': 'Basic ' + window.btoa(unescape(encodeURIComponent(credentials.username + ':' + credentials.password)))
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                errorCb(response);
                return;
            });
    }

    this.logout = function (token, successCb, errorCb) {
        $http({
            method: 'POST',
            url: apiURL + 'users/logout',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                errorCb(response);
                return;
            });
    }


    this.find = function(endPoint, token, successCb, errorCb){
        $http({
            method: 'GET',
            url: apiURL + endPoint,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.findOne = function (endPoint, token, id, successCb, errorCb) {
        $http({
            method: 'GET',
            url: apiURL + endPoint +'/' + id,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.create = function (endPoint, token, data, successCb, errorCb) {
        $http({
            method: 'POST',
            url: apiURL + endPoint,
            data: data,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.update = function (endPoint, token, id, data, successCb, errorCb) {
        $http({
            method: 'PUT',
            url: apiURL + endPoint + '/' + id,
            data: data,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.deleteById = function (endPoint, token, id, successCb, errorCb) {
        $http({
            method: 'DELETE',
            url: apiURL + endPoint + '/' + id,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    

    //Price Options API
    this.getPriceOptions = function (token, successCb, errorCb) {
        $http({
            method: 'GET',
            url: apiURL + 'price-options',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.editPriceOption = function (token, id, data, successCb, errorCb) {
        $http({
            method: 'PUT',
            url: apiURL + 'price-options/' + id,
            data: data,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.deleteReceiptRequest = function (token, identity, successCb, errorCb) {
        $http({
            method: 'DELETE',
            url: apiURL + 'booking/' + identity + '/bill',
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.updateStatusBooking = function(token, item, successCb){
        $http({
            method: 'PUT',
            url: apiURL + 'bookings/' + item.identity + '/status',
            data: {status: item.status},
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
                return;
            }, function errorCallback(response) {
                error(response);
                return;
            });
    }

    this.addSP = function (endpoint, token, data, successCb, errorCb) {
        $http({
            method: 'POST',
            url: apiURL + endpoint,
            data: data,
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': undefined
            }
        })
            .then(function successCallback(response) {
                successCb(response);
            }, function errorCallback(response) {
                error(response);
            });
    }

    this.editSP = function (endpoint, token, id, data, successCb, errorCb) {
        $http({
            method: 'PUT',
            url: apiURL + endpoint + '/' + id,
            data: data,
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': undefined
            }
        })
            .then(function successCallback(response) {
                successCb(response);
            }, function errorCallback(response) {
                error(response);
            });
    }

    this.deleteSP = function (endpoint, token, id, successCb, errorCb) {
        $http({
            method: 'DELETE',
            url: apiURL + endpoint + '/' + id,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
            .then(function successCallback(response) {
                successCb(response);
            }, function errorCallback(response) {
                error(response);
            });
    }


});
