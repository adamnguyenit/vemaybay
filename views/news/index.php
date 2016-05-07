<?php
use app\assets\NewsIndexAsset;
use yii\helpers\Url;

NewsIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tin tức';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-9 jscroll">
            <div class="row"><a class="btn btn-primary btn-raised jscroll-next" href="http://api.vemaybay.com/app/news?per-page=5&page=1" style="width: 100%" role="button">Xem thêm</a></div>
        </div>
        <div id="right-side" class="col-md-3 hidden-sm hidden-xs">
            <div class="row" style="margin-left: -10px">
                <div id="popular-box"></div>
                <div id="panel-box"></div>
            </div>
        </div>
    </div>
</div>
