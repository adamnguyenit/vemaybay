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
            </br>
            <div class="row bg-white">
                <div id="comments-box">
                    <div class="fb-comments" data-href="<?= Url::current([], true) ?>" data-numposts="5" data-width="100%"></div>
                </div>
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
