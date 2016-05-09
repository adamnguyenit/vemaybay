<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Spaceless;
use app\assets\AppAsset;

$bundle = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php Spaceless::begin() ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cache-control" content="max-age=0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT">
    <meta http-equiv="pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="<?= Html::encode(Yii::t('app', $this->title)) ?>">
    <meta name="description" content="<?= Html::encode('Vé máy bay Hải Phi Yến cung cấp dịch vụ đặt mua vé máy bay trong nước và quốc tế rẻ nhất') ?>">
    <?= Html::csrfMetaTags() ?>
    <meta property="fb:app_id" content="1720543934884790">
    <title><?= Html::encode(Yii::t('app', $this->title)) ?></title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>body{padding:0;margin:0;overflow:hidden;width:100%;height:100%}#loading{background-color:#3b89c9;height:100%;width:100%;position:fixed;z-index:999999;margin-top:0;top:0}#loading-center{width:100%;height:100%;position:relative}#loading-center-absolute{position:absolute;left:50%;top:50%;height:150px;width:150px;margin-top:-75px;margin-left:-75px}.object{width:50px;height:50px;background-color:#FFFFFF;float:left;margin-top:65px;-moz-border-radius:50%;-webkit-border-radius:50%;border-radius:50%}#object_one{-webkit-animation:object_one 1.5s infinite;animation:object_one 1.5s infinite}#object_two{-webkit-animation:object_two 1.5s infinite;animation:object_two 1.5s infinite;-webkit-animation-delay:.25s;animation-delay:.25s}#object_three{-webkit-animation:object_three 1.5s infinite;animation:object_three 1.5s infinite;-webkit-animation-delay:.5s;animation-delay:.5s}@-webkit-keyframes object_one{75%{-webkit-transform:scale(0)}}@keyframes object_one{75%{transform:scale(0);-webkit-transform:scale(0)}}@-webkit-keyframes object_two{75%{-webkit-transform:scale(0)}}@keyframes object_two{75%{transform:scale(0);-webkit-transform:scale(0)}}@-webkit-keyframes object_three{75%{-webkit-transform:scale(0)}}@keyframes object_three{75%{transform:scale(0);-webkit-transform:scale(0)}}</style>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="fb-root"></div>
    <script>!function(e,t,n){var o,c=e.getElementsByTagName(t)[0];e.getElementById(n)||(o=e.createElement(t),o.id=n,o.src="//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1720543934884790",c.parentNode.insertBefore(o,c))}(document,"script","facebook-jssdk");</script>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
            </div>
        </div>
    </div>
    <div id="page">
        <div id="top-page" class="container-fluid bg-white">
            <div class="row">
                <div class="container">
                    <div class="col-md-12">
                        <div class="row">
                            <div id="logo" class="col-sm-6">
                                <div class="row">
                                    <a href="<?= Url::toRoute(['flight/index']) ?>"><img src="<?= \Yii::getAlias("$bundle->baseUrl/images/logo.png") ?>"></a>
                                </div>
                            </div>
                            <div id="contact" class="col-sm-6 hidden-xs">
                                <div class="row">
                                    <div id="contact-phone" class="pull-right">
                                        <p style="margin-bottom: 0"><span class="text-info">Hotline</span>: <a class="text-danger" href="tel:0913 642 748">0913.642.748</a> - <a class="text-danger" href="tel:0914 650 511">0914.650.511</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="nav-page" class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-default bg-blue color-white">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span id="navbar-phone" class="visible-xs-block"><span class="fa fa-phone"></span> <a class="color-white" href="tel:0913 642 748">0913.642.748</a></span>
                        </div>
                        <div id="navbar-main" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= Url::toRoute(['flight/index']) ?>"><span class="fa fa-plane"></span> Vé máy bay <span class="sr-only">(current)</span></a></li>
                                <li><a href="<?= Url::toRoute(['promotion-news/index']) ?>"><span class="fa fa-gift"></span> Khuyến mãi</span></a></li>
                                <li><a href="<?= Url::toRoute(['news/index']) ?>"><span class="fa fa-newspaper-o"></span> Tin tức</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div id="content-page">
            <?= $content ?>
            <div id="places-box-from" class="places-box modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Chọn điểm đi</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="row agent" style="margin-right: -5px">
                                            <h5 class="color-red">Quốc nội</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row international"  style="margin-right: -5px">
                                            <h5 class="color-red">Quốc tế</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Hoặc nhập địa điểm</h5>
                                    <input class="form-control places-suggestion" type="text" placeholder="Nhập địa điểm">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="places-box-to" class="places-box modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Chọn điểm đến</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="row agent" style="margin-right: -5px">
                                            <h5 class="color-red">Quốc nội</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row international"  style="margin-right: -5px">
                                            <h5 class="color-red">Quốc tế</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Hoặc nhập địa điểm</h5>
                                    <input class="form-control places-suggestion" type="text" placeholder="Nhập địa điểm">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer id="bottom-page" class="container-fluid bg-blue">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 hidden-xs">
                        <div class="row">
                            <div class="fb-page" data-href="https://www.facebook.com/vemaybayhaiphiyen" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                                <div class="fb-xfbml-parse-ignore">
                                    <blockquote cite="https://www.facebook.com/vemaybayhaiphiyen"><a href="https://www.facebook.com/vemaybayhaiphiyen">vemaybayhaiphiyen.com</a></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row color-white">
                            <h4>Đại lý vé máy bay Hải Phi Yến</h4>
                            <ul>
                                <li>Địa chỉ: 665 Nguyễn Hữu Thọ, Q. Cẩm Lệ, TP. Đà Nẵng</li>
                                <li>Hotline: <a class="color-white" href="tel:0913 642 748">0913.642.748</a> - <a class="color-white" href="tel:0914 650 511">0914.650.511</a></li>
                                <li>Zalo: 0913.642.748</li>
                                <li>Email: <a class="color-white" href="mailto:vemaybayhaiphiyen@gmail.com">vemaybayhaiphiyen@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row color-white">
                    <div class="col-md-12">
                        <div class="row">
                            <i><span class="fa fa-copyright"></span> 2016 - Bản quyền của Công Ty Hải Phi Yến</i>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php Spaceless::end(); ?>
<?php $this->endPage() ?>
