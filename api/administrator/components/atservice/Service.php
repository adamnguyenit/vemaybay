<?php

namespace app\components\atservice;

class Service extends \yii\base\Component
{

    public $username;
    public $password;

    public function init()
    {
        parent::init();
        \atservice\Service::setAccount($this->username, $this->password);
    }

    public function getPriceOptions()
    {
        return \atservice\Service::getPriceOptions();
    }

    public function updatePriceOption($id, $params)
    {
        return \atservice\Service::updatePriceOption($id, $params);
    }

}
