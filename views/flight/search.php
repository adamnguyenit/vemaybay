<?php
use app\assets\FlightSearchAsset;
use yii\helpers\Url;

$bundle = FlightSearchAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tìm vé máy bay';
$departTitle = 'Chiều đi';
$returnTitle = 'Chiều về';
if (!empty($params['place-from']) && !empty($params['place-to'])) {
    $from = explode(' - ', $params['place-from']);
    unset($from[count($from) - 1]);
    $from = implode(' - ', $from);
    $to = explode(' - ', $params['place-to']);
    unset($to[count($to) - 1]);
    $to = implode(' - ', $to);
    $departTitle = "$from - $to";
    $returnTitle = "$to - $from";
}
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
                <div id="panel-box"></div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <ul id="tabs-panel" class="nav nav-tabs">
                    <li class="active"><a id="depart-tab-trigger" data-toggle="tab" href="#depart-box"><?= $departTitle ?></a></li>
                    <li <?= $params['round-trip'] == 0 ? ' style="display: none"' : null ?>><a id="return-tab-trigger" data-toggle="tab" href="#return-box"><?= $returnTitle ?></a></li>
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
                        <button class="btn btn-raised btn-primary pull-right">Tiếp theo</button>
                    </div>
                </div>
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
                <p>Vui lòng chọn vé chiều đi trước</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
