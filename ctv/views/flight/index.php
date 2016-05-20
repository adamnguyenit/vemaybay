<?php
use app\assets\FlightIndexAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightIndexAsset::register($this);
$this->title = 'Cộng tác viên - Vé máy bay';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 bg-white">
            <form action="/ve-may-bay.html" role="form">
                <div class="row">
                    <div class="form-group col-sm-12" style="margin-top: 5px">
                        <div class="radio">
                            <label class="color-black"><input type="radio" name="round-trip" value="0"<?= empty($defaults['round-trip']) ? ' checked' : null ?>>Một chiều</label>
                            <label class="color-black"><input type="radio" name="round-trip" value="1"<?= !empty($defaults['round-trip']) ? ' checked' : null ?>>Khứ hồi</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group label-floating col-sm-6">
                            <div class="row">
                                <label class="control-label">Điểm đi</label>
                                <div class="input-group">
                                    <input class="form-control linked places-suggestion" type="text" name="place-from" value="<?= empty($defaults['place-from']) ? null : $defaults['place-from'] ?>">
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
                                    <input class="form-control linked places-suggestion" type="text" name="place-to" value="<?= empty($defaults['place-to']) ? null : $defaults['place-to'] ?>">
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
                        <div class="form-group label-floating col-xs-6">
                            <div class="row" style="margin-right: -15px">
                                <label class="control-label">Ngày đi</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker" type="text" readonly name="date-depart" value="<?= empty($defaults['date-depart']) ? null : $defaults['date-depart'] ?>">
                                    <div class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating col-xs-6">
                            <div class="row show-unless-round-trip" <?= empty($defaults['round-trip']) ? 'style="display: none"' : null ?>>
                                <label class="control-label">Ngày về</label>
                                <div class="input-group date" data-provide="datepicker">
                                    <input class="form-control datepicker" type="text" readonly name="date-return" value="<?= empty($defaults['date-return']) ? null : $defaults['date-return'] ?>">
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
                        <div class="form-group label-static col-xs-4">
                            <div class="row">
                                <label class="control-label color-black">Người lớn</label>
                                <select class="select form-control" name="adult" data-value="21">
                                    <?php foreach (range(1, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 10px">> 12 tuổi</code>
                            </div>
                        </div>
                        <div class="form-group label-static col-xs-4">
                            <div class="row">
                                <label class="control-label color-black">Trẻ em</label>
                                <select class="select form-control" name="child">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 10px">< 2 tuổi</code>
                            </div>
                        </div>
                        <div class="form-group label-static col-xs-4">
                            <div class="row">
                                <label class="control-label color-black">Em bé</label>
                                <select class="select form-control" name="infant">
                                    <?php foreach (range(0, 30) as $index) : ?>
                                    <option value="<?= $index ?>"><?= $index ?></option>
                                    <?php endforeach ?>
                                </select>
                                <code style="font-size: 10px">< 2 tuổi</code>
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
