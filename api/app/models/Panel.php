<?php

namespace app\models;

use yii\helpers\Url;

class Panel extends \yii\db\ActiveRecord
{
    const UPLOAD_DIR = '../administrator/upload/panel';

    public function fields()
    {
        return [
            'id',
            'image' => function () {
                return Url::to('@web/' . static::UPLOAD_DIR . '/' . $this->image, true);
            },
            'link',
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
