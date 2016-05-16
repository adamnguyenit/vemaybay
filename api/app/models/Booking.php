<?php

namespace app\models;

use yii\helpers\Json;
use app\models\Baggage;

class Booking extends \yii\db\ActiveRecord
{

    public static $description = [
        'BG15' => 'Hành lý 15kg',
        'BG20' => 'Hành lý 20kg',
        'BG25' => 'Hành lý 25kg',
        'BG30' => 'Hành lý 30kg',
        'BG35' => 'Hành lý 35kg',
        'BG40' => 'Hành lý 40kg',
    ];

    public static function create($roundTrip, $tickets, $passengers, $payment, $contact, $price, $adult, $child = 0, $infant = 0, $options = [])
    {
        $model = new static();
        $model->round_trip = intval($roundTrip);
        $model->tickets = Json::encode($tickets);
        $model->passengers = Json::encode($passengers);
        $model->payment = Json::encode($payment);
        $model->price = intval($price);
        $model->contact_name = $contact['name'];
        $model->contact_phone = $contact['phone'];
        $model->contact_email = $contact['email'];
        $model->adult = $adult;
        $model->child = $child;
        $model->infant = $infant;
        if (!empty($options)) {
            $model->options = Json::encode($options);
        }
        $model->created_at = time();
        if (!$model->save()) {
            return null;
        }
        $model->identity = str_pad($model->id, 8, '0', STR_PAD_LEFT);
        if (!$model->save()) {
            return null;
        }
        return $model;
    }

    public function fields()
    {
        return [
            'id',
            'identity',
            'people',
            'contact',
            'price',
            'priceDetail',
            'paymentDetail',
            'passengersDetail',
            'ticketsDetail',
            'status',
            'createdAt',
        ];
    }

    public function getPeople()
    {
        return [
            'adult' => intval($this->adult),
            'child' => intval($this->child),
            'infant' => intval($this->infant),
        ];
    }

    public function getContact()
    {
        return [
            'name' => $this->contact_name,
            'phone' => $this->contact_phone,
            'email' => $this->contact_email,
        ];
    }

    public function getPaymentDetail()
    {
        return Json::decode($this->payment);
    }

    public function getPassengersDetail()
    {
        return Json::decode($this->passengers);
    }

    public function getTicketsDetail()
    {
        return Json::decode($this->tickets);
    }

    public function getPriceDetail()
    {
        $result = [];
        $tickets = $this->ticketsDetail;
        $departOption = [];
        if (!empty($tickets['depart'])) {
            if (count($tickets['depart']['ticket']['ticketOptions']) == 1) {
                $departOption = $tickets['depart']['ticket']['ticketOptions'][0];
            } else {
                foreach ($tickets['depart']['ticket']['ticketOptions'] as $option) {
                    if ((empty($tickets['depart']['fareBasis']) && empty($options['fareBasis'])) || ($tickets['depart']['fareBasis'] == $option['fareBasis'])) {
                        $departOption = $option;
                        break;
                    }
                }
            }
        }
        if (!empty($departOption)) {
            $result['depart'] = $departOption['priceSummary'];
        }
        $returnOption = [];
        if (!empty($tickets['return'])) {
            if (count($tickets['return']['ticket']['ticketOptions']) == 1) {
                $returnOption = $tickets['return']['ticket']['ticketOptions'][0];
            } else {
                foreach ($tickets['return']['ticket']['ticketOptions'] as $option) {
                    if ((empty($tickets['return']['fareBasis']) && empty($options['fareBasis'])) || ($tickets['return']['fareBasis'] == $option['fareBasis'])) {
                        $returnOption = $option;
                        break;
                    }
                }
            }
        }
        if (!empty($returnOption)) {
            $result['return'] = $returnOption['priceSummary'];
        }

        $passengersDetail = $this->passengersDetail;
        foreach ($passengersDetail as $type => $passengers) {
            foreach ($passengers as $passenger) {
                if (!empty($passenger['baggage'])) {
                    foreach ($passenger['baggage'] as $key => $value) {
                        if (empty($value)) {
                            continue;
                        }
                        $baggage = Baggage::find()->where(['airline' => $tickets['depart']['ticket']['airline'], 'code' => $value])->limit(1)->one();
                        $price = $baggage !== null ? $baggage->price : 0;
                        if (empty($result[$key]['baggage'][$value])) {
                            $result[$key]['baggage'][$value] = [
                                'description' => static::$description[$value],
                                'price' => $price,
                                'quantity' => 1,
                                'total' => $price,
                            ];
                        } else {
                            $result[$key]['baggage'][$value]['quantity']++;
                            $result[$key]['baggage'][$value]['total']+= $price;
                        }
                    }
                }
            }
        }

        // Fix result
        foreach ($result as $type => $priceArr) {
            foreach ($priceArr as $priceType => $passengerArr) {
                foreach ($passengerArr as $passengerType => $passengers) {
                    $result[$type][$priceType][$passengerType]['price'] = intval($result[$type][$priceType][$passengerType]['price']);
                    $result[$type][$priceType][$passengerType]['total'] = intval($result[$type][$priceType][$passengerType]['total']);
                    $result[$type][$priceType][$passengerType]['quantity'] = intval($result[$type][$priceType][$passengerType]['quantity']);
                }
            }
        }
        return $result;
    }

    public function getCreatedAt()
    {
        $titles = [
            'Mon' => 'Thứ 2',
            'Tue' => 'Thứ 3',
            'Wed' => 'Thứ 4',
            'Thu' => 'Thứ 5',
            'Fri' => 'Thứ 6',
            'Sat' => 'Thứ 7',
            'Sun' => 'CN',
        ];
        return empty($this->created_at) ? null : $titles[date('D', $this->created_at)] . ', ngày ' . date('d/m/Y', $this->created_at);
    }
}
