<?php
use app\assets\FlightIndexAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightIndexAsset::register($this);
$this->title = 'Cộng tác viên - Vé máy bay';
$departTitle = 'Chiều đi';
$returnTitle = 'Chiều về';
if (!empty($defaults['place-from']) && !empty($defaults['place-to'])) {
    $from = explode(' - ', $defaults['place-from']);
    unset($from[count($from) - 1]);
    $from = implode(' - ', $from);
    $to = explode(' - ', $defaults['place-to']);
    unset($to[count($to) - 1]);
    $to = implode(' - ', $to);
    $departTitle = "$from - $to";
    $returnTitle = "$to - $from";
}
$paramsName = ['round-trip', 'place-from', 'place-to', 'date-depart', 'date-return', 'adult', 'child', 'infant'];
?>
<div id="params">
    <?php foreach ($paramsName as $name) : ?>
    <input name="params_<?= $name ?>" value="<?= !isset($defaults[$name]) ? null : $defaults[$name] ?>" type="hidden">
    <?php endforeach ?>
</div>
<div class="container-fluid">
    <div class="row">
        <div id="left-side" class="col-md-4 bg-white">
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
                                <select class="select form-control" name="adult">
                                    <?php foreach (range(1, 30) as $index) : ?>
                                    <option value="<?= $index ?>"<?= $index == $defaults['adult'] ? ' selected' : null ?>><?= $index ?></option>
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
                                    <option value="<?= $index ?>"<?= $index == $defaults['child'] ? ' selected' : null ?>><?= $index ?></option>
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
                                    <option value="<?= $index ?>"<?= $index == $defaults['infant'] ? ' selected' : null ?>><?= $index ?></option>
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
        <div id="right-side" class="col-md-8">
            <div class="row">
                <ul id="tabs-panel" class="nav nav-tabs">
                    <li class="active"><a id="depart-tab-trigger" data-toggle="tab" href="#depart-box"><?= $departTitle ?></a></li>
                    <li <?= empty($defaults['round-trip']) ? ' style="display: none"' : null ?>><a id="return-tab-trigger" data-toggle="tab" href="#return-box"><?= $returnTitle ?></a></li>
                    <li id="search-progress" class="pull-right color-white hide-when-done"><i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i><span class="sr-only">Đang tải...</span></li>
                </ul>
                <div id="tabs-content" class="tab-content">
                    <div id="depart-box" class="tab-pane fade in active">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="table-responsive" style="margin-bottom: 0">
                                    <table id="depart-dates" class="table text-center dates">
                                        <tbody>
                                            <tr>
                                                <?php if (!empty($dates['depart'])) : ?>
                                                    <?php foreach ($dates['depart'] as $date) : ?>
                                                        <?php $url = empty($date['depend']) ? Url::current(['date-depart' => $date['date']]) : Url::current(['date-depart' => $date['date'], 'date-return' => $date['depend']]) ?>
                                                <td class="flight-date<?= empty($date['active']) ? null : ' active' ?>">
                                                    <a href="<?= $url ?>">
                                                        <p><?= $date['title'] ?></p>
                                                        <p><?= $date['date_short'] ?></p>
                                                    </a>
                                                </td>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <table id="depart-table" class="table table-hover tickets-table bg-white">
                            <thead>
                                <tr>
                                    <th style="color: #000000 !important">Hãng</th>
                                    <th style="color: #000000 !important">Giờ bay</th>
                                    <th style="color: #000000 !important">Thời gian bay</th>
                                    <th style="color: #000000 !important">Chuyến</th>
                                    <th style="color: #000000 !important">Giá từ</th>
                                    <th style="color: #000000 !important">Tình trạng</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="return-box" class="tab-pane fade">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="table-responsive" style="margin-bottom: 0">
                                    <table id="return-dates" class="table text-center dates">
                                        <tbody>
                                            <tr>
                                                <?php if (!empty($dates['return'])) : ?>
                                                    <?php foreach ($dates['return'] as $date) : ?>
                                                <td class="flight-date<?= empty($date['active']) ? null : ' active' ?>">
                                                    <a href="<?= Url::current(['date-return' => $date['date']]) ?>">
                                                        <p><?= $date['title'] ?></p>
                                                        <p><?= $date['date_short'] ?></p>
                                                    </a>
                                                </td>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <table id="return-table" class="table table-hover tickets-tables bg-white">
                            <thead>
                                <tr>
                                    <th style="color: #000000 !important">Hãng</th>
                                    <th style="color: #000000 !important">Giờ bay</th>
                                    <th style="color: #000000 !important">Thời gian bay</th>
                                    <th style="color: #000000 !important">Chuyến</th>
                                    <th style="color: #000000 !important">Giá từ</th>
                                    <th style="color: #000000 !important">Tình trạng</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="choose-tickets" class="row" style="display: none">
                <div class="col-md-12"><h4>Vé đã chọn</h4></div>
                <div id="choose-tickets-body"></div>
                <div id="next-step">
                    <div class="col-md-12">
                        <a href="/ve-may-bay/dat-ve.html" class="btn btn-raised btn-primary pull-right" role="button">Tiếp theo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="scroll-to-next" class="bg-red color-white">Đặt vé</div>
