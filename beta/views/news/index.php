<?php
use app\assets\NewsIndexAsset;
use yii\helpers\Url;

NewsIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tin tức';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-9">
        </div>
        <div id="right-side" class="col-md-3 hidden-sm hidden-xs">
            <div class="row" style="margin-left: -10px">
                <div id="popular-box">
                </div>
                <div id="panel-box">
                    <div class="panel">
                        <img src="http://placehold.it/600x900">
                    </div>
                    <div class="panel">
                        <img src="http://placehold.it/600x900">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
