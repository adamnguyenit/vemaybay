<?php
use app\models\Booking;
?>
<?php if ($model !== null) : ?>
<div class="col-md-12 box">
    <div>
        <h3>Giao dịch #<?= $model->identity ?></h3>
        <p class="color-blue" style="margin-bottom: 0"><span class="color-black"><?= $model->createdAt ?></span></p>
        <p class="color-blue" style="margin-bottom: 0">Tình trạng: <span class="color-black"><?= $model->statusString ?></span></p>
        <p class="color-blue">Tổng giá trị giao dịch: <span class="color-red"><?= number_format($model->price, 0, ',', '.') ?> VND</span></p>
        <?php if ($model->isBillabe()) : ?>
        <h4>Xuất hóa đơn</h4>
        <div id="bill-detailed">
            <div class="bill-title">Tên công ty</div>
            <div class="bill-content"><?= $model->bill['name'] ?></div>
            <div class="bill-title">Địa chỉ công ty</div>
            <div class="bill-content"><?= $model->bill['address'] ?></div>
            <div class="bill-title">Mã số thuế</div>
            <div class="bill-content"><?= $model->bill['code'] ?></div>
            <div class="bill-title">Địa chỉ người nhận</div>
            <div class="bill-content"><?= $model->bill['contact'] ?></div>
            <div class="bill-title">Số ĐT người nhận</div>
            <div class="bill-content"><?= $model->bill['phone'] ?></div>
        </div>
        <?php else : ?>
        <buton id="bill" class="btn btn-xs btn-raised">Tôi muốn xuất hóa đơn</button>
        <?php endif ?>
    </div>
</div>
<div class="col-md-12 box">
    <div id="contact">
        <h4>Liên hệ</h4>
        <div>
            <div class="contact-title">Họ và tên</div>
            <div class="contact-content"><?= $model->contact_name ?></div>
            <div class="contact-title">Số ĐT</div>
            <div class="contact-content"><?= $model->contact_phone ?></div>
            <?php if (!empty($model->contact_email)) : ?>
            <div class="contact-title">Email</div>
            <div class="contact-content"><?= $model->contact_email ?></div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="col-md-12 box">
    <div id="trip">
        <h4>Hành trình</h4>
        <?php foreach ($model->ticketsDetail as $key => $value) : ?>
            <div class="col-md-6">
                <div class="row">
                    <div id="<?= $key ?>" class="flight-detail">
                        <div><b><?= $value['ticket']['fromPlace'] ?></b> đến <b><?= $value['ticket']['toPlace'] ?></b></div>
                        <div>Hạng ghế: <?= $model->selectedTicketOptions[$key]['ticketType'] ?></div>
                        <div>
                        <?php foreach ($value['ticket']['flightDetails'] as $flightDetail) : ?>
                            <table>
                                <tbody>
                                    <tr>
                                        <td><?= $flightDetail['from'] ?></td>
                                        <td><span class="fa fa-fighter-jet"></span></td>
                                        <td><?= $flightDetail['to'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><?= Booking::decodeDateTime($flightDetail['departTime']) ?></td>
                                        <td></td>
                                        <td><?= Booking::decodeDateTime($flightDetail['landingTime']) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endforeach ?>
                        </div>
                    </div>
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
        <?php $count = 0 ?>
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
                <?php $count++ ?>
                <tr>
                    <td><?= $baggage['description'] ?></td>
                    <td><?= $baggage['quantity'] ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <?php endforeach ?>
        <?php if ($count == 0) : ?>
        <h5 class="color-red">Hành lý xách tay</h5>
        <?php endif ?>
    </div>
</div>
<?php else : ?>
<div class="col-md-12">
    <div class="color-red">
        <h4>Không tìm thấy giao dịch này.</h4>
    </div>
</div>
<?php endif ?>
