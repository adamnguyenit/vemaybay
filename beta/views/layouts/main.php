<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

$bundle = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::t('app', $this->title)) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php $this->beginBody() ?>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div id="page">
        <div id="top-page" class="container-fluid bg-white">
            <div class="container">
                <div class="row">
                    <div id="logo" class="col-sm-6">
                        <img src="<?= \Yii::getAlias("$bundle->baseUrl/images/logo.png") ?>">
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
                                <li><a href="/"><span class="fa fa-plane"></span> Vé máy bay <span class="sr-only">(current)</span></a></li>
                                <li><a href="<?= Url::toRoute(['promotion-news/index']) ?>"><span class="fa fa-bar-chart-o"></span> Khuyến mãi</span></a></li>
                                <li><a href="<?= Url::toRoute(['news/index']) ?>"><span class="fa fa-newspaper-o"></span> Tin tức</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div id="content-page">
            <?= $content ?>
        </div>
        <footer id="bottom-page" class="container-fluid bg-blue">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 hidden-xs">
                        <div class="fb-page" data-href="https://www.facebook.com/vemaybayhaiphiyen" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/vemaybayhaiphiyen"><a href="https://www.facebook.com/vemaybayhaiphiyen">vemaybayhaiphiyen.com</a></blockquote>
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
                    <div class="col-md-12"><i><span class="fa fa-copyright"></span> 2016 - Bản quyền của Công Ty Hải Phi Yến</i></div>
                </div>
            </div>
        </footer>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
