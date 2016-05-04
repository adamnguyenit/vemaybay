<?php
use yii\helpers\Html;
?>
<?php if (isset($dataProvider)) : ?>
    <?php foreach ($dataProvider->getModels() as $model) : ?>
<div class="promotion-news bg-white">
    <img src="<?= $model->image ?>">
    <h2><a class="color-blue" href="/khuyen-mai/<?= $model->alias ?>.html"><?= Html::encode($model->title) ?></a></h2>
    <p><?= Html::encode($model->description) ?></p>
    <a class="btn btn-danger btn-fab pull-right" href="/khuyen-mai/<?= $model->alias ?>.html" role="button"><i class="material-icons">near_me</i></a>
</div>
    <?php endforeach ?>
<?php
    $pagination = $dataProvider->getPagination();
    $currentPage = $pagination->getPage();
?>
    <?php if ($currentPage < $pagination->getPageCount() - 1) : ?>
<div class="row"><a class="btn btn-primary btn-raised jscroll-next" href="<?= $pagination->createUrl($currentPage + 1, null, true) ?>" style="width: 100%" role="button">Xem thêm</a></div>
    <?php endif ?>
<?php endif ?>
