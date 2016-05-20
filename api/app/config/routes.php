<?php

return [
    'GET news' => 'news/index',
    'GET news/popular' => 'news/popular',
    'GET news/<alias>' => 'news/view',
    'GET panels' => 'panel/index',
    'GET promotion-news' => 'promotion-news/index',
    'GET promotion-news/<alias>' => 'promotion-news/view',
    'GET slides' => 'slide/index',
    'GET places/suggestion' => 'place/suggestion',
    'GET places/agent' => 'place/agent',
    'GET places/international' => 'place/international',
    'POST tickets/search' => 'ticket/search',
    'POST books' => 'booking/create',
    'GET books/<encoded>' => 'booking/info',
    'PUT books/<encoded>/options' => 'booking/set-options',
    'GET baggages/<airline>' => 'baggage/list'
];
