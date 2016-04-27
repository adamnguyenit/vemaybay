<?php
use app\assets\PromotionNewsIndexAsset;
use yii\helpers\Url;

PromotionNewsIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Khuyến mãi';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-4 hidden-sm hidden-xs">
            <div id="panel-box">
                <div class="panel">
                    <img src="http://placehold.it/600x900">
                </div>
                <div class="panel">
                    <img src="http://placehold.it/600x900">
                </div>
            </div>
        </div>
        <div id="right-side" class="col-md-8">
            <div class="row">
                <div id="promotion-news-box">
                    <div class="promotion-news bg-white">
                        <img src="http://placehold.it/1200x400">
                        <h2><a class="color-blue" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                        <a class="btn btn-danger btn-fab pull-right" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button"><i class="material-icons">grade</i></a>
                    </div>
                    <div class="promotion-news bg-white">
                        <img src="http://placehold.it/1200x400">
                        <h2><a class="color-blue" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                        <a class="btn btn-danger btn-fab pull-right" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button"><i class="material-icons">grade</i></a>
                    </div>
                    <div class="promotion-news bg-white">
                        <img src="http://placehold.it/1200x400">
                        <h2><a class="color-blue" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                        <a class="btn btn-danger btn-fab pull-right" href="<?= Url::toRoute(['promotion-news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button"><i class="material-icons">grade</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
