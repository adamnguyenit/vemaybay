<?php

namespace app\models;

class Place extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return [
            'id',
            'code',
            'name',
            'english_name',
            'country_code',
            'group',
            'airport_name',
            'support_jetstar',
            'support_vietjetair',
            'support_vietnamairline',
            'order'
        ];
    }

    public function getGroup()
    {
        if ($this->country_code == 'VN') {
            return 'Quốc Nội';
        }
        return 'Quốc Ngoại';
    }
}
