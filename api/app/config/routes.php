<?php

return [
    'POST users/login' => 'user/login',
    'POST users' => 'user/create',
    'PUT users/<id>' => 'user/update',
    'DELETE users/<id>' => 'user/delete',
    'POST users/logouts' => 'user/logout',
    'GET me' => 'user/info',
    'GET users' => 'user/list',
    'POST promotions-news' => 'promotion-news/create',
    'GET promotions-news' => 'promotion-news/list',
    'GET promotions-news/<id>' => 'promotion-news/info',
    'PUT promotions-news/<id>' => 'promotion-news/update',
    'DELETE promotions-news/<id>' => 'promotion-news/delete',
    'POST newses' => 'news/create',
    'GET newses' => 'news/list',
    'GET newses/<id>' => 'news/info',
    'PUT newses/<id>' => 'news/update',
    'DELETE newses/<id>' => 'news/delete',
    'GET price-options' => 'price-option/list',
    'PUT price-options/<id>' => 'price-option/update',
    'GET slides' => 'slide/list',
    'PUT slides/<id>' => 'slide/update',
    'DELETE slides/<id>' => 'slide/delete',
    'POST slides' => 'slide/create',
    'GET slides/<id>' => 'slide/info',
    'GET panels' => 'panel/list',
    'PUT panels/<id>' => 'panel/update',
    'DELETE panels/<id>' => 'panel/delete',
    'POST panels' => 'panel/create',
    'GET panels/<id>' => 'panel/info',
];