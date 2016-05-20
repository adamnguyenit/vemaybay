<?php
use app\assets\DashboardIndexAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = DashboardIndexAsset::register($this);
$this->title = 'Cộng tác viên - Trang chính';
$weatherLocations = array_chunk($weatherLocations, 4);
?>
<div class="container-fluid">
    <?php foreach ($weatherLocations as $weatherLocationsArr) : ?>
    <div class="row">
        <?php foreach ($weatherLocationsArr as $weatherLocation) : ?>
        <div class="col-md-3">
            <div class="row">
                <div class="weather-box" data-location="<?= $weatherLocation ?>"></div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
</div>
