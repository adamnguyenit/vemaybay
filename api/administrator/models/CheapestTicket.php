<?php

namespace app\models;

class CheapestTicket extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{cheapest}}';
    }
}
