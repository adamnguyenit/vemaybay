<?php
use yii\helpers\Html;
?>
<?php if (isset($dataProvider)) : ?>
    <?php foreach ($dataProvider->getModels() as $model) : ?>
<div class="popular-news bg-white">
    <h3><a href="/tin-tuc/<?= $model->alias ?>.html"><?= Html::encode($model->title) ?></a></h3>
    <p><?= Html::encode($model->description) ?></p>
    <a class="btn btn-sm btn-primary pull-right" href="/tin-tuc/<?= $model->alias ?>.html" role="button">Đọc tiếp</a>
</div>
    <?php endforeach ?>
<?php endif ?>
