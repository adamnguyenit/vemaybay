<?php

return [
    'POST users/login' => 'user/login',
    'POST users/logout' => 'user/logout',
    'GET places/suggestion' => 'place/suggestion',
    'GET places/agent' => 'place/agent',
    'GET places/international' => 'place/international',
    'GET baggages/<airline>' => 'baggage/list',
    'GET countries' => 'country/index',
    'GET countries/<name>' => 'country/city',
    'POST tickets/search' => 'ticket/search',
    'POST books' => 'booking/create',
];
