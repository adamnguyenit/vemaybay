<?php
use app\assets\PromotionNewsInfoAsset;
use yii\helpers\Url;

PromotionNewsInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Khuyến mãi';
?>
<div class="container">
    <div class="row">
        <div id="left-side" class="col-md-3 hidden-sm hidden-xs">
            <div class="row bg-white" style="margin-right: -7px; margin-top: 0">
                <div id="book-form" class="col-md-12">
                    <form action="<?= Url::toRoute(['flight/search']) ?>" role="form">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <div class="radio">
                                    <label class="color-black">
                                        <input type="radio" name="round-trip" value="0" checked>Một chiều
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="color-black">
                                        <input type="radio" name="round-trip" value="1">Khứ hồi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row" style="margin-right: 5px">
                                        <label class="control-label">Điểm đi</label>
                                        <input class="form-control" type="text" name="place-from">
                                    </div>
                                </div>
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row">
                                        <label class="control-label">Điểm đến</label>
                                        <input class="form-control" type="text" name="place-to">
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
                                            <input class="form-control datepicker" type="text" readonly name="date-depart">
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
                                            <input class="form-control datepicker" type="text" readonly name="date-return">
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
                                        <select class="select form-control" name="adult" data-value="21">
                                            <?php foreach (range(1, 30) as $index) : ?>
                                            <option value="<?= $index ?>"><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row" style="margin-right: 5px">
                                        <label class="control-label color-black">Trẻ em</label>
                                        <select class="select form-control" name="child">
                                            <?php foreach (range(0, 30) as $index) : ?>
                                            <option value="<?= $index ?>"><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row">
                                        <label class="control-label color-black">Em bé</label>
                                        <select class="select form-control" name="infant">
                                            <?php foreach (range(0, 30) as $index) : ?>
                                            <option value="<?= $index ?>"><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
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
            <div class="row" style="margin-right: -7px">
                <div id="panel-box"></div>
            </div>
        </div>
        <div id="right-side" class="col-md-9">
            <div class="row">
                <div id="promotion-news-box" class="bg-white"></div>
            </div>
        </div>
    </div>
</div>
