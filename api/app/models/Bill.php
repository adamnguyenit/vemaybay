<?php

namespace app\models;

class Bill extends \yii\db\ActiveRecord
{

    public static function create($bookingIdentity)
    {
        $model = new static();
        $model->booking_identity = $bookingIdentity;
        $model->created_at = time();
        if (!$model->save()) {
            return null;
        }
        return $model;
    }

    public static function remove($bookingIdentity)
    {
        static::deleteAll(['booking_identity' => $bookingIdentity]);
        return true;
    }

    public function getBooking()
    {
        return Booking::find()->where(['identity' => $this->booking_identity])->limit(1)->one();
    }

    public function fields()
    {
        return [
            'id',
            'booking',
            'createdAt'
        ];
    }

    public function getCreatedAt()
    {
        $titles = [
            'Mon' => 'Thứ 2',
            'Tue' => 'Thứ 3',
            'Wed' => 'Thứ 4',
            'Thu' => 'Thứ 5',
            'Fri' => 'Thứ 6',
            'Sat' => 'Thứ 7',
            'Sun' => 'CN',
        ];
        return empty($this->created_at) ? null : $titles[date('D', $this->created_at)] . ', ngày ' . date('d/m/Y', $this->created_at);
    }
}
