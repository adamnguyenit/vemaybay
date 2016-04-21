<?php

namespace app\models;

class Place extends \yii\db\ActiveRecord
{

    public static function crawl()
    {
        $places = \Yii::$app->atservice->getPlaces();
        if (empty($places)) {
            return false;
        }
        foreach ($places as $place) {
            $model = static::findOne($place->id);
            if (empty($model)) {
                $model = new static();
                $model->id = $place->id;
            }
            $model->code = $place->code;
            $model->name = $place->name;
            $model->english_name = $place->englishName;
            $model->country_code = $place->countryCode;
            $model->airport_name = $place->airportName;
            $model->support_jetstar = intval($place->supportJetStar);
            $model->support_vietjetair = intval($place->supportVietJetAir);
            $model->support_vietnamairline = intval($place->supportVietNamAirline);
            $model->order = $place->order;
            $model->save();
        }
        return true;
    }
}
