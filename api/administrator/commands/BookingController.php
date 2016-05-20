<?php

namespace app\commands;

use app\models\Booking;
use app\models\Bill;
use app\models\Country;
use app\models\Notification;

class BookingController extends \yii\console\Controller
{

    public function actionNoticeUncompleted()
    {
        if (Notification::hasNewUncompletedBooking()) {
            $total = Booking::find()->where(['status' => 0])->count();
            if ($total > 0) {
                $this->sendMail("Bạn có $total lượt đặt vé chưa xử lý", 'booking/notice-uncompleted', ['total' => $total]);
            }
            Notification::setNewUncompletedBooking(false);
        }
    }

    public function actionNoticeNewBill()
    {
        if (Notification::hasNewBill()) {
            $total = Bill::find()->count();
            if ($total > 0) {
                $this->sendMail("Bạn có $total yêu cầu xuất hóa đơn", 'booking/notice-new-bill', ['total' => $total]);
            }
            Notification::setNewBill(false);
        }
    }

    private function sendMail($title, $view, $data = [])
    {
        \Yii::$app->mailer->compose($view, $data)
            ->setFrom(\Yii::$app->params['serverEmail'])
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject($title)
            ->send();
    }
}
