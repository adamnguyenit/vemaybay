<?php
use app\assets\BookingInfoAsset;
use yii\helpers\Url;

BookingInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Giao dịch #' . $data['id'];
?>
<div class="container">
    <input id="id" type="hidden" value="<?= $data['id'] ?>">
    <div class="row">
        <div class="col-md-12">
            <div id="booking-box" class="row bg-white">Đang tải, quý khách vui lòng đợi trong giây lát</div>
        </div>
    </div>
</div>
