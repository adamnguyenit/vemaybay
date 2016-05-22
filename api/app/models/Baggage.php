<?php

namespace app\models;

class Baggage extends \yii\db\ActiveRecord
{

    public static $title = [
        'BG15' => '15kg',
        'BG20' => '20kg',
        'BG25' => '25kg',
        'BG30' => '30kg',
        'BG35' => '35kg',
        'BG40' => '40kg',
    ];

    public function fields()
    {
        return [
            'id',
            'code',
            'price',
            'airline',
            'title',
        ];
    }

    public function getTitle()
    {
        return empty(static::$title[$this->code]) ? null : static::$title[$this->code];
    }
}
