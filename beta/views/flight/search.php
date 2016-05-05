<?php
use app\assets\FlightSearchAsset;
use yii\helpers\Url;

$bundle = FlightSearchAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Tìm vé máy bay';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="row" style="margin-right: 5px">
                <div id="book-form" class="col-md-12 hidden-xs hidden-sm bg-white">
                    <form action="<?= Url::toRoute(['flight/search']) ?>" role="form">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <div class="radio">
                                    <label class="color-black">
                                        <input type="radio" name="round-trip" value="0"<?= $params['round-trip'] == 0 ? ' checked' : null ?>>Một chiều
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="color-black">
                                        <input type="radio" name="round-trip" value="1"<?= $params['round-trip'] == 1 ? ' checked' : null ?>>Khứ hồi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group label-floating col-sm-6">
                                    <div class="row" style="margin-right: 5px">
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
                                    <div class="row" style="margin-right: 5px">
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
                                    <div class="row" style="margin-right: 5px">
                                        <label class="control-label color-black">Người lớn</label>
                                        <select class="select form-control" name="adult" data-value="21">
                                            <?php foreach (range(1, 30) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['adult'] ? ' selected' : null ?>><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row" style="margin-right: 5px">
                                        <label class="control-label color-black">Trẻ em</label>
                                        <select class="select form-control" name="child">
                                            <?php foreach (range(0, 30) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['child'] ? ' selected' : null ?>><?= $index ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group label-static col-sm-4">
                                    <div class="row">
                                        <label class="control-label color-black">Em bé</label>
                                        <select class="select form-control" name="infant">
                                            <?php foreach (range(0, 30) as $index) : ?>
                                            <option value="<?= $index ?>"<?= $index == $params['infant'] ? ' selected' : null ?>><?= $index ?></option>
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
            <div class="row hidden-xs hidden-sm" style="margin-right: 5px">
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
            <div class="row hidden-xs hidden-sm" style="margin-right: 5px">
                <div id="panel-box"></div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div id="tabs-progress" class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info" style="width: 45%"></div>
                </div>
                <ul id="tabs-panel" class="nav nav-tabs">
                    <li class="active"><a id="depart-tab-trigger" data-toggle="tab" href="#depart-box">Chiều đi</a></li>
                    <li <?= $params['round-trip'] == 0 ? ' style="display: none"' : null ?>><a id="return-tab-trigger" data-toggle="tab" href="#return-box">Chiều về</a></li>
                </ul>
                <div id="tabs-content" class="tab-content bg-white">
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
                        <table id="depart-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hãng</th>
                                    <th>Giờ bay</th>
                                    <th>Chuyến</th>
                                    <th>Giá từ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">1.299.000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">199.000</td>
                                </tr>
                            </tbody>
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
                        <table id="return-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hãng</th>
                                    <th>Giờ bay</th>
                                    <th>Chuyến</th>
                                    <th>Giá từ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">1.299.000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><span class="label label-primary">VN</span></td>
                                    <td>08:30</td>
                                    <td>VN 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td><span class="label label-warning">VJ</span></td>
                                    <td>08:30</td>
                                    <td>VJ 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">299.000</td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td><span class="label label-danger">JS</span></td>
                                    <td>08:30</td>
                                    <td>JS 327</td>
                                    <td class="color-red">199.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
