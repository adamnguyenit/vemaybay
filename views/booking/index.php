<?php
use app\assets\BookingIndexAsset;
use yii\helpers\Url;

BookingIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Giao dịch';
?>
<div class="container bg-white">
    <h3>Tra cứu thông tin giao dịch</h3>
    <div class="form-group label-floating">
        <label class="control-label">Mã giao dịch</label>
        <input id="search-input" class="form-control required">
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Số ĐT</label>
        <input id="phone-input" class="form-control required">
    </div>
    <div class="form-group">
        <button id="search" class="btn btn-primary btn-raised pull-right" type="button">Tra cứu</button>
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
                <p>Vui lòng nhập đầy đủ thông tin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
