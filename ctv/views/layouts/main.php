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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <div id="page-header">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">Cộng tác viên</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="/"><i class="fa fa-dashboard"></i> Trang chính</a></li>
                            <li><a href="/ve-may-bay.html"><i class="fa fa-plane"></i> Vé máy bay</a></li>
                            <li class="dropdown">
                                <a href="/giao-dich.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-exchange"></i> Giao dịch <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/giao-dich/danh-sach.html">Danh sách</a></li>
                                    <li><a href="/giao-dich/chua-xuat-ve.html">Chưa xuất vé</a></li>
                                    <li><a href="/giao-dich/da-xuat-ve.html">Đã xuất vé</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/giao-dich/da-huy.html">Đã hủy</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a id="user" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a id="logout-btn" href="#">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div id="page-content"><?= $content ?></div>
    </div>
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
    <div id="message-box" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông báo</h4>
                </div>
                <div class="modal-body">
                    <p>Vui lòng điền đầy đủ thông tin.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php Spaceless::end(); ?>
<?php $this->endPage() ?>
