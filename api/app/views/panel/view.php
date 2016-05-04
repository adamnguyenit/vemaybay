<?php
use yii\helpers\Html;
?>
<?php if (isset($model)) : ?>
<h1 class="color-red"><?= $model->title ?></h1>
<p></p>
<?= $model->content ?>
<?php endif ?>
