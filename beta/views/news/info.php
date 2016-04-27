<?php
use app\assets\NewsInfoAsset;
use yii\helpers\Url;

NewsInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tin tức';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-8">
            <div class="row">
                <div id="news-box" class="bg-white">
                    <h1 class="color-red">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</h1>
                    <p class="text-muted"><span class="fa fa-calendar"></span> Thứ 2, 24/04/2016</p>
                    <p><b>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</b></p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <div style="text-align: center">
                        <img class="img-resposive" src="http://placehold.it/600x350" style="text-align: center">
                    </div>
                    <div style="text-align: center">
                        <i>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</i>
                    </div>
                    <p></p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <div style="text-align: center">
                        <img src="http://placehold.it/600x350" style="text-align: center">
                    </div>
                    <div style="text-align: center">
                        <i>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</i>
                    </div>
                    <p></p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <p></p>
                    <div style="text-align: right">
                        <b>Source:</b> <a href="#">abc.com</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="right-side" class="col-md-4 hidden-sm hidden-xs">
            <div id="popular-box">
                <div class="popular-news bg-white">
                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button">Đọc tiếp</a>
                </div>
                <div class="popular-news bg-white">
                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button">Đọc tiếp</a>
                </div>
                <div class="popular-news bg-white">
                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo ligula eget dolor.</p>
                    <a class="btn btn-sm btn-primary pull-right" href="<?= Url::toRoute(['news/info', 'alias' => 'lorem-ipsum-dolor-sit-amet-consectetuer-adipiscing-elit']) ?>" role="button">Đọc tiếp</a>
                </div>
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
