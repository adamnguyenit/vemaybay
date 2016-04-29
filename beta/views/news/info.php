<?php
use app\assets\NewsInfoAsset;
use yii\helpers\Url;

NewsInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tin tức';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-9">
            <div class="row">
                <div id="news-box" class="bg-white"></div>
            </div>
        </div>
        <div id="right-side" class="col-md-3 hidden-sm hidden-xs">
            <div class="row" style="margin-left: -10px">
                <div id="popular-box"></div>
                <div id="panel-box"></div>
            </div>
        </div>
    </div>
</div>
