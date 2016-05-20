<?php
use yii\helpers\Html;
?>
<?php if (isset($dataProvider)) : ?>
<ul class="list-group">
    <?php foreach ($dataProvider->getModels() as $model) : ?>
    <li class="list-group-item"><?= Html::encode($model->name) ?> - <?= $model->code ?></li>
    <?php endforeach ?>
</ul>
<?php endif ?>
