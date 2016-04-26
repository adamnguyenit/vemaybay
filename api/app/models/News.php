<?php

namespace app\models;

use yii\helpers\StringHelper;

class News extends \yii\db\ActiveRecord
{

    public function fields()
    {
        return [
            'id',
            'alias',
            'title',
            'content',
            'image' => function () {
                $images = [];
                preg_match('/src="([^"]*)"/i', $foo, $images);

                return empty($images) ? null : $images[0];
            },
            'description' => function () {
                return empty($this->content) ? null : StringHelper::truncateWord($this->content, 50, '...', true);
            },
            'createdAt' => function () {
                return empty($this->created_at) ? null : date('H:i:s d-m-Y', $this->created_at);
            },
        ];
    }
}
