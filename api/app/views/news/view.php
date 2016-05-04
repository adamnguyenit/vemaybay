<?php
use yii\helpers\Html;
?>
<?php if (isset($model)) : ?>
<h1 class="color-red"><?= Html::encode($model->title) ?></h1>
<p class="text-muted"><span class="fa fa-calendar"></span> <?= Html::encode($model->createdAt) ?></p>
<?= $model->content ?>
<?php endif ?>
