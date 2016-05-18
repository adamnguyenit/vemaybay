'use strict';
var app = angular.module('com.module.core');
app.run(function ($rootScope, gettextCatalog) {

    // Left Sidemenu
    $rootScope.menu = [];

    // Add Sidebar Menu
    $rootScope.addMenu = function (name, uisref, icon) {
        $rootScope.menu.push({
            name: name,
            sref: uisref,
            icon: icon
        });
    };

    // Add Menu Dashboard
    $rootScope.addMenu(gettextCatalog.getString('Dashboard'), 'app.home',
        'fa-dashboard');

    // Dashboard
    $rootScope.dashboardBox = [];

    // Add Dashboard Box
    $rootScope.addDashboardBox = function (name, color, icon, quantity, href) {
        $rootScope.dashboardBox.push({
            name: name,
            color: color,
            icon: icon,
            quantity: quantity,
            href: href
        });
    };

    // Get Settings for Database

    // Load Settings blank
    $rootScope.settings = {};

    // Get Settings for Loopback Service
    $rootScope.loadSettings = function () {
        $rootScope.settings.data = [
            {"key": "appName", "value": "Hải Phi Yến", "id": 1, "type": "string"},
            {
                "key": "appTheme",
                "value": "skin-blue",
                "id": 2,
                "type": "select",
                "options": ["skin-blue", "skin-black"]
            },
            {
                "key": "appLayout",
                "value": "not-fixed",
                "id": 3,
                "type": "select",
                "options": ["skin-blue", "not-fixed"]
            },
            {"key": "formLayout", "value": "horizontal", "id": 4, "type": "string"},
            {"key": "formLabelSize", "value": "3", "id": 5, "type": "int"},
            {"key": "formInputSize", "value": "9", "id": 6, "type": "int"},
            {"key": "com.module.users.enable_registration", "value": "true", "id": 7, "type": "boolean"}]
    };

});
