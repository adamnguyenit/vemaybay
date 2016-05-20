<?php

namespace app\controllers;

class DashboardController extends Controller
{

    public function actionIndex()
    {
        $weatherLocations = [
            'Ha Noi, VN',
            'Hai Phong, VN',
            'Hue, VN',
            'Da Nang, VN',
            'Da Lat, VN',
            'Nha Trang, VN',
            'Vung Tau, VN',
            'Ho Chi Minh, VN',
            'Cà Mau, VN',
            'Phu Quoc, VN'
        ];
        return $this->render('index', ['weatherLocations' => $weatherLocations]);
    }
}
