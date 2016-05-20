<?php

namespace app\models;

class Notification extends \yii\db\ActiveRecord
{

    public static function setNewUncompletedBooking($value = true)
    {
        $model = static::find()->where(['name' => 'has_new_uncompleted_booking'])->limit(1)->one();
        if ($model == null) {
            $model = new static();
            $model->name = 'has_new_uncompleted_booking';
        }
        $model->value = intval($value);
        return $model->save();
    }

    public static function hasNewUncompletedBooking()
    {
        $model = static::find()->where(['name' => 'has_new_uncompleted_booking'])->limit(1)->one();
        return ($model == null || $model->value == 0) ? false : true;
    }

    public static function setNewBill($value = true)
    {
        $model = static::find()->where(['name' => 'has_new_bill'])->limit(1)->one();
        if ($model == null) {
            $model = new static();
            $model->name = 'has_new_bill';
        }
        $model->value = intval($value);
        return $model->save();
    }

    public static function hasNewBill()
    {
        $model = static::find()->where(['name' => 'has_new_bill'])->limit(1)->one();
        return ($model == null || $model->value == 0) ? false : true;
    }
}
