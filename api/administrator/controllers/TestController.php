<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $params = [
            'RoundTrip' => false,
            'FromPlace' => 'SGN',
            'ToPlace' => 'HAN',
            'DepartDate' => '2016-06-26T00:00:00.000',
            'ReturnDate' => '2016-06-26T00:00:00.000',
            'CurrencyType' => 'VND',
            'Adult' => 2,
            'Child' => 2,
            'Infant' => 1,
            'Sources' => 'JetStar,VietJetAir,VietnamAirlines',
            'FlightType' => 'DirectAndContinue',
        ];
        $tickets = \Yii::$app->atservice->getTickets($params);
        $result = [];
        foreach ($tickets as $ticket) {
            $result[] = $ticket->toArray();
        }
        return $result;
    }
}
