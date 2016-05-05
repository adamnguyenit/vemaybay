<?php

namespace app\models;

use yii\helpers\Url;

class Slide extends \yii\db\ActiveRecord
{
    const UPLOAD_DIR = '../administrator/upload/slide';

    public function fields()
    {
        return [
            'id',
            'imageUrl',
            'link',
            'createdAt'
        ];
    }

    public function getImageUrl()
    {
        return Url::to('@web/' . static::UPLOAD_DIR . '/' . $this->image, true);
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
