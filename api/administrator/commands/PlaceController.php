<?php

namespace app\commands;

use app\models\Place;

class PlaceController extends \yii\console\Controller
{

    public function actionCrawl()
    {
        echo 'Start: ' . date('Y-mm-dd H:i:s') . PHP_EOL;
        echo 'Result: ';
        if (Place::crawl()) {
            echo 'OK';
        } else {
            echo 'Failed';
        }
        echo PHP_EOL;
        echo 'Finish: ' . date('Y-mm-dd H:i:s') . PHP_EOL;
    }
}
