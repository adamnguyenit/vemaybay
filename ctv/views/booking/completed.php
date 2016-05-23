<?php
use app\assets\BookingCompletedAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = BookingCompletedAsset::register($this);
$this->title = 'Cộng tác viên - Giao dịch đã xuất vé';
?>
<div class="container-fluid">
    <div class="row bg-white">
        <div class="table-responsive">
            <table id="table" class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã giao dịch</th>
                        <th>Người liên hệ</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="info-box" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <p>Vui lòng điền đầy đủ thông tin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
