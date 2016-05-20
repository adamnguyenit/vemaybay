<?php

namespace app\commands;

use app\models\Booking;
use app\models\Bill;
use app\models\Country;

class BookingController extends \yii\console\Controller
{

    public function actionNoticeUncompleted()
    {
        $total = Booking::find()->where(['status' => 0])->count();
        if ($total > 0) {
            \Yii::$app->mailer->compose('booking/notice-uncompleted', ['total' => $total])
                ->setFrom(\Yii::$app->params['serverEmail'])
                ->setTo(\Yii::$app->params['adminEmail'])
                ->setSubject("Bạn có $total lượt đặt vé chưa xử lý")
                ->send();
        }
    }

    public function actionNoticeNewBill()
    {
        $total = Bill::find()->count();
        if ($total > 0) {
            \Yii::$app->mailer->compose('booking/notice-new-bill', ['total' => $total])
                ->setFrom(\Yii::$app->params['serverEmail'])
                ->setTo(\Yii::$app->params['adminEmail'])
                ->setSubject("Bạn có $total yêu cầu xuất hóa đơn")
                ->send();
        }
    }

    public function actionIndex()
    {
        $lines = file('es.csv');
        $index = 0;
        foreach ($lines as $line) {
            $arr = explode(',', $line);
            $model = new Country();
            $model->country_code = trim($arr[0]);
            $model->country_name = trim($arr[1]);
            $model->region_name = trim($arr[2]);
            $model->city_name = trim($arr[3]);
            $model->created_at = time();
            $model->save();
            $index++;
            echo "Row $index\n";
        }
    }
}
