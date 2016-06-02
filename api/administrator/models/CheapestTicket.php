<?php

namespace app\models;

class CheapestTicket extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{cheapest}}';
    }

    public function fields()
    {
        return [
            'id',
            'fromPlace' => function () {
                $model = Place::find()->where(['code' => $this->from])->limit(1)->one();
                if ($model === null) {
                    return $this->from;
                }
                return $model->code . ' - ' . $model->name;
            },
            'toPlace' => function () {
                $model = Place::find()->where(['code' => $this->to])->limit(1)->one();
                if ($model === null) {
                    return $this->to;
                }
                return $model->code . ' - ' . $model->name;
            },
            'expect',
            'price',
            'source',
            'createdAt' => function () {
                if (empty($this->created_at)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->created_at);
            },
            'updatedAt' => function () {
                if (empty($this->updated_at)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->updated_at);
            }
        ];
    }
}
