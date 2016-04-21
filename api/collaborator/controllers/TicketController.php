<?php

namespace app\controllers;

use atservice\TicketQuery;

class TicketController extends Controller
{
    public function actionSearch()
    {
        $params = \Yii::$app->request->post();
        if ($params['roundTrip'] === 'true') {
            $params['roundTrip'] = true;
        } elseif ($params['roundTrip'] === 'false') {
            $params['roundTrip'] = false;
        }
        // $params = [
        //     'RoundTrip' => false,
        //     'FromPlace' => 'SGN',
        //     'ToPlace' => 'HAN',
        //     'DepartDate' => '2016-06-16',
        //     'ReturnDate' => '2016-06-16',
        //     'CurrencyType' => 'VND',
        //     'Adult' => 1,
        //     'Child' => 0,
        //     'Infant' => 0,
        //     'Sources' => $params['source'],//'JetStar,VietJetAir,VietnamAirlines',
        //     'FlightType' => 'DirectAndContinue',
        // ];
        // \yii\helpers\VarDumper::dump($params, 10, true); exit;
        $ticketQuery = new TicketQuery($params);
        try {
            $tickets = \Yii::$app->atservice->getTickets($ticketQuery);
        } catch (\exception $e) {
            \yii\helpers\VarDumper::dump($e, 10, true); exit;
        }
        $result = [];
        foreach ($tickets as $ticket) {
            $result[] = $ticket->toArray();
        }

        return $result;
    }
}
