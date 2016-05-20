<?php
use app\assets\UserLoginAsset;
use yii\helpers\Url;
use yii\helpers\Html;

$bundle = UserLoginAsset::register($this);
$this->title = 'Cộng tác viên - Đăng nhập';
?>
<div class="container">
    <div class="col-md-4 col-sm-6 col-centered">
        <div class="row">
            <h3 class="color-blue">Đăng nhập cộng tác viên</h3>
            <form id="login-form">
                <div class="form-group label-floating">
                    <label class="control-label">Tên đăng nhập</label>
                    <input class="form-control required" name="username">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Mật khẩu</label>
                    <input class="form-control required" name="password" type="password">
                </div>
                <button class="btn btn-raised btn-primary pull-right">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
