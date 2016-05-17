<?php
use app\assets\FlightBookAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = FlightBookAsset::register($this);
$this->title = 'Vé máy bay Hải Phi Yến - Hoàn tất đặt vé';
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div id="choose-tickets"></div>
            </div>
            <div class="row bg-white">
                <div id="people"></div>
            </div>
            <div class="row bg-white" style="margin-top: 5px">
                <div id="contact">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="color-blue">Người liên hệ</h4>
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-5">
                            <div class="row">
                                <label class="control-label">Họ và tên</label>
                                <input id="contact-name" class="form-control required" name="contact_name">
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-3">
                            <div class="row">
                                <label class="control-label">Số ĐT</label>
                                <input class="form-control required" name="contact_phone" type="tel">
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-4">
                            <div class="row">
                                <label class="control-label">Email</label>
                                <input class="form-control required" name="contact_email" type="email">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg-white" style="margin-top: 5px">
                <div id="payment">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="color-blue">Thanh toán</h4>
                            </div>
                        </div>
                        <div class="form-group label-floating col-sm-12">
                            <div class="row">
                                <label class="control-label">Thanh toán qua</label>
                                <select id="payment-value" class="form-control" name="payment_method">
                                    <option value="at_store">Tại văn phòng Vé Máy Bay Hải Phi Yến</option>
                                    <option value="bank">Chuyển khoản ngân hàng</option>
                                </select>
                                <div id="at_store">
                                    <h5>Văn phòng Vé Máy Bay Hải Phi Yến, số B1-17 Lô 108 Khu đô thị sinh thái Hoà Xuân, Q. Cẩm Lệ, TP. Đà Nẵng<h5>
                                </div>
                                <div id="bank" style="display: none">
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="hdbank" checked>HDBank
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Công ty TNHH Thương Mại và Dịch Vụ Hải Phi Yến</br>Số tài khoản: 048704070003022</br>Ngân hàng: HDBank Đà Nẵng - PGD Hoà Cường</p>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="vietcombank">Vietcombank
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Trần Thị Bích Đào</br>Số tài khoản: 0041001075854</br>Ngân hàng: Vietcombank Đà Nẵng</p>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="mbbank">MBBank
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Trần Thị Bích Đào</br>Số tài khoản: 3070101625008</br>Ngân hàng: MBBank Đà Nẵng</p>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="techcombank">Techcombank
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Trần Thị Bích Đào</br>Số tài khoản: 19027497952014</br>Ngân hàng: Techcombank Đà Nẵng</p>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="agribank">Agribank
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Trần Thị Bích Đào</br>Số tài khoản: 2005206088990</br>Ngân hàng: Agribank Đà Nẵng</p>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="color-black">
                                            <input name="payment_bank" type="radio" value="bidv">BIDV
                                            <p style="font-weight: normal; font-size: 13px">Chủ tài khoản: Trần Thị Bích Đào</br>Số tài khoản: 561 10 00 076254 9</br>Ngân hàng: BIDV Đà Nẵng - PGD Quận Cẩm Lệ</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-bottom: 5px">
            <div class="row right-panel">
                <div id="price-box" class="bg-white"></div>
                <div id="confirm">
                    <button id="confirm-btn" class="btn btn-lg btn-raised btn-primary pull-right">Hoàn tất</button>
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
                <p>Vui lòng điền đầy đủ thông tin.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
