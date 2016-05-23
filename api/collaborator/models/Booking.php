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
        foreach ($passengers as $type => $pass) {
            foreach ($pass as $index => $passenger) {
                $passengers[$type][$index]['name'] = static::removeUnicode($passenger['name']);
                $passengers[$type][$index]['address'] = static::removeUnicode($passenger['address']);
            }
        }
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
        $currentUser = \Yii::$app->user->identity;
        if (!empty($currentUser)) {
            $model->created_by = $currentUser->id;
        }
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
            'statusString',
            'createdAt',
            'baggages',
            'billable' => function() {
                return $this->isBillabe();
            },
            'bill',
            'selectedTicketOptions',
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

    public function getSelectedTicketOptions()
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
            $result['depart'] = $departOption;
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
            $result['return'] = $returnOption;
        }
        return $result;
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

    public function getBaggages()
    {
        $result = [];
        $tickets = $this->ticketsDetail;
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
                        if (empty($result[$key][$value])) {
                            $result[$key][$value] = [
                                'description' => static::$description[$value],
                                'price' => $price,
                                'quantity' => 1,
                                'total' => $price,
                            ];
                        } else {
                            $result[$key][$value]['quantity']++;
                            $result[$key][$value]['total']+= $price;
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function getOptionsDetail()
    {
        if (empty($this->options)) {
            return [];
        }
        return Json::decode($this->options);
    }

    public function getStatusString()
    {
        switch ($this->status) {
            case 0:
                return 'chưa xuất vé';
            case 1:
                return 'đã xuất vé';
            case -1:
                return 'đã hủy';
            default:
                return 'chưa xuất vé';
        }
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

    public function isBillabe()
    {
        $options = $this->optionsDetail;
        if (empty($options) || empty($options['bill'])) {
            return false;
        }
        return true;
    }

    public function getBill()
    {
        $options = $this->optionsDetail;
        if (empty($options) || empty($options['bill'])) {
            return [];
        }
        return $options['bill'];
    }

    public static function decodeDateTime($dateTime)
    {
        $dateTimeArr = explode('T', $dateTime);
        $dateArr = explode('-', $dateTimeArr[0]);
        $timeArr = explode(':', $dateTimeArr[1]);
        return "{$timeArr[0]}:{$timeArr[1]} {$dateArr[2]}/{$dateArr[1]}/{$dateArr[0]}";
    }

    public static function decodePassengerTitle($type, $title)
    {
        $arr = [
            'adult' => [
                'MR' => 'Ông',
                'MRS' => 'Bà',
            ],
            'child' => [
                'MR' => 'Anh',
                'MISS' => 'Chị',
            ],
            'infant' => [
                'MR' => 'Bé trai',
                'MISS' => 'Bé gái',
            ]
        ];
        return $arr[$type][$title];
    }

    public static function removeUnicode($str)
    {
        $unicodes = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
			'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];
        $result = $str;
        foreach($unicodes as $nonUnicode => $unicode){
            $result = preg_replace("/($unicode)/i", $nonUnicode, $result);
        }
        return strtoupper($result);
    }
}
