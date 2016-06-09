<?php

namespace app\commands;

use app\models\CheapestTicket;
use atservice\TicketQuery;

class CheapestController extends \yii\console\Controller
{
    public $sources = ['VietJetAir', 'JetStar', 'VietnamAirlines'];

    public function actionFind()
    {
        $count = 0;
        $result = [];
        $models = CheapestTicket::find()->all();
        foreach ($models as $model) {
            $cheapest = null;
            $cheapestSource = null;
            $realDepartDate = $this->_convertDate($model->date_depart);
            $data = [
                'roundTrip' => false,
                'fromPlace' => $model->from,
                'toPlace' => $model->to,
                'adult' => 1,
                'departDate' => $realDepartDate,
                'returnDate' => $realDepartDate,
            ];
            foreach ($this->sources as $source) {
                $data['sources'] = $source;
                $tickets = \Yii::$app->atservice->getTickets(new TicketQuery($data));
                if (!empty($tickets)) {
                    foreach ($tickets as $ticket) {
                        if ($cheapest === null || $cheapest > $ticket->priceFrom) {
                            $cheapest = $ticket->priceFrom;
                            $cheapestSource = $source;
                        }
                    }
                }
            }
            if (!empty($cheapest) && !empty($cheapestSource)) {
                $model->price = $cheapest;
                $model->source = $cheapestSource;
                $model->updated_at = time();
                $model->save();
                if ($cheapest <= $model->expect) {
                    $result[] = $model;
                    $count++;
                }
            }
        }
        echo "$count\n";
        if ($count > 0) {
            $this->sendMail("Bạn có $count chặng vé rẻ đạt yêu cầu", 'cheapest/notice', ['total' => $count, 'result' => $result]);
        }
    }

    protected function _convertDate($date)
    {
        $dateArr = explode('/', $date);
        if (!empty($dateArr) && count($dateArr) == 3) {
            return "{$dateArr[2]}-{$dateArr[1]}-{$dateArr[0]}";
        }

        return;
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
