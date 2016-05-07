<?php
use app\assets\FlightSearchAsset;
use yii\helpers\Url;

$bundle = FlightSearchAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tìm vé máy bay';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="row" style="margin-right: -10px">
                <div id="book-form" class="col-md-12 hidden-xs hidden-sm bg-white">
                    <form action="<?= Url::toRoute(['flight/search']) ?>" role="form">
                        <div class="row">
                            <div class="form-group col-sm-12" style="margin-top: 5px">
                                <div class="radio">
                                    <label class="color-black"><input type="radio" name="round-trip" value="0"<?= $params['round-trip'] == 0 ? ' checked' : null ?>>Một chiều</label>
                                </div>
                                <div class="radio">
                                    <label class="color-black"><input type="radio" name="round-trip" value="1"<?= $params['round-trip'] == 1 ? ' checked' : null ?>>Khứ hồi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row" style="margin-right: 0">
                                        <label class="control-label">Điểm đi</label>
                                        <input class="form-control places-suggestion" type="text" name="place-from" value="<?= $params['place-from'] ?>">
                                    </div>
                                </div>
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row">
                                        <label class="control-label">Điểm đến</label>
                                        <input class="form-control places-suggestion" type="text" name="place-to" value="<?= $params['place-to'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row" style="margin-right: -15px">
                                        <label class="control-label">Ngày đi</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input class="form-control datepicker" type="text" readonly name="date-depart" value="<?= $params['date-depart'] ?>">
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row show-unless-round-trip"<?= $params['round-trip'] == 0 ? ' style="display: none"' : null ?>>
                                        <label class="control-label">Ngày về</label>
                                        <div class="input-group date" data-provide="datepicker">
                                            <input class="form-control datepicker" type="text" readonly name="date-return" value="<?= $params['date-return'] ?>">
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
                                    <div class="row" style="margin-right: -10px">
                                        <label class="control-label color-black">Người lớn</label>
                                        <select class="select form-control" name="adult" data-value="21">
                                            <?php foreach (range(1, 9) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['adult'] ? ' selected' : null ?>><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <code style="font-size: 10px">> 12 tuổi</code>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row" style="margin-right: -10px">
                                        <label class="control-label color-black">Trẻ em</label>
                                        <select class="select form-control" name="child">
                                            <?php foreach (range(0, 9) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['child'] ? ' selected' : null ?>><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <code style="font-size: 10px">2 - 12 tuổi</code>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row">
                                        <label class="control-label color-black">Em bé</label>
                                        <select class="select form-control" name="infant">
                                            <?php foreach (range(0, 6) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['infant'] ? ' selected' : null ?>><?= $index ?></option>
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
            <div class="row hidden-xs hidden-sm" style="margin-right: -10px">
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
            </div>
            <div class="row hidden-xs hidden-sm" style="margin-right: -10px">
                <div id="panel-box"></div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <ul id="tabs-panel" class="nav nav-tabs">
                    <li class="active"><a id="depart-tab-trigger" data-toggle="tab" href="#depart-box">Chiều đi</a></li>
                    <li <?= $params['round-trip'] == 0 ? ' style="display: none"' : null ?>><a id="return-tab-trigger" data-toggle="tab" href="#return-box">Chiều về</a></li>
                    <li class="pull-right color-white hide-when-done" style="margin-top: 5px; margin-right: 10px"><i class="fa fa-spinner fa-pulse fa-2x fa-fw margin-bottom"></i><span class="sr-only">Đang tải...</span></li>
                </ul>
                <div id="tabs-content" class="tab-content">
                    <div id="depart-box" class="tab-pane fade in active">
                        <div class="col-md-12 hidden-xs hidden-sm">
                            <div class="row">
                                <div id="depart-dates">
                                <?php if (!empty($dates['depart'])) : ?>
                                <?php foreach ($dates['depart'] as $date) : ?>
                                    <div class="col-xs-1 text-center">
                                        <a class="color-black" href="<?= Url::current(['date-depart' => $date['date']]) ?>">
                                            <div class="row flight-date<?= empty($date['active']) ? null : ' active' ?>">
                                                <p><?= $date['title'] ?></p>
                                                <p><?= $date['date_short'] ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach ?>
                                <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <table id="depart-table" class="table table-hover bg-white">
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
                        <div class="col-md-12 hidden-xs hidden-sm">
                            <div class="row">
                                <div id="return-dates">
                                <?php if (!empty($dates['return'])) : ?>
                                <?php foreach ($dates['return'] as $date) : ?>
                                    <div class="col-xs-1 text-center">
                                        <a class="color-black" href="<?= Url::current(['date-return' => $date['date']]) ?>">
                                            <div class="row flight-date<?= empty($date['active']) ? null : ' active' ?>">
                                                <p><?= $date['title'] ?></p>
                                                <p><?= $date['date_short'] ?></p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach ?>
                                <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <table id="return-table" class="table table-hover bg-white">
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
        </div>
    </div>
</div>
