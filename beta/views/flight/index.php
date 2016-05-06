<?php
use app\assets\FlightIndexAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến';
?>
<h1 style="display: none"><?= Html::encode($this->title) ?></h1>
<div class="container-fluid">
    <div id="content-page-container" class="row hidden-xs">
        <div id="promotions-slider" class="carousel slide" data-ride="carousel">
            <a class="left carousel-control" href="#promotions-slider" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Trước</span>
            </a>
            <a class="right carousel-control" href="#promotions-slider" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Sau</span>
            </a>
        </div>
        <div id="book-form-large" class="col-sm-3">
            <form action="<?= Url::toRoute(['flight/search']) ?>" role="form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="radio">
                            <label class="color-black"><input type="radio" name="round-trip" value="0" checked>Một chiều</label>
                        </div>
                        <div class="radio">
                            <label class="color-black"><input type="radio" name="round-trip" value="1">Khứ hồi</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating col-sm-6">
                            <div class="row" style="margin-right: 5px">
                                <label class="control-label">Điểm đi</label>
                                <div class="input-group">
                                    <input class="form-control linked places-suggestion" type="text" name="place-from" value="<?= empty($defaults['fromPlace']) ? null : $defaults['fromPlace'] ?>">
                                    <div class="input-group-addon places-picker" data-toggle="modal" data-target="#places-box-from">
                                        <span class="fa fa-map-o"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-6">
                            <div class="row">
                                <label class="control-label">Điểm đến</label>
                                <div class="input-group">
                                    <input class="form-control linked places-suggestion" type="text" name="place-to" value="<?= empty($defaults['toPlace']) ? null : $defaults['toPlace'] ?>">
                                    <div class="input-group-addon places-picker" data-toggle="modal" data-target="#places-box-to">
                                        <span class="fa fa-map-o"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating col-sm-6">
                            <div class="row" style="margin-right: 5px">
                                <label class="control-label">Ngày đi</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker linked" type="text" name="date-depart" value="<?= empty($defaults['departDate']) ? null : $defaults['departDate'] ?>" readonly>
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-6">
                            <div class="row show-unless-round-trip" style="display: none">
                                <label class="control-label">Ngày về</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker linked" type="text" name="date-return" value="<?= empty($defaults['returnDate']) ? null : $defaults['returnDate'] ?>" readonly>
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-static col-sm-4">
                            <div class="row" style="margin-right: 5px">
                                <label class="control-label color-black">Người lớn</label>
                                <select class="select form-control linked" name="adult">
                                    <?php foreach (range(1, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"><code>trên 12 tuổi</code></span>
                            </div>
                        </div>
                        <div class="form-group label-static col-sm-4">
                            <div class="row" style="margin-right: 5px">
                                <label class="control-label color-black">Trẻ em</label>
                                <select class="select form-control linked" name="child">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"><code>2 đến 12 tuổi</code></span>
                            </div>
                        </div>
                        <div class="form-group label-static col-sm-4">
                            <div class="row">
                                <label class="control-label color-black">Em bé</label>
                                <select class="select form-control linked" name="infant">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block"><code>dưới 2 tuổi</code></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-raised pull-right" role="button">Tìm vé</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="book-form-small" class="visible-xs-block">
            <form action="<?= Url::toRoute(['flight/search']) ?>" role="form">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-top: 15px">
                            <select class="select form-control" name="round-trip">
                                <option value="0" selected="">Một chiều</option>
                                <option value="1">Khứ hồi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating col-sm-6" style="margin-top: 15px">
                            <div class="row">
                                <label class="control-label">Điểm đi</label>
                                <div class="input-group">
                                    <input class="form-control linked places-suggestion" type="text" name="place-from" value="<?= empty($defaults['fromPlace']) ? null : $defaults['fromPlace'] ?>">
                                    <div class="input-group-addon places-picker" data-toggle="modal" data-target="#places-box-from">
                                        <span class="fa fa-map-o"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-6" style="margin-top: 15px">
                            <div class="row">
                                <label class="control-label">Điểm đến</label>
                                <div class="input-group">
                                    <input class="form-control linked places-suggestion" type="text" name="place-to" value="<?= empty($defaults['toPlace']) ? null : $defaults['toPlace'] ?>">
                                    <div class="input-group-addon places-picker" data-toggle="modal" data-target="#places-box-to">
                                        <span class="fa fa-map-o"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating col-xs-6" style="margin-top: 15px">
                            <div class="row" style="margin-right: -5px">
                                <label class="control-label">Ngày đi</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker linked" type="text" value="<?= empty($defaults['departDate']) ? null : $defaults['departDate'] ?>" name="date-depart" readonly>
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating col-xs-6" style="margin-top: 15px">
                            <div class="row show-unless-round-trip" style="display: none">
                                <label class="control-label">Ngày về</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker linked" type="text" value="<?= empty($defaults['returnDate']) ? null : $defaults['returnDate'] ?>" name="date-return" readonly>
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-static col-xs-4" style="margin-top: 15px">
                            <div class="row" style="margin-right: 0">
                                <label class="control-label color-black">Người lớn</label>
                                <select class="select form-control linked" name="adult">
                                    <?php foreach (range(1, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 11px">> 12 tuổi</code>
                            </div>
                        </div>
                        <div class="form-group label-static col-xs-4" style="margin-top: 15px">
                            <div class="row" style="margin-right: 0">
                                <label class="control-label color-black">Trẻ em</label>
                                <select class="select form-control linked" name="child">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 11px">2 - 12 tuổi</code>
                            </div>
                        </div>
                        <div class="form-group label-static col-xs-4" style="margin-top: 15px">
                            <div class="row">
                                <label class="control-label color-black">Em bé</label>
                                <select class="select form-control linked" name="infant">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 11px">< 2 tuổi</code>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-raised pull-right" role="button">Tìm vé</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
