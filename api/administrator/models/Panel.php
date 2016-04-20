<?php

namespace app\models;

use yii\helpers\Url;

class Panel extends \yii\db\ActiveRecord
{

    const UPLOAD_DIR = 'upload/panel';

    public static function create($uploadInstance, $link, $index)
    {
        $tmpName = $_FILES[$uploadInstance]['tmp_name'];
        $ext = pathinfo($_FILES[$uploadInstance]['name'], PATHINFO_EXTENSION);
        $name = uniqid() . ".$ext";
        if (!move_uploaded_file($tmpName, \Yii::getAlias('@app/' . static::UPLOAD_DIR . '/' . $name))) {
            return null;
        }
        $model = new static();
        $model->image = $name;
        $model->link = $link;
        $model->index = $index;
        $model->created_at = time();
        if (!$model->save()) {
            return null;
        }
        return $model;
    }

    public function delete()
    {
        $deleted = parent::delete();
        if ($deleted) {
            unlink(\Yii::getAlias('@web/' . static::UPLOAD_DIR . '/' . $this->image));
        }
        return $deleted;
    }

    public function fields()
    {
        return [
            'id',
            'link',
            'index',
            'image' => function () {
                return Url::to('@web/' . static::UPLOAD_DIR . '/' . $this->image, true);
            },
            'createdAt' => function () {
                if (empty($this->created_at)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->created_at);
            }
        ];
    }

}
