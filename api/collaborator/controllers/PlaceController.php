<?php

namespace app\controllers;

use app\models\Place;

class PlaceController extends Controller
{
    public function actionList()
    {
        $type = \Yii::$app->request->get('type');
        $places = Place::find();
        if ($type === 'agent') {
            $places = $places->where(['country_code' => 'VN']);
        } elseif ($type === 'international') {
            $places = $places->where(['not', ['country_code' => 'VN']])->orWhere(['country_code' => null]);
        }
        $places = $places->andWhere(['or', 'support_jetstar=1', 'support_vietjetair=1', 'support_vietnamairline=1',])
            ->orderBy(['order' => SORT_ASC])
            ->all();
        // \yii\helpers\VarDumper::dump($places->createCommand()->getRawSql(), 10, true); exit;
        $result = [];
        foreach ($places as $place) {
            $result[] = $place->toArray();
        }

        return $result;
    }
}
