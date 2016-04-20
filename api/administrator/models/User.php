<?php

namespace app\models;

use yii\helpers\Inflector;
use yii\helpers\Url;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface, \yii\filters\RateLimitInterface
{

    const AVATAR_DIR = '/upload/avatar/';

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'role' => 'administrator']);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'role' => 'administrator']);
    }

    public static function findIdentityByBasicAuth($username, $password)
    {
        $model = static::findOne(['username' => $username, 'role' => 'administrator']);
        if ($model === null || !\Yii::$app->security->validatePassword($password, $model->password_hash)) {
            return null;
        }
        return $model;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function getRateLimit($request, $action)
    {
        return [$this->rateLimit, 1];
    }

    public function loadAllowance($request, $action)
    {
        return [$this->allowance, $this->allowance_updated_at];
    }

    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }

    public static function create($username, $password, $name, $role)
    {
        $model = new static();
        $model->username = $username;
        $model->name = $name;
        $model->role = $role;
        $model->password_hash = \Yii::$app->security->generatePasswordHash($password);
        $model->auth_key = \Yii::$app->security->generateRandomString();
        $model->access_token = \Yii::$app->security->generateRandomString();
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
            'username',
            'name',
            'avatar' => function () {
                $filename = $this->id . '.jpg';
                $pathAlias = '@web' . static::AVATAR_DIR . $filename;
                $filepath = \Yii::getAlias($pathAlias . $filename);
                if (file_exists($filepath)) {
                    return Url::to($pathAlias, true);
                }
                return null;
            },
            'accessToken' => 'access_token',
            'createdAt' => function () {
                if (empty($this->created_at)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->created_at);
            },
            'lastUsed' => function () {
                if (empty($this->last_used)) {
                    return null;
                }
                return date('H:i:s d-m-Y', $this->last_used);
            }
        ];
    }
}
