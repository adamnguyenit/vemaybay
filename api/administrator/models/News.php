<?php

namespace app\models;

class News extends \yii\db\ActiveRecord
{

    public static function create($title, $content)
    {
        $model = new static();
        $model->title = $title;
        $model->content = $content;
        $model->alias = static::generateAlias($title);
        $model->created_at = time();
        if (!$model->save()) {
            return null;
        }
        return $model;
    }

    public function fields()
    {
        return [
            'id',
            'alias',
            'title',
            'content',
            'createdAt' => function () {
                if (empty($this->created_at)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->created_at);
            }
        ];
    }

    protected static function generateAlias($title)
    {
        $unicodes = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
			'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];
        $alias = $title;
        foreach($unicodes as $nonUnicode => $unicode){
            $alias = preg_replace("/($unicode)/i", $nonUnicode, $alias);
        }
        $alias = preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($alias)) . '-' . uniqid();
        $alias = str_replace(' ', '-', $alias);
        return $alias;
    }

}
