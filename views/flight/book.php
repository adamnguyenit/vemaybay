<?php
use app\assets\FlightBookAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightBookAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến - Hoàn tất đặt vé';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3" style="margin-bottom: 5px">
                <div class="row bg-white left-panel">
                    <div id="price-box"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div id="choose-tickets"></div>
                </div>
                <div class="row bg-white">
                    <div id="people"></div>
                </div>
                <div class="row bg-white">
                    <div id="contact">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Người liên hệ</h4>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <input class="form-control" name="contact[name]" placeholder="Họ và tên">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control" name="contact[phone]" placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="options">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Xuất hóa đơn</h4>
                                </div>
                                <div class="form-group">
                                    <div class="radio"><label><input type="radio" name="options[bill]" value="1"> Có</label>
                                    <div class="radio"><label><input type="radio" name="options[bill]" value="0" checked> Không</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
