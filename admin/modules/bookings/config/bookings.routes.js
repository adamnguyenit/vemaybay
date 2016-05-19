angular.module('com.module.bookings')
	.config(function($stateProvider){
		$stateProvider
			.state('app.bookings', {
				abstract: true,
				url: '/giao-dich',
				templateUrl: 'modules/bookings/views/main.html'
			})
			.state('app.bookings.list', {
				url: '',
				templateUrl: 'modules/bookings/views/list.html',
				controller: 'BookingsCtrl'
			})
			.state('app.bookings.uncompleted', {
				url: '/chua-thanh-toan',
				templateUrl: 'modules/bookings/views/uncompleted.html',
				controller: 'UncompletedCtrl'
			})
			.state('app.bookings.completed', {
				url: '/da-thanh-toan',
				templateUrl: 'modules/bookings/views/completed.html',
				controller: 'CompletedCtrl'
			})
			.state('app.bookings.canceled', {
				url: '/da-huy',
				templateUrl: 'modules/bookings/views/canceled.html',
				controller: 'CanceledCtrl'
			})
	})