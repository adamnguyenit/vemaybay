<?php

namespace app\controllers;

class FlightController extends \yii\web\Controller
{

    public $subDays = 5;
    public $addDays = 6;
    public $titles = [
        'Mon' => 'Thứ 2',
        'Tue' => 'Thứ 3',
        'Wed' => 'Thứ 4',
        'Thu' => 'Thứ 5',
        'Fri' => 'Thứ 6',
        'Sat' => 'Thứ 7',
        'Sun' => 'CN',
    ];

    public function actionIndex()
    {
        $defaults = [
            'fromPlace' => 'Đà Nẵng - DAD',
            'toPlace' => 'Hồ Chí Minh - SGN',
            'departDate' => date('d/m/Y', strtotime('+3 days')),
            'returnDate' => date('d/m/Y', strtotime('+5 days')),
        ];

        return $this->render('index', ['defaults' => $defaults]);
    }

    public function actionSearch()
    {
        $params = \Yii::$app->request->get();
        $dates = [];
        if (!empty($params['date-depart'])) {
            $dates['depart'] = $this->__calculateDates($this->_convertDate($params['date-depart']), null, strtotime($this->_convertDate($params['date-return'])));
            if (!empty($params['round-trip']) && !empty($params['date-return'])) {
                $dates['return'] = $this->__calculateDates($this->_convertDate($params['date-return']), strtotime($this->_convertDate($params['date-depart'])));
            }
        }

        return $this->render('search', ['params' => $params, 'dates' => $dates]);
    }

    public function actionBook()
    {
        return $this->render('book');
    }

    protected function _convertDate($date)
    {
        $dateArr = explode('/', $date);
        if (!empty($dateArr) && count($dateArr) == 3) {
            return "{$dateArr[2]}-{$dateArr[1]}-{$dateArr[0]}";
        }

        return;
    }

    private function __calculateDates($date, $limit = null, $dependTime = null)
    {
        $unixTime = strtotime($date);
        if (empty($limit)) {
            $limit = time();
        }
        $dayLimit = date('j', $limit);
        $monthLimit = date('n', $limit);
        $result = [];
        $index = 0;
        for ($i = $this->subDays; $i >= 0; --$i) {
            $unixSubTime = strtotime("-$i days", $unixTime);
            if (date('n', $unixSubTime) < $monthLimit || (date('n', $unixSubTime) == $monthLimit && date('j', $unixSubTime) < $dayLimit)) {
                ++$index;
                continue;
            }
            $date = [
                'date' => date('d/m/Y', $unixSubTime),
                'date_short' => date('d/m', $unixSubTime),
                'title' => $this->titles[date('D', $unixSubTime)],
            ];
            if ($i == 0) {
                $date['active'] = true;
            }
            if ($dependTime !== null && $unixSubTime > $dependTime) {
                $date['depend'] = date('d/m/Y', strtotime('+3 days', $unixSubTime));
            }
            $result[] = $date;
        }
        for ($j = 1; $j <= $this->addDays + $index; ++$j) {
            $unixSubTime = strtotime("+$j days", $unixTime);
            $date = [
                'date' => date('d/m/Y', $unixSubTime),
                'date_short' => date('d/m', $unixSubTime),
                'title' => $this->titles[date('D', $unixSubTime)],
            ];
            if ($dependTime !== null && $unixSubTime > $dependTime) {
                $date['depend'] = date('d/m/Y', strtotime('+3 days', $unixSubTime));
            }
            $result[] = $date;
        }

        return $result;
    }
}
