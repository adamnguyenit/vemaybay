<?php
use app\assets\BookingIndexAsset;
use yii\helpers\Url;

BookingIndexAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến | Giao dịch';
?>
<div class="container bg-white">
    <h3>Tra cứu thông tin giao dịch</h3>
    <div class="form-group">
        <div class="input-group">
          <input id="search-input" class="form-control" placeholder="Nhập mã giao dịch">
          <span class="input-group-btn">
              <button id="search" class="btn btn-default" type="button">Tra cứu</button>
          </span>
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
                <p>Vui lòng nhập mã giao dịch.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
