<?php

namespace app\controllers;

class FlightController extends Controller
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
        $defaults = \Yii::$app->request->get();
        if (empty($defaults['round-trip'])) {
            $defaults['round-trip'] = 0;
        }
        if (empty($defaults['place-from'])) {
            $defaults['place-from'] = 'Đà Nẵng - DAD';
        }
        if (empty($defaults['place-to'])) {
            $defaults['place-to'] = 'Hồ Chí Minh - SGN';
        }
        if (empty($defaults['date-depart'])) {
            $defaults['date-depart'] = date('d/m/Y', strtotime('+3 days'));
        }
        if (empty($defaults['date-return'])) {
            $defaults['date-return'] = date('d/m/Y', strtotime('+5 days'));
        }
        if (!isset($defaults['adult'])) {
            $defaults['adult'] = 1;
        }
        if (!isset($defaults['child'])) {
            $defaults['child'] = 0;
        }
        if (!isset($defaults['infant'])) {
            $defaults['infant'] = 0;
        }
        $dates = [];
        if (!empty($defaults['date-depart'])) {
            $dates['depart'] = $this->__calculateDates($this->_convertDate($defaults['date-depart']), null, strtotime($this->_convertDate($defaults['date-return'])));
            if (!empty($defaults['round-trip']) && !empty($defaults['date-return'])) {
                $dates['return'] = $this->__calculateDates($this->_convertDate($defaults['date-return']), strtotime($this->_convertDate($defaults['date-depart'])));
            }
        }
        return $this->render('index', ['defaults' => $defaults, 'dates' => $dates]);
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

    public function actionBook()
    {
        return $this->render('book');
    }
}
