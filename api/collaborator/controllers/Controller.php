<?php

namespace app\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\User;

class Controller extends \yii\rest\Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => [$this, 'basicAuth']
                ],
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        $behaviors['rateLimiter']['enableRateLimitHeaders'] = true;
        return $behaviors;
    }

    public function basicAuth($username, $password)
    {
        return User::findIdentityByBasicAuth($username, $password);
    }
}
