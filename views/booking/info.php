<?php
use app\assets\BookingInfoAsset;
use yii\helpers\Url;

BookingInfoAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Giao dịch #' . $data['id'];
?>
<div class="container">
    <input id="id" type="hidden" value="<?= $data['id'] ?>">
    <div class="row">
        <div class="col-md-12">
            <div id="booking-box" class="row bg-white">Đang tải, quý khách vui lòng đợi trong giây lát</div>
        </div>
    </div>
</div>
<div id="bill-box" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xuất hóa đơn</h4>
            </div>
            <div class="modal-body">
                <div class="form-group label-floating">
                    <label class="control-label">Tên công ty</label>
                    <input class="form-control" name="bill_name">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Địa chỉ công ty</label>
                    <input class="form-control" name="bill_address">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Mã số thuế</label>
                    <input class="form-control" name="bill_code">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Địa chỉ người nhận</label>
                    <input class="form-control" name="bill_contact">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Số ĐT người nhận</label>
                    <input class="form-control" name="bill_phone" type="tel">
                </div>
            </div>
            <div class="modal-footer">
                <button id="bill-ok" type="button" class="btn btn-default">Hoàn tất</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
