<?php
use app\models\Booking;
?>
<?php if ($model !== null) : ?>
    <div class="col-md-12">
        <div>
            <h3>Giao dịch #<?= $model->identity ?></h3>
            <p class="color-blue" style="margin-bottom: 0"><span class="color-black"><?= $model->createdAt ?></span></p>
            <p class="color-blue" style="margin-bottom: 0">Tình trạng: <span class="color-black"><?= $model->statusString ?></span></p>
            <p class="color-blue">Tổng giá trị giao dịch: <span class="color-red"><?= number_format($model->price, 0, ',', '.') ?> VND</span></p>
        </div>
    </div>
    <div class="col-md-12 box">
        <div id="trip">
            <h4>Hành trình</h4>
            <?php foreach ($model->ticketsDetail as $key => $value) : ?>
                <div class="col-md-6">
                    <div class="row">
                        <table id="<?= $key ?>">
                            <tbody>
                                <tr>
                                    <td><b><?= $value['ticket']['fromPlace'] ?></b></td>
                                    <td><span class="fa fa-plane"></span></td>
                                    <td><b><?= $value['ticket']['toPlace'] ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Đi lúc: <?= Booking::decodeDateTime($value['ticket']['departTime']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Đến lúc: <?= Booking::decodeDateTime($value['ticket']['landingTime']) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Mã chuyến bay: <?= $value['ticket']['airline'] ?> <?= $value['ticket']['flightNumber'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Hạng ghế: <?= $model->selectedTicketOptions[$key]['ticketType'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-12 box">
        <div id="passengers">
            <h4>Hành khách</h4>
            <p>Người lớn: <span class="color-red"><?= $model->adult ?></span>, trẻ em: <span class="color-red"><?= $model->child ?></span>, em bé: <span class="color-red"><?= $model->infant ?></span></p>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Họ và tên</th>
                        <th>Năm sinh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model->passengersDetail as $type => $passengers) : ?>
                        <?php foreach($passengers as $passenger) : ?>
                    <tr>
                        <td><?= Booking::decodePassengerTitle($type, $passenger['title']) ?></td>
                        <td><?= $passenger['name'] ?></td>
                        <td><?= $passenger['birth'] ?></td>
                    </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 box">
        <div id="baggages">
            <h4>Hành lý</h4>
            <?php foreach ($model->baggages as $type => $value) : ?>
            <h5>Chặng: <?= $model->ticketsDetail[$type]['ticket']['fromPlace'] ?> - <?= $model->ticketsDetail[$type]['ticket']['toPlace'] ?></h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Loại</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($value as $baggage) : ?>
                    <tr>
                        <td><?= $baggage['description'] ?></td>
                        <td><?= $baggage['quantity'] ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-md-12 box">
        <div id="contact">
            <h4>Liên hệ</h4>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Họ và tên</td>
                        <td><?= $model->contact_name ?></td>
                    </tr>
                    <tr>
                        <td>Số ĐT</td>
                        <td><?= $model->contact_phone ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= $model->contact_email ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php else : ?>
    <div class="col-md-12">
        <div class="color-red">
            <h4>Không tìm thấy giao dịch này.</h4>
        </div>
    </div>
<?php endif ?>
