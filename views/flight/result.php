<?php
use app\assets\FlightResultAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightResultAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến - Đặt vé thành công';
?>
<div class="container bg-white">
    <h2>Bạn đã đặt vé thành công!</h2>
    <p>Mã giao dịch của bạn là <a href="#"><?= $data['id'] ?></a></p>
    <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận và xuất vé.</p>
</div>
