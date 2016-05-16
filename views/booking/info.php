<?php
use app\assets\BookingInfoAsset;
use yii\helpers\Url;

BookingInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Giao dịch #' . $data['id'];
?>
<div class="container">
    <input id="id" type="hidden" value="<?= $data['id'] ?>">
</div>
