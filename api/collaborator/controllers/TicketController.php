<?php

namespace app\controllers;

use yii\web\BadRequestHttpException;
use atservice\TicketQuery;
use app\models\Place;

class TicketController extends Controller
{

    public function actionSearch()
    {
        $params = \Yii::$app->request->post();
        $params['roundTrip'] = boolval($params['roundTrip']);
        $fromPlace = $params['fromPlace'];
        $toPlace = $params['toPlace'];
        $fromPlaceModel = Place::find()->where(['code' => $fromPlace])->limit(1)->one();
        if ($fromPlace === $toPlace || empty($fromPlaceModel)) {
            throw new BadRequestHttpException();
        }
        $ticketQuery = new TicketQuery($params);
        if (\Yii::$app->response->format === 'html') {
            \Yii::$app->response->format = 'json';
        }
        $tickets = \Yii::$app->atservice->getTickets($ticketQuery);
        $result = [];
        foreach ($tickets as $ticket) {
            if ($ticket->fromPlaceId == $fromPlaceModel->id) {
                $result['depart'][] = $ticket->toArray();
            } else {
                $result['return'][] = $ticket->toArray();
            }
        }

        return $result;
    }
}
